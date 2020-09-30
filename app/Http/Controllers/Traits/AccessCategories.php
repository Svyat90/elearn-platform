<?php

namespace App\Http\Controllers\Traits;

use App\Services\CategoryService;
use App\Services\SubCategoryService;
use App\User;
use Illuminate\Support\Facades\View;

trait AccessCategories
{

    /**
     * Share available categories to current user
     *
     * @param User|null $user
     */
    public function shareCategories( ? User $user) : void
    {
        $categoryService = new CategoryService();
        $categoryService->setUser($user);

        $subCategoryService = new SubCategoryService();
        $subCategoryService->setUser($user);

        $categories = $categoryService->getAvailableCategories();
        foreach ($categories as $category) {
            $category->availableSubCategories = $subCategoryService->getAvailableSubCategories($category);
        }

        View::share(compact('categories'));
    }

}
