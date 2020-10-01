<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Profile\UpdateUserDataRequest;
use App\Http\Requests\Front\Profile\UpdateUserPasswordRequest;
use App\Services\Course\CourseFavouriteService;
use App\Services\Course\CourseService;
use App\Services\Course\CourseWatchLaterService;
use App\Services\Document\DocumentFavouriteService;
use App\Services\Document\DocumentService;
use App\Services\Document\DocumentWatchLaterService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends FrontController
{

    /**
     * @param UserService $userService
     * @return View
     */
    public function myAccount(UserService $userService) : View
    {
        $user = auth()->user();
        $institutions = $userService->getUserInstitutions();

        return view('front.profile.myAccount', compact('user', 'institutions'));
    }

    /**
     * @param UpdateUserDataRequest $request
     * @return RedirectResponse
     */
    public function updateData(UpdateUserDataRequest $request) : RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->update($request->validated());

        return response()
            ->redirectToRoute('profile.my_account');
    }

    /**
     * @param UpdateUserPasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(UpdateUserPasswordRequest $request) : RedirectResponse
    {
        $checkOldPassword = Auth::attempt([
            'email' => auth()->user()->email,
            'password' => $request->input('old_password')
        ]);

        if ( ! $checkOldPassword) {
            return redirect()
                ->back()
                ->withErrors(__('auth.invalid_old_password'));
        }

        /** @var User $user */
        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()
            ->redirectToRoute('profile.my_account');
    }

    /**
     * @param DocumentFavouriteService $documentFavouriteService
     * @param CourseFavouriteService $courseFavouriteService
     * @return View
     */
    public function favourites(
        DocumentFavouriteService $documentFavouriteService,
        CourseFavouriteService $courseFavouriteService
    ) : View
    {
        $documents = $documentFavouriteService->getFavouriteDocuments();
        $courses = $courseFavouriteService->getFavouriteCourses();

        return view('front.profile.favourites', compact('documents', 'courses'));
    }

    /**
     * @param DocumentWatchLaterService $documentWatchLaterService
     * @param CourseWatchLaterService $courseWatchLaterService
     * @return View
     */
    public function watchLater(
        DocumentWatchLaterService $documentWatchLaterService,
        CourseWatchLaterService $courseWatchLaterService
    ) : View
    {
        $documents = $documentWatchLaterService->getWatchLaterDocuments();
        $courses = $courseWatchLaterService->getWatchLaterCourses();

        return view('front.profile.watchLater', compact('documents', 'documents', 'courses'));
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
        $documents = $documentService->getProtectedDocuments();

        return view('front.profile.myDocuments', compact('documents'));
    }

}
