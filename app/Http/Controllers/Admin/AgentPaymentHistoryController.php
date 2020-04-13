<?php

namespace App\Http\Controllers\Admin;

use App\AgentPaymentHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgentPaymentHistoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgentPaymentHistoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('agent_payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AgentPaymentHistory::with(['user', 'earn_from'])->select(sprintf('%s.*', (new AgentPaymentHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'agent_payment_history_show';
                $editGate      = 'agent_payment_history_edit';
                $deleteGate    = 'agent_payment_history_delete';
                $crudRoutePart = 'agent-payment-histories';

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
            $table->editColumn('txn_type', function ($row) {
                return $row->txn_type ? AgentPaymentHistory::TXN_TYPE_SELECT[$row->txn_type] : '';
            });
            $table->editColumn('any_fees', function ($row) {
                return $row->any_fees ? $row->any_fees : "";
            });
            $table->editColumn('any_charges', function ($row) {
                return $row->any_charges ? $row->any_charges : "";
            });
            $table->editColumn('final_amount', function ($row) {
                return $row->final_amount ? $row->final_amount : "";
            });
            $table->editColumn('txn_for', function ($row) {
                return $row->txn_for ? AgentPaymentHistory::TXN_FOR_SELECT[$row->txn_for] : '';
            });
            $table->editColumn('txn_info', function ($row) {
                return $row->txn_info ? $row->txn_info : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? AgentPaymentHistory::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('proccesed_by', function ($row) {
                return $row->proccesed_by ? $row->proccesed_by : "";
            });

            $table->editColumn('user.referred_by', function ($row) {
                return $row->user ? $row->user->first_name.' '.$row->user->last_name : '';
            });
            $table->addColumn('earn_from_name', function ($row) {
                return $row->earn_from ? $row->earn_from->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'earn_from']);

            return $table->make(true);
        }

        return view('admin.agentPaymentHistories.index');
    }

    public function show(AgentPaymentHistory $agentPaymentHistory)
    {
        abort_if(Gate::denies('agent_payment_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agentPaymentHistory->load('user', 'earn_from');

        return view('admin.agentPaymentHistories.show', compact('agentPaymentHistory'));
    }

    public function destroy(AgentPaymentHistory $agentPaymentHistory)
    {
        abort_if(Gate::denies('agent_payment_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agentPaymentHistory->delete();

        return back();

    }

    public function massDestroy(MassDestroyAgentPaymentHistoryRequest $request)
    {
        AgentPaymentHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
