<?php

namespace App\Http\Controllers\Admin;

use App\ArtistMetum;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Language;
use App\Occasion;
use App\Order;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Order::with(['user', 'language', 'occasion_type', 'artist'])->select(sprintf('%s.*', (new Order)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'order_show';
                $editGate      = 'order_edit';
                $deleteGate    = 'order_delete';
                $crudRoutePart = 'orders';

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

            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : "";
            });
            $table->editColumn('payment_status', function ($row) {
                return $row->payment_status ? Order::PAYMENT_STATUS_SELECT[$row->payment_status] : '';
            });
            $table->addColumn('language_name', function ($row) {
                return $row->language ? $row->language->name : '';
            });

            $table->editColumn('from_gender', function ($row) {
                return $row->from_gender ? $row->from_gender : "";
            });
            $table->editColumn('video_to', function ($row) {
                return $row->video_to ? $row->video_to : "";
            });
            $table->editColumn('to_gender', function ($row) {
                return $row->to_gender ? $row->to_gender : "";
            });
            $table->editColumn('customer_name', function ($row) {
                return $row->customer_name ? $row->customer_name : "";
            });
            $table->addColumn('occasion_type_name', function ($row) {
                return $row->occasion_type ? $row->occasion_type->name : '';
            });

            $table->editColumn('delivery_email', function ($row) {
                return $row->delivery_email ? $row->delivery_email : "";
            });
            $table->editColumn('delivery_phone', function ($row) {
                return $row->delivery_phone ? $row->delivery_phone : "";
            });
            $table->editColumn('promo_code', function ($row) {
                return $row->promo_code ? $row->promo_code : "";
            });
            $table->editColumn('promo_discount', function ($row) {
                return $row->promo_discount ? $row->promo_discount : "";
            });
            $table->editColumn('booking_amount', function ($row) {
                return $row->booking_amount ? $row->booking_amount : "";
            });

            $table->editColumn('payment_by', function ($row) {
                return $row->payment_by ? Order::PAYMENT_BY_SELECT[$row->payment_by] : '';
            });
            $table->editColumn('order_status', function ($row) {
                return $row->order_status ? Order::ORDER_STATUS_SELECT[$row->order_status] : '';
            });
            $table->addColumn('artist_display_name', function ($row) {
                return $row->artist ? $row->artist->display_name : '';
            });

            $table->editColumn('video_for', function ($row) {
                return $row->video_for ? Order::VIDEO_FOR_SELECT[$row->video_for] : '';
            });
            $table->editColumn('video_from', function ($row) {
                return $row->video_from ? Order::VIDEO_FROM_SELECT[$row->video_from] : '';
            });
            $table->editColumn('hide_video', function ($row) {
                return $row->hide_video ? Order::HIDE_VIDEO_SELECT[$row->hide_video] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'language', 'occasion_type', 'artist']);

            return $table->make(true);
        }

        return view('admin.orders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::IsUserRole()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $occasion_types = Occasion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artists = ArtistMetum::all()->pluck('display_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('users', 'languages', 'occasion_types', 'artists'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        return redirect()->route('admin.orders.index');

    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::IsUserRole()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $occasion_types = Occasion::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artists = ArtistMetum::all()->pluck('display_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('user', 'language', 'occasion_type', 'artist');

        return view('admin.orders.edit', compact('users', 'languages', 'occasion_types', 'artists', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.orders.index');

    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('user', 'language', 'occasion_type', 'artist', 'orderOrderPayments', 'orderPaymentLogs', 'orderArtistResponses');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();

    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
