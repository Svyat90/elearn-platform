<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\PaymentLog;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PaymentLogController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaymentLog::with(['user', 'order'])->select(sprintf('%s.*', (new PaymentLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'payment_log_show';
                $editGate      = 'payment_log_edit';
                $deleteGate    = 'payment_log_delete';
                $crudRoutePart = 'payment-logs';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('order_payment_status', function ($row) {
                return $row->order ? $row->order->payment_status : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->addColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at :'';
            });
            $table->addColumn('updated_at', function ($row) {
                return $row->updated_at ? $row->updated_at :'';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'order']);

            return $table->make(true);
        }

        return view('admin.paymentLogs.index');
    }

    public function show(PaymentLog $paymentLog)
    {
        abort_if(Gate::denies('payment_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentLog->load('user', 'order');

        return view('admin.paymentLogs.show', compact('paymentLog'));
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('payment_log_create') && Gate::denies('payment_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PaymentLog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
