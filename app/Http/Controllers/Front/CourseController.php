<?php

namespace App\Http\Controllers\Front;

use App\Course;
use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Course\CourseFavouriteRequest;
use App\Http\Requests\Front\Course\CourseWatchLaterRequest;
use App\Services\Course\CourseFavouriteService;
use App\Services\Course\CourseService;
use App\Services\Course\CourseWatchLaterService;
use App\Services\Document\DocumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function show(DocumentService $documentService, Course $course) : View
    {
        $this->authorize('show', $course);

        $course->load('categories');

        $documents = $documentService
            ->getAvailableCourseDocuments($course)
            ->get();

        return view('front.courses.show', compact('course', 'documents'));
    }

    /**
     * @param CourseFavouriteRequest $request
     * @param CourseFavouriteService $favouriteService
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function favorite(CourseFavouriteRequest $request, CourseFavouriteService $favouriteService) : JsonResponse
    {
        $this->authorize('favorite', $request->courseId);

        $result = $favouriteService->toggleFavorite($request->courseId);

        return $this->getSuccessResponse(new JsonResource([
            'isFavorite' => $result
        ]));
    }

    /**
     * @param CourseWatchLaterRequest $request
     * @param CourseWatchLaterService $watchLaterService
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function watchLater(CourseWatchLaterRequest $request, CourseWatchLaterService $watchLaterService) : JsonResponse
    {
        $this->authorize('watchLater', $request->courseId);

        $result = $watchLaterService->toggleWatchLater($request->courseId);

        return $this->getSuccessResponse(new JsonResource([
            'isWatchLater' => $result
        ]));
    }

}
