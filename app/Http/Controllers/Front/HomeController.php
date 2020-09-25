<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\DocumentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends FrontController
{

    /**
     * @param DocumentRepository $documentRepository
     * @param CategoryRepository $categoryRepository
     * @param CourseRepository $courseRepository
     * @return View
     */
    public function index(
        DocumentRepository $documentRepository,
        CategoryRepository $categoryRepository,
        CourseRepository $courseRepository
    ) : View
    {
        $documentsEducation = $documentRepository->getRandomPublicDocuments(4);
        $documentsMostPopular = $documentRepository->getRandomPublicDocuments(10);
        $courses = $courseRepository->getRandomPublicCourses();

        $categoriesForWidget = $categoryRepository->getCategoriesForHome();

        return view('front.home', compact(
            'documentsEducation',
            'documentsMostPopular',
            'categoriesForWidget',
            'courses'
            )
        );
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToHome() : RedirectResponse
    {
        return response()->redirectToRoute('front.home');
    }

}
