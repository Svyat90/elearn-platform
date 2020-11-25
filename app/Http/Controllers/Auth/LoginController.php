<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        login as loginTrait;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        App::setLocale($request->input('locale'));

        Session::forget('adminHaveToConfirm');

        $response = $this->loginTrait($request);

        $permissionService = new PermissionService();
        if ($permissionService->loginUserHasAccessToAdminPanel()) {
            return response()->redirectTo('admin');
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $data = $request->only($this->username(), 'password');
        $data['user_status'] = User::USER_STATUS_ACTIVE;
        return $data;
    }

}
