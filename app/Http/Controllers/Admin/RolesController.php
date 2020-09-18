<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    /**
     * @return View
     */
    public function index() : View
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * @param Role $role
     * @return View
     */
    public function edit(Role $role) : View
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all()->pluck('title', 'id');
        $role->load('permissions');

        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    /**
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role) : RedirectResponse
    {
        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    /**
     * @param Role $role
     * @return View
     */
    public function show(Role $role) : View
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions', 'rolesUsers');

        return view('admin.roles.show', compact('role'));
    }

}
