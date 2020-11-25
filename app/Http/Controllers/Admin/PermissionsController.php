<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Permission\MassDestroyPermissionRequest;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends AdminController
{
    /**
     * @return View
     */
    public function index() : View
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * @return View
     */
    public function create() : View
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.create');
    }

    /**
     * @param StorePermissionRequest $request
     * @return RedirectResponse
     */
    public function store(StorePermissionRequest $request) : RedirectResponse
    {
        Permission::query()->create($request->all());

        return redirect()->route('admin.permissions.index');
    }

    /**
     * @param Permission $permission
     * @return View
     */
    public function edit(Permission $permission) : View
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * @param UpdatePermissionRequest $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update(UpdatePermissionRequest $request, Permission $permission) : RedirectResponse
    {
        $permission->update($request->all());

        return redirect()->route('admin.permissions.index');
    }

    /**
     * @param Permission $permission
     * @return View
     */
    public function show(Permission $permission) : View
    {
        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * @param Permission $permission
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Permission $permission) : RedirectResponse
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return back();
    }

    /**
     * @param MassDestroyPermissionRequest $request
     * @return Response
     */
    public function massDestroy(MassDestroyPermissionRequest $request) : Response
    {
        Permission::query()->whereIn('id', $request->ids)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
