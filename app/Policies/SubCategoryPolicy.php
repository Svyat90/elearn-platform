<?php

namespace App\Policies;

use App\SubCategory;
use App\Services\SubCategoryService;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @param SubCategory $category
     * @return Response
     */
    public function show( ? User $user, SubCategory $category) : Response
    {
        $availableSubCategoryIds = (new SubCategoryService())
            ->getAvailableSubCategories($category->parent)
            ->pluck('id')
            ->toArray();

        return in_array($category->id, $availableSubCategoryIds)
            ? Response::allow()
            : Response::deny(__('main.access_denied'));
    }

}
