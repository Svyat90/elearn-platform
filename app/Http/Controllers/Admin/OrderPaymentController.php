<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderPaymentRequest;
use App\OrderPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderPaymentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrderPayment::with(['order'])->select(sprintf('%s.*', (new OrderPayment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'order_payment_show';
                $editGate      = 'order_payment_edit';
                $deleteGate    = 'order_payment_delete';
                $crudRoutePart = 'order-payments';

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
            $table->addColumn('order_payment_status', function ($row) {
                return $row->order ? $row->order->payment_status : '';
            });

            $table->editColumn('payment_by', function ($row) {
                return $row->payment_by ? OrderPayment::PAYMENT_BY_SELECT[$row->payment_by] : '';
            });
            $table->editColumn('booking_amount', function ($row) {
                return $row->booking_amount ? $row->booking_amount : "";
            });
            $table->editColumn('recieved_amount', function ($row) {
                return $row->recieved_amount ? $row->recieved_amount : "";
            });
            $table->editColumn('payment_status', function ($row) {
                return $row->payment_status ? OrderPayment::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
            });
            $table->editColumn('pg_txnid', function ($row) {
                return $row->pg_txnid ? $row->pg_txnid : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'order']);

            return $table->make(true);
        }

        return view('admin.orderPayments.index');
    }

    public function show(OrderPayment $orderPayment)
    {
        abort_if(Gate::denies('order_payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderPayment->load('order');

        return view('admin.orderPayments.show', compact('orderPayment'));
    }

    public function destroy(OrderPayment $orderPayment)
    {
        abort_if(Gate::denies('order_payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderPayment->delete();

        return back();

    }

    public function massDestroy(MassDestroyOrderPaymentRequest $request)
    {
        OrderPayment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
