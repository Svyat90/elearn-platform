<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderHistoryRequest;
use App\Http\Requests\UpdateOrderHistoryRequest;
use App\Http\Resources\Admin\OrderHistoryResource;
use App\OrderHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderHistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderHistoryResource(OrderHistory::with(['user', 'videos'])->get());

    }

    public function store(StoreOrderHistoryRequest $request)
    {
        $orderHistory = OrderHistory::create($request->all());
        $orderHistory->videos()->sync($request->input('videos', []));

        return (new OrderHistoryResource($orderHistory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(OrderHistory $orderHistory)
    {
        abort_if(Gate::denies('order_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrderHistoryResource($orderHistory->load(['user', 'videos']));

    }

    public function update(UpdateOrderHistoryRequest $request, OrderHistory $orderHistory)
    {
        $orderHistory->update($request->all());
        $orderHistory->videos()->sync($request->input('videos', []));

        return (new OrderHistoryResource($orderHistory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(OrderHistory $orderHistory)
    {
        abort_if(Gate::denies('order_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orderHistory->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
