<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLoginLogRequest;
use App\LoginLog;
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
            $table->addColumn('user_first_name', function ($row) {
                return $row->user ? $row->user->first_name : '';
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
            $table->addColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at :'';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.loginLogs.index');
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
