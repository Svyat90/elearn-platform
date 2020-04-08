<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserWalletHistoryResource;
use App\UserWalletHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserWalletHistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_wallet_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserWalletHistoryResource(UserWalletHistory::with(['user', 'earn_from'])->get());

    }

    public function show(UserWalletHistory $userWalletHistory)
    {
        abort_if(Gate::denies('user_wallet_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserWalletHistoryResource($userWalletHistory->load(['user', 'earn_from']));

    }

    public function destroy(UserWalletHistory $userWalletHistory)
    {
        abort_if(Gate::denies('user_wallet_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userWalletHistory->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
