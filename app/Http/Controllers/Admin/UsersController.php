<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\User\MassDestroyUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Role;
use App\Services\UserService;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

class UsersController extends AdminController
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles'])->select(sprintf('%s.*', (new User)->table));

            return Datatables::of($query)
                ->addColumn('placeholder', '&nbsp;')
                ->addColumn('actions', '&nbsp;')
                ->editColumn('id', fn ($row) => $row->id ? $row->id : "")
                ->editColumn('roles', function ($row) {
                    $labels = [];
                    foreach ($row->roles as $role) {
                        $labels[] = sprintf('<span class="badge badge-info">%s</span>', $role->title);
                    }
                    return implode(' ', $labels);
                })
                ->editColumn('first_name', fn ($row) => $row->first_name ?? "")
                ->editColumn('last_name', fn ($row) => $row->last_name ?? "")
                ->editColumn('email', fn ($row) => $row->email ?? "")
                ->addColumn('position', fn ($row) => $row->position ?? '')
                ->addColumn('institution', fn ($row) => $row->institution ?? '')
                ->editColumn('phone', fn ($row) => $row->phone ?? '')
                ->editColumn('user_status', fn ($row) => $row->user_status ? User::USER_STATUS_SELECT[$row->user_status] : '')
                ->addColumn('actions', fn ($row) => $this->renderActionsRow($row, 'user'))
                ->rawColumns(['actions', 'placeholder', 'roles'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * @return View
     */
    public function create() : View
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * @param StoreUserRequest $request
     * @param UserService $userService
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request, UserService $userService) : RedirectResponse
    {
        /** @var User $user */
        $user = User::query()->create($request->all());

        $userService->handleRelationships($user, $request);

        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user) : View
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @param UserService $userService
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user, UserService $userService) : RedirectResponse
    {
        $userService->updateData($request, $user);

        $userService->handleRelationships($user, $request);

        return redirect()->route('admin.users.index');

    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user) : View
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'categories', 'subCategories', 'courses', 'documents');

        return view('admin.users.show', compact('user'));
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user) : RedirectResponse
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    /**
     * @param MassDestroyUserRequest $request
     * @return Response
     */
    public function massDestroy(MassDestroyUserRequest $request) : Response
    {
        User::query()->whereIn('id', $request->ids)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
