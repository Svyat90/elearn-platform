<?php

namespace App\Services;

use App\Category;
use App\Role;
use App\SubCategory;
use App\Traits\FilterConstantsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SubCategoryService extends AbstractAccessService
{
    use FilterConstantsTrait;

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
    public function getAvailableSubCategories(Category $parentCategory) : Collection
    {
        return SubCategory::query()
            ->where('parent_id', $parentCategory->id)
            ->where('access', self::ACCESS_TYPE_PUBLIC)
            ->orWhere(function (Builder $query) use ($parentCategory) {
                $query
                    ->where('parent_id', $parentCategory->id)
                    ->where('access', self::ACCESS_TYPE_PROTECTED)
                    ->whereIn('id', $this->getProtectedSubCategoryIds());
            })
            ->get();
    }

    /**
     * @return array
     */
    private function getProtectedSubCategoryIds() : array
    {
        if ( ! $this->getUser())
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
        return $this->getUser()->roles->map(function (Role $role) {
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
        return $this->getUser()->subCategories->map(function (SubCategory $subCategory) {
            return $subCategory->id;
        });
    }

}
