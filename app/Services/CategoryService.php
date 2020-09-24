<?php

namespace App\Services;

use App\Category;
use App\Role;
use App\Traits\FilterConstantsTrait;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class CategoryService
{
    use FilterConstantsTrait;

    public const CATEGORY_ACCESS_TYPE_PUBLIC = 'public';
    public const CATEGORY_ACCESS_TYPE_PROTECTED = 'protected';
    public const CATEGORY_ACCESS_TYPE_PRIVATE = 'private';

    /**
     * @var User|null
     */
    protected ? User $user = null;

    /**
     * @param User|null $user
     */
    public function setUser( ? User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public static function getAccessTypes() : array
    {
        return static::filterConstants("CATEGORY_ACCESS_TYPE");
    }

    /**
     * @param Category $category
     * @param Request $request
     */
    public function handleRelationships(Category $category, Request $request) : void
    {
        $category->roles()->sync($request->role_ids);
        $category->users()->sync($request->user_ids);
    }

    /**
     * @return Collection
     */
    public function getAvailableCategories() : Collection
    {
        if ( ! Schema::hasTable('categories')){
            return collect();
        }

        return Category::query()
            ->where('access', self::CATEGORY_ACCESS_TYPE_PUBLIC)
            ->orWhere(function (Builder $query) {
                $query->where('access', self::CATEGORY_ACCESS_TYPE_PROTECTED)
                    ->whereIn('id', $this->getProtectedCategoryIds());
            })
            ->get();
    }

    /**
     * @return array
     */
    private function getProtectedCategoryIds() : array
    {
        if ( ! $this->user)
            return [];

        $roleCategoryIds = $this->getUserRolesCategories();
        $userCategoryIds = $this->getUserCategories();

        return $roleCategoryIds
            ->merge($userCategoryIds)
            ->unique()
            ->toArray();
    }

    /**
     * @return Collection
     */
    private function getUserRolesCategories() : Collection
    {
        return $this->user->roles->map(function (Role $role) {
            return $role->categories->map(function (Category $category) {
                return $category->id;
            });
        })
        ->collapse();
    }

    /**
     * @return Collection
     */
    private function getUserCategories() : Collection
    {
        return $this->user->categories->map(function (Category $category) {
            return $category->id;
        });
    }

}
