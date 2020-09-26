<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Services\CourseService;
use App\Services\DocumentService;
use Illuminate\View\View;

class ProfileController extends FrontController
{

    /**
     * @return View
     */
    public function myAccount() : View
    {
        return view('front.profile.myAccount');
    }

    /**
     * @param DocumentService $documentService
     * @return View
     */
    public function favourites(DocumentService $documentService) : View
    {
        $title = __('profile.favourites');

        $documents = $documentService->getFavouriteDocuments();

        return view('front.profile.myDocuments', compact('documents', 'title'));
    }

    /**
     * @param DocumentService $documentService
     * @return View
     */
    public function watchLater(DocumentService $documentService) : View
    {
        $title = __('profile.watch_later');

        $documents = $documentService->getWatchLaterDocuments();

        return view('front.profile.myDocuments', compact('documents', 'title'));
    }

    /**
     * @param CourseService $courseService
     * @return View
     */
    public function myCourses(CourseService $courseService) : View
    {
        $courses = $courseService->getProtectedCourses();

        return view('front.profile.myCourses', compact('courses'));
    }

    /**
     * @param DocumentService $documentService
     * @return View
     */
    public function myDocuments(DocumentService $documentService) : View
    {
        $title = __('profile.my_documents');

        $documents = $documentService->getProtectedDocuments();

        return view('front.profile.myDocuments', compact('documents', 'title'));
    }

}
