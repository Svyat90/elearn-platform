<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginLogRequest;
use App\Http\Requests\UpdateLoginLogRequest;
use App\Http\Resources\Admin\LoginLogResource;
use App\LoginLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginLogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('login_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LoginLogResource(LoginLog::with(['user'])->get());

    }

    public function store(StoreLoginLogRequest $request)
    {
        $loginLog = LoginLog::create($request->all());

        return (new LoginLogResource($loginLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(LoginLog $loginLog)
    {
        abort_if(Gate::denies('login_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LoginLogResource($loginLog->load(['user']));

    }

    public function update(UpdateLoginLogRequest $request, LoginLog $loginLog)
    {
        $loginLog->update($request->all());

        return (new LoginLogResource($loginLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(LoginLog $loginLog)
    {
        abort_if(Gate::denies('login_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loginLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
