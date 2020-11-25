<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Category\IndexCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\DocumentRepository;
use App\Services\Document\DocumentService;
use App\Services\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends FrontController
{

    /**
     * @param DocumentRepository $documentRepository
     * @param CategoryRepository $categoryRepository
     * @param CourseRepository $courseRepository
     * @param DocumentService $documentService
     * @return View
     */
    public function index(
        DocumentRepository $documentRepository,
        CategoryRepository $categoryRepository,
        CourseRepository $courseRepository,
        DocumentService $documentService
    ) : View
    {
        $documentsEducation = $documentService
            ->getAvailableCategoryDocuments(
                SettingService::getHomeCategory(),
                new IndexCategoryRequest(),
                'category_id'
            )
            ->take(4)
            ->get();

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
