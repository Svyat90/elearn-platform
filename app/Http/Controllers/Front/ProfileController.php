<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Profile\UpdateUserDataRequest;
use App\Http\Requests\Front\Profile\UpdateUserPasswordRequest;
use App\Services\CourseService;
use App\Services\DocumentService;
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
