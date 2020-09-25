<?php

namespace App\Http\Controllers\Front;

use App\Course;
use App\Http\Controllers\FrontController;
use App\Services\CourseService;
use App\Services\DocumentService;
use Illuminate\View\View;

class CourseController extends FrontController
{

    /**
     * @param CourseService $courseService
     * @return View
     */
    public function index(CourseService $courseService) : View
    {
        $courses = $courseService
            ->getAvailableCourses()
            ->paginate($this->pageLimit);

        return view('front.courses.index', compact('courses'));
    }

    /**
     * @param DocumentService $documentService
     * @param Course $course
     * @return View
     */
    public function show(DocumentService $documentService, Course $course) : View
    {
        $course->load('categories');

        $documents = $documentService
            ->getAvailableCourseDocuments($course)
            ->get();

        return view('front.courses.show', compact('course', 'documents'));
    }

}
