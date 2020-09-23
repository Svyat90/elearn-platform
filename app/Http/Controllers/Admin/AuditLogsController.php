<?php

namespace App\Http\Controllers\Admin;

use App\AuditLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AuditLogsController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('audit_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AuditLog::query()->select(sprintf('%s.*', (new AuditLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'audit_log_show';
                $editGate      = 'audit_log_edit';
                $deleteGate    = 'audit_log_delete';
                $crudRoutePart = 'audit-logs';

                return view('admin.partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', fn ($row) => $row->id ?? '');
            $table->editColumn('description', fn ($row) => $row->description ?? '');
            $table->editColumn('subject_id', fn ($row) => $row->subject_id ?? '');
            $table->editColumn('subject_type', fn ($row) => $row->subject_type ?? '');
            $table->editColumn('user_id', fn ($row) => $row->user_id ?? '');
            $table->editColumn('host', fn ($row) => $row->host ?? '');

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.auditLogs.index');
    }

    /**
     * @param AuditLog $auditLog
     * @return Application|Factory|View
     */
    public function show(AuditLog $auditLog)
    {
        abort_if(Gate::denies('audit_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.auditLogs.show', compact('auditLog'));
    }

}
