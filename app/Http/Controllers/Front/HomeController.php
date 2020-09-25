<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Repositories\DocumentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends FrontController
{

    /**
     * @param DocumentRepository $documentRepository
     * @return View
     */
    public function index(DocumentRepository $documentRepository) : View
    {
        $documentsEducation = $documentRepository->getRandomPublicDocuments(4);
        $documentsMostPopular = $documentRepository->getRandomPublicDocuments(10);

        return view('front.home', compact('documentsEducation', 'documentsMostPopular'));
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToHome() : RedirectResponse
    {
        return response()->redirectToRoute('front.home');
    }

}
