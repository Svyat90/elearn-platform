<?php

namespace App\Http\Controllers\Admin;

use App\ArtistMetum;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserWishlistRequest;
use App\Http\Requests\StoreUserWishlistRequest;
use App\Http\Requests\UpdateUserWishlistRequest;
use App\User;
use App\UserWishlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserWishlistController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_wishlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserWishlist::with(['user', 'artist'])->select(sprintf('%s.*', (new UserWishlist)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_wishlist_show';
                $editGate      = 'user_wishlist_edit';
                $deleteGate    = 'user_wishlist_delete';
                $crudRoutePart = 'user-wishlists';

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
            $table->addColumn('user_first_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('artist_display_name', function ($row) {
                return $row->artist ? $row->artist->display_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'artist']);

            return $table->make(true);
        }

        return view('admin.userWishlists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_wishlist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::IsUserRole()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artists = ArtistMetum::all()->pluck('display_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userWishlists.create', compact('users', 'artists'));
    }

    public function store(StoreUserWishlistRequest $request)
    {
        $userWishlist = UserWishlist::create($request->all());

        return redirect()->route('admin.user-wishlists.index');

    }

    public function edit(UserWishlist $userWishlist)
    {
        abort_if(Gate::denies('user_wishlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::IsUserRole()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artists = ArtistMetum::all()->pluck('display_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userWishlist->load('user', 'artist');

        return view('admin.userWishlists.edit', compact('users', 'artists', 'userWishlist'));
    }

    public function update(UpdateUserWishlistRequest $request, UserWishlist $userWishlist)
    {
        $userWishlist->update($request->all());

        return redirect()->route('admin.user-wishlists.index');

    }

    public function show(UserWishlist $userWishlist)
    {
        abort_if(Gate::denies('user_wishlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userWishlist->load('user', 'artist');

        return view('admin.userWishlists.show', compact('userWishlist'));
    }

    public function destroy(UserWishlist $userWishlist)
    {
        abort_if(Gate::denies('user_wishlist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userWishlist->delete();

        return back();

    }

    public function massDestroy(MassDestroyUserWishlistRequest $request)
    {
        UserWishlist::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
