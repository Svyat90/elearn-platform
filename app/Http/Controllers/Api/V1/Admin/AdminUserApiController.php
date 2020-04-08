<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Http\Resources\Admin\AdminUserResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminUserApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('admin_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdminUserResource(AdminUser::with(['role'])->get());

    }

    public function store(StoreAdminUserRequest $request)
    {
        $adminUser = AdminUser::create($request->all());

        return (new AdminUserResource($adminUser))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(AdminUser $adminUser)
    {
        abort_if(Gate::denies('admin_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdminUserResource($adminUser->load(['role']));

    }

    public function update(UpdateAdminUserRequest $request, AdminUser $adminUser)
    {
        $adminUser->update($request->all());

        return (new AdminUserResource($adminUser))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(AdminUser $adminUser)
    {
        abort_if(Gate::denies('admin_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminUser->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
