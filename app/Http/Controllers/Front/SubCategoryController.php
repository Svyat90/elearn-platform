<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\SubCategory;
use Illuminate\View\View;

class SubCategoryController extends FrontController
{

    /**
     * @param SubCategory $category
     * @return View
     */
    public function show(SubCategory $category) : View
    {
        $category->load('documents');

        dd($category->documents);

        return view('front.categories.show', compact('category'));
    }

}
