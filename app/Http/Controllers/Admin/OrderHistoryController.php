<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderHistoryRequest;
use App\Http\Requests\StoreOrderHistoryRequest;
use App\Http\Requests\UpdateOrderHistoryRequest;
use App\Order;
use App\OrderHistory;
use App\User;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OrderHistory::with(['user', 'videos', 'order'])->select(sprintf('%s.*', (new OrderHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'order_history_show';
                $editGate      = 'order_history_edit';
                $deleteGate    = 'order_history_delete';
                $crudRoutePart = 'order-histories';

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

            $table->editColumn('video', function ($row) {
                $labels = [];

                foreach ($row->videos as $video) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $video->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('order_message', function ($row) {
                return $row->order ? $row->order->message : '';
            });

            $table->editColumn('order.message', function ($row) {
                return $row->order ? (is_string($row->order) ? $row->order : $row->order->message) : '';
            });
            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? OrderHistory::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'video', 'order']);

            return $table->make(true);
        }

        return view('admin.orderHistories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('order_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videos = Video::all()->pluck('name', 'id');

        $orders = Order::all()->pluck('message', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orderHistories.create', compact('users', 'videos', 'orders'));
    }

    public function store(StoreOrderHistoryRequest $request)
    {
        $orderHistory = OrderHistory::create($request->all());
        $orderHistory->videos()->sync($request->input('videos', []));

        return redirect()->route('admin.order-histories.index');

    }

    public function edit(OrderHistory $orderHistory)
    {
        abort_if(Gate::denies('order_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videos = Video::all()->pluck('name', 'id');

        $orders = Order::all()->pluck('message', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orderHistory->load('user', 'videos', 'order');

        return view('admin.orderHistories.edit', compact('users', 'videos', 'orders', 'orderHistory'));
    }

    public function update(UpdateOrderHistoryRequest $request, OrderHistory $orderHistory)
    {
        $orderHistory->update($request->all());
        $orderHistory->videos()->sync($request->input('videos', []));

        return redirect()->route('admin.order-histories.index');

    }

    public function show(OrderHistory $orderHistory)
    {
        abort_if(Gate::denies('order_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderHistory->load('user', 'videos', 'order');

        return view('admin.orderHistories.show', compact('orderHistory'));
    }

    public function destroy(OrderHistory $orderHistory)
    {
        abort_if(Gate::denies('order_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderHistory->delete();

        return back();

    }

    public function massDestroy(MassDestroyOrderHistoryRequest $request)
    {
        OrderHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
