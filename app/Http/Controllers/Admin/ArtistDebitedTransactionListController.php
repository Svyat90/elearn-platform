<?php

namespace App\Http\Controllers\Admin;

use App\ArtistPaymentHistory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArtistDebitedTransactionListController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('artist_payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $from = '';
        $to   = '';

        if (request('from')) {
            $from = Carbon::parse(request('from'))->format('Y-m-d');
        }

        if (request('to')) {
            $to = Carbon::parse(request('to'))->format('Y-m-d');
        }
        if ($request->ajax()) {
            $query = ArtistPaymentHistory::where('txn_type',2)->with(['user', 'earn_from'])->select(sprintf('%s.*', (new ArtistPaymentHistory)->table));
            if($from && $to) {
                $query = $query->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$from, $to]);
            }
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'artist_payment_history_show';
                $editGate      = '';
                $deleteGate    = '';
                $crudRoutePart = 'artist-payment-histories';

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
                return $row->txn_for ? ArtistPaymentHistory::TXN_FOR_SELECT[$row->txn_for] : '';
            });
            $table->editColumn('txn_info', function ($row) {
                return $row->txn_info ? $row->txn_info : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ArtistPaymentHistory::STATUS_SELECT[$row->status] : '';
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

        return view('admin.artistDebitedTransactionLists.index');
    }

}
