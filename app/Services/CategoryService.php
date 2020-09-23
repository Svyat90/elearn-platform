<?php

namespace App\Services;

use App\Category;
use App\Role;
use App\Traits\FilterConstantsTrait;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryService
{
    use FilterConstantsTrait;

    public const CATEGORY_ACCESS_TYPE_PUBLIC = 'public';
    public const CATEGORY_ACCESS_TYPE_PROTECTED = 'protected';
    public const CATEGORY_ACCESS_TYPE_PRIVATE = 'private';

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
        return Category::with('subCategories')
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
        /** @var User $user */
        $user = auth()->user();
        if ( ! $user)
            return [];

        $roleCategoryIds = $this->getUserRolesCategories($user);
        $userCategoryIds = $this->getUserCategories($user);

        return $roleCategoryIds
            ->merge($userCategoryIds)
            ->unique()
            ->toArray();
    }

    /**
     * @param User $user
     * @return Collection
     */
    private function getUserRolesCategories(User $user) : Collection
    {
        return $user->roles->map(function (Role $role) {
            return $role->categories->map(function (Category $category) {
                return $category->id;
            });
        })
        ->collapse();
    }

    /**
     * @param User $user
     * @return Collection
     */
    private function getUserCategories(User $user) : Collection
    {
        return $user->categories->map(function (Category $category) {
            return $category->id;
        });
    }

}
