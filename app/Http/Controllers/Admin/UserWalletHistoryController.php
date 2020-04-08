<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserWalletHistoryRequest;
use App\UserWalletHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserWalletHistoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_wallet_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserWalletHistory::with(['user', 'earn_from'])->select(sprintf('%s.*', (new UserWalletHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_wallet_history_show';
                $editGate      = 'user_wallet_history_edit';
                $deleteGate    = 'user_wallet_history_delete';
                $crudRoutePart = 'user-wallet-histories';

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
                return $row->txn_type ? UserWalletHistory::TXN_TYPE_SELECT[$row->txn_type] : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->editColumn('txn_info', function ($row) {
                return $row->txn_info ? $row->txn_info : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? UserWalletHistory::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('user_referred_by', function ($row) {
                return $row->user ? $row->user->referred_by : '';
            });

            $table->addColumn('earn_from_first_name', function ($row) {
                return $row->earn_from ? $row->earn_from->first_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'earn_from']);

            return $table->make(true);
        }

        return view('admin.userWalletHistories.index');
    }

    public function show(UserWalletHistory $userWalletHistory)
    {
        abort_if(Gate::denies('user_wallet_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userWalletHistory->load('user', 'earn_from');

        return view('admin.userWalletHistories.show', compact('userWalletHistory'));
    }

    public function destroy(UserWalletHistory $userWalletHistory)
    {
        abort_if(Gate::denies('user_wallet_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userWalletHistory->delete();

        return back();

    }

    public function massDestroy(MassDestroyUserWalletHistoryRequest $request)
    {
        UserWalletHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
