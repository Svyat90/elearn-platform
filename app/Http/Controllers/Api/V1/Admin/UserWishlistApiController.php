<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserWishlistRequest;
use App\Http\Requests\UpdateUserWishlistRequest;
use App\Http\Resources\Admin\UserWishlistResource;
use App\UserWishlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserWishlistApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_wishlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserWishlistResource(UserWishlist::with(['user', 'artist'])->get());

    }

    public function store(StoreUserWishlistRequest $request)
    {
        $userWishlist = UserWishlist::create($request->all());

        return (new UserWishlistResource($userWishlist))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(UserWishlist $userWishlist)
    {
        abort_if(Gate::denies('user_wishlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserWishlistResource($userWishlist->load(['user', 'artist']));

    }

    public function update(UpdateUserWishlistRequest $request, UserWishlist $userWishlist)
    {
        $userWishlist->update($request->all());

        return (new UserWishlistResource($userWishlist))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(UserWishlist $userWishlist)
    {
        abort_if(Gate::denies('user_wishlist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userWishlist->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
