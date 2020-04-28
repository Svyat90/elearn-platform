<?php

namespace App\Http\Controllers\Admin;

use App\AgentPaymentHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgentPaymentHistoryRequest;
use App\Http\Requests\StoreAgentPaymentHistoryRequest;
use App\Http\Requests\UpdateAgentPaymentHistoryRequest;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgentPaymentHistoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('agent_payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $from = '';
        $to   = '';

        if (request('from')) {
            $from = Carbon::parse(request('from'))->format('Y-m-d');
        }

        if (request('to')) {
            $to = Carbon::parse(request('to'))->format('Y-m-d');
        }

        if ($request->ajax()) {
            $query = AgentPaymentHistory::with(['user', 'earn_from'])->select(sprintf('%s.*', (new AgentPaymentHistory)->table));
            if($from && $to) {
                $query = $query->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$from, $to]);
            }
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
            $table->addColumn('user_referred_by', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.referred_by', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->referral_code) : '';
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

        return view('admin.agentPaymentHistories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('agent_payment_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::IsUserRole()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $earn_froms = User::IsFrontUsersRole()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.agentPaymentHistories.create', compact('users', 'earn_froms'));
    }

    public function store(StoreAgentPaymentHistoryRequest $request)
    {
        $agentPaymentHistory = AgentPaymentHistory::create($request->all());

        return redirect()->route('admin.agent-payment-histories.index');

    }

    public function edit(AgentPaymentHistory $agentPaymentHistory)
    {
        abort_if(Gate::denies('agent_payment_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::IsUserRole()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $earn_froms = User::IsFrontUsersRole()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agentPaymentHistory->load('user', 'earn_from');

        return view('admin.agentPaymentHistories.edit', compact('users', 'earn_froms', 'agentPaymentHistory'));
    }

    public function update(UpdateAgentPaymentHistoryRequest $request, AgentPaymentHistory $agentPaymentHistory)
    {
        $agentPaymentHistory->update($request->all());

        return redirect()->route('admin.agent-payment-histories.index');

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
