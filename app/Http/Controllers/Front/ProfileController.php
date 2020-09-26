<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Services\CourseService;
use App\Services\DocumentService;
use Illuminate\View\View;

class ProfileController extends FrontController
{

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
        $documents = $documentService->getProtectedDocuments();

        return view('front.profile.myDocuments', compact('documents'));
    }

}
