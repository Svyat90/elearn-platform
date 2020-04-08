<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AdminSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminSettingRequest;
use App\Http\Resources\Admin\AdminSettingResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSettingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('admin_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdminSettingResource(AdminSetting::all());

    }

    public function show(AdminSetting $adminSetting)
    {
        abort_if(Gate::denies('admin_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdminSettingResource($adminSetting);

    }

    public function update(UpdateAdminSettingRequest $request, AdminSetting $adminSetting)
    {
        $adminSetting->update($request->all());

        return (new AdminSettingResource($adminSetting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }
}
