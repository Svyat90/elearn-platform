<?php

namespace App\Http\Controllers\Admin;

use App\AuditLog;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AuditLogsController extends AdminController
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

            return Datatables::of($query)
                ->addColumn('placeholder', '&nbsp;')
                ->addColumn('actions', '&nbsp;')
                ->editColumn('id', fn ($row) => $row->id ?? '')
                ->editColumn('description', fn ($row) => $row->description ?? '')
                ->editColumn('subject_id', fn ($row) => $row->subject_id ?? '')
                ->editColumn('subject_type', fn ($row) => $row->subject_type ?? '')
                ->editColumn('user_id', fn ($row) => $row->user_id ?? '')
                ->editColumn('host', fn ($row) => $row->host ?? '')
                ->addColumn('actions', fn ($row) => $this->renderActionsRow($row, 'audit_log'))
                ->rawColumns(['actions', 'placeholder'])
                ->make(true);
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
