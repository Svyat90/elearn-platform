<?php

namespace App\Http\Controllers\Admin;

use App\AgentPaymentHistory;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgentDebitedTransactionListController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('agent_payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AgentPaymentHistory::where('txn_type',2)->with(['user', 'earn_from'])->select(sprintf('%s.*', (new AgentPaymentHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'agent_payment_history_show';
                $editGate      = '';
                $deleteGate    = '';
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
            $table->addColumn('user_referred_by', function ($row) {
                return $row->user ? $row->user->referred_by : '';
            });

            $table->editColumn('user.referred_by', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->referred_by) : '';
            });
            $table->addColumn('earn_from_name', function ($row) {
                return $row->earn_from ? $row->earn_from->name : '';
            });
            $table->addColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at :'';
            });
            $table->addColumn('updated_at', function ($row) {
                return $row->updated_at ? $row->updated_at :'';
            });
            $table->rawColumns(['actions', 'placeholder', 'user', 'earn_from']);

            return $table->make(true);
        }

        return view('admin.agentDebitedTransactionLists.index');
    }

}
