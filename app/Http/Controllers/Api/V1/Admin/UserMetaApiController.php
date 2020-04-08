<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserMetumRequest;
use App\Http\Requests\UpdateUserMetumRequest;
use App\Http\Resources\Admin\UserMetumResource;
use App\UserMetum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMetaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserMetumResource(UserMetum::with(['user'])->get());

    }

    public function store(StoreUserMetumRequest $request)
    {
        $userMetum = UserMetum::create($request->all());

        return (new UserMetumResource($userMetum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(UserMetum $userMetum)
    {
        abort_if(Gate::denies('user_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserMetumResource($userMetum->load(['user']));

    }

    public function update(UpdateUserMetumRequest $request, UserMetum $userMetum)
    {
        $userMetum->update($request->all());

        return (new UserMetumResource($userMetum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(UserMetum $userMetum)
    {
        abort_if(Gate::denies('user_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMetum->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
