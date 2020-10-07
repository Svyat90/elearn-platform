<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\RedirectResponse;

class ChangePasswordController extends Controller
{
    /**
     * @return View
     */
    public function edit() : View
    {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('auth.passwords.edit');
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function update(UpdatePasswordRequest $request)
    {
        $validData = $request->validated();

        /** @var User $user */
        $user = auth()->user();
        $user->password = Hash::make($validData['password']);
        $user->email = $validData['email'];
        $user->save();

        return redirect()
            ->route('profile.password.edit')
            ->with('message', __('global.change_password_success'));
    }
}
