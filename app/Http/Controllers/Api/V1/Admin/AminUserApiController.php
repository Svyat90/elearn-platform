<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAminUserRequest;
use App\Http\Requests\UpdateAminUserRequest;
use App\Http\Resources\Admin\AminUserResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AminUserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('amin_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AminUserResource(AminUser::all());

    }

    public function store(StoreAminUserRequest $request)
    {
        $aminUser = AminUser::create($request->all());

        return (new AminUserResource($aminUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(AminUser $aminUser)
    {
        abort_if(Gate::denies('amin_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AminUserResource($aminUser);

    }

    public function update(UpdateAminUserRequest $request, AminUser $aminUser)
    {
        $aminUser->update($request->all());

        return (new AminUserResource($aminUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(AminUser $aminUser)
    {
        abort_if(Gate::denies('amin_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aminUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
