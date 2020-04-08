<?php

namespace App\Http\Controllers\Admin;

use App\ArtistPaymentHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyArtistPaymentHistoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArtistPaymentHistoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('artist_payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArtistPaymentHistory::with(['user', 'earn_from'])->select(sprintf('%s.*', (new ArtistPaymentHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'artist_payment_history_show';
                $editGate      = 'artist_payment_history_edit';
                $deleteGate    = 'artist_payment_history_delete';
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
            $table->editColumn('txn_type', function ($row) {
                return $row->txn_type ? ArtistPaymentHistory::TXN_TYPE_SELECT[$row->txn_type] : '';
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

            $table->rawColumns(['actions', 'placeholder', 'user', 'earn_from']);

            return $table->make(true);
        }

        return view('admin.artistPaymentHistories.index');
    }

    public function show(ArtistPaymentHistory $artistPaymentHistory)
    {
        abort_if(Gate::denies('artist_payment_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistPaymentHistory->load('user', 'earn_from');

        return view('admin.artistPaymentHistories.show', compact('artistPaymentHistory'));
    }

    public function destroy(ArtistPaymentHistory $artistPaymentHistory)
    {
        abort_if(Gate::denies('artist_payment_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistPaymentHistory->delete();

        return back();

    }

    public function massDestroy(MassDestroyArtistPaymentHistoryRequest $request)
    {
        ArtistPaymentHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
