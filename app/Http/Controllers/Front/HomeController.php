<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Repositories\CategoryRepository;
use App\Repositories\DocumentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends FrontController
{

    /**
     * @param DocumentRepository $documentRepository
     * @param CategoryRepository $categoryRepository
     * @return View
     */
    public function index(DocumentRepository $documentRepository, CategoryRepository $categoryRepository) : View
    {
        $documentsEducation = $documentRepository->getRandomPublicDocuments(4);
        $documentsMostPopular = $documentRepository->getRandomPublicDocuments(10);

        $categoriesForWidget = $categoryRepository->getCategoriesForHome();

        return view('front.home', compact('documentsEducation', 'documentsMostPopular', 'categoriesForWidget'));
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToHome() : RedirectResponse
    {
        return response()->redirectToRoute('front.home');
    }

}
