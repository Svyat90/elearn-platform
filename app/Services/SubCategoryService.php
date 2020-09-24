<?php

namespace App\Services;

use App\Category;
use App\Role;
use App\SubCategory;
use App\Traits\FilterConstantsTrait;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SubCategoryService
{
    use FilterConstantsTrait;

    public const SUB_CATEGORY_ACCESS_TYPE_PUBLIC = 'public';
    public const SUB_CATEGORY_ACCESS_TYPE_PROTECTED = 'protected';
    public const SUB_CATEGORY_ACCESS_TYPE_PRIVATE = 'private';

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
        return static::filterConstants("SUB_CATEGORY_ACCESS_TYPE");
    }

    /**
     * @param SubCategory $subCategory
     * @param Request $request
     */
    public function handleRelationships(SubCategory $subCategory, Request $request) : void
    {
        $subCategory->roles()->sync($request->role_ids);
        $subCategory->users()->sync($request->user_ids);
    }

    /**
     * @param Category $parentCategory
     * @return Collection
     */
    public function getAvailableCategories(Category $parentCategory) : Collection
    {
        return SubCategory::query()
            ->where('parent_id', $parentCategory->id)
            ->where('access', self::SUB_CATEGORY_ACCESS_TYPE_PUBLIC)
            ->orWhere(function (Builder $query) {
                $query->where('access', self::SUB_CATEGORY_ACCESS_TYPE_PROTECTED)
                    ->whereIn('id', $this->getProtectedSubCategoryIds());
            })
            ->get();
    }

    /**
     * @return array
     */
    private function getProtectedSubCategoryIds() : array
    {
        if ( ! $this->user)
            return [];

        $roleSubCategoryIds = $this->getUserRolesSubCategories();
        $userSubCategoryIds = $this->getUserSubCategories();

        return $roleSubCategoryIds
            ->merge($userSubCategoryIds)
            ->unique()
            ->toArray();
    }

    /**
     * @return Collection
     */
    private function getUserRolesSubCategories() : Collection
    {
        return $this->user->roles->map(function (Role $role) {
            return $role->subCategories->map(function (SubCategory $subCategory) {
                return $subCategory->id;
            });

        })->collapse();
    }

    /**
     * @return Collection
     */
    private function getUserSubCategories() : Collection
    {
        return $this->user->subCategories->map(function (SubCategory $subCategory) {
            return $subCategory->id;
        });
    }

}
