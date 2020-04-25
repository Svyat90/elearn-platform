<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserLikeRequest;
use App\Http\Requests\StoreUserLikeRequest;
use App\Http\Requests\UpdateUserLikeRequest;
use App\User;
use App\UserLike;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserLikeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_like_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserLike::with(['user', 'video'])->select(sprintf('%s.*', (new UserLike)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_like_show';
                $editGate      = 'user_like_edit';
                $deleteGate    = 'user_like_delete';
                $crudRoutePart = 'user-likes';

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

            $table->addColumn('video_name', function ($row) {
                return $row->video ? $row->video->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'video']);

            return $table->make(true);
        }

        return view('admin.userLikes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_like_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videos = Video::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userLikes.create', compact('users', 'videos'));
    }

    public function store(StoreUserLikeRequest $request)
    {
        $userLike = UserLike::create($request->all());

        return redirect()->route('admin.user-likes.index');

    }

    public function edit(UserLike $userLike)
    {
        abort_if(Gate::denies('user_like_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videos = Video::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userLike->load('user', 'video');

        return view('admin.userLikes.edit', compact('users', 'videos', 'userLike'));
    }

    public function update(UpdateUserLikeRequest $request, UserLike $userLike)
    {
        $userLike->update($request->all());

        return redirect()->route('admin.user-likes.index');

    }

    public function show(UserLike $userLike)
    {
        abort_if(Gate::denies('user_like_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLike->load('user', 'video');

        return view('admin.userLikes.show', compact('userLike'));
    }

    public function destroy(UserLike $userLike)
    {
        abort_if(Gate::denies('user_like_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLike->delete();

        return back();

    }

    public function massDestroy(MassDestroyUserLikeRequest $request)
    {
        UserLike::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
