<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLoginLogRequest;
use App\Http\Requests\StoreLoginLogRequest;
use App\Http\Requests\UpdateLoginLogRequest;
use App\LoginLog;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LoginLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('login_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LoginLog::with(['user'])->select(sprintf('%s.*', (new LoginLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'login_log_show';
                $editGate      = 'login_log_edit';
                $deleteGate    = 'login_log_delete';
                $crudRoutePart = 'login-logs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('ip_address', function ($row) {
                return $row->ip_address ? $row->ip_address : "";
            });
            $table->editColumn('login_from', function ($row) {
                return $row->login_from ? LoginLog::LOGIN_FROM_SELECT[$row->login_from] : '';
            });
            $table->editColumn('device', function ($row) {
                return $row->device ? $row->device : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.loginLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('login_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.loginLogs.create', compact('users'));
    }

    public function store(StoreLoginLogRequest $request)
    {
        $loginLog = LoginLog::create($request->all());

        return redirect()->route('admin.login-logs.index');

    }

    public function edit(LoginLog $loginLog)
    {
        abort_if(Gate::denies('login_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $loginLog->load('user');

        return view('admin.loginLogs.edit', compact('users', 'loginLog'));
    }

    public function update(UpdateLoginLogRequest $request, LoginLog $loginLog)
    {
        $loginLog->update($request->all());

        return redirect()->route('admin.login-logs.index');

    }

    public function show(LoginLog $loginLog)
    {
        abort_if(Gate::denies('login_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loginLog->load('user');

        return view('admin.loginLogs.show', compact('loginLog'));
    }

    public function destroy(LoginLog $loginLog)
    {
        abort_if(Gate::denies('login_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loginLog->delete();

        return back();

    }

    public function massDestroy(MassDestroyLoginLogRequest $request)
    {
        LoginLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
