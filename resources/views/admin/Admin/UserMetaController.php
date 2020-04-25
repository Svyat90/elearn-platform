<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserMetumRequest;
use App\Http\Requests\StoreUserMetumRequest;
use App\Http\Requests\UpdateUserMetumRequest;
use App\User;
use App\UserMetum;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserMetaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserMetum::with(['user'])->select(sprintf('%s.*', (new UserMetum)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_metum_show';
                $editGate      = 'user_metum_edit';
                $deleteGate    = 'user_metum_delete';
                $crudRoutePart = 'user-meta';

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
                return $row->user ? $row->user->first_name : '';
            });

            $table->editColumn('user.first_name', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->first_name) : '';
            });
            $table->editColumn('user_wishlist', function ($row) {
                return $row->user_wishlist ? $row->user_wishlist : "";
            });
            $table->editColumn('user_likelist', function ($row) {
                return $row->user_likelist ? $row->user_likelist : "";
            });
            $table->editColumn('wallet_balance', function ($row) {
                return $row->wallet_balance ? $row->wallet_balance : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.userMeta.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_metum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userMeta.create', compact('users'));
    }

    public function store(StoreUserMetumRequest $request)
    {
        $userMetum = UserMetum::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userMetum->id]);
        }

        return redirect()->route('admin.user-meta.index');

    }

    public function edit(UserMetum $userMetum)
    {
        abort_if(Gate::denies('user_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userMetum->load('user');

        return view('admin.userMeta.edit', compact('users', 'userMetum'));
    }

    public function update(UpdateUserMetumRequest $request, UserMetum $userMetum)
    {
        $userMetum->update($request->all());

        return redirect()->route('admin.user-meta.index');

    }

    public function show(UserMetum $userMetum)
    {
        abort_if(Gate::denies('user_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMetum->load('user');

        return view('admin.userMeta.show', compact('userMetum'));
    }

    public function destroy(UserMetum $userMetum)
    {
        abort_if(Gate::denies('user_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMetum->delete();

        return back();

    }

    public function massDestroy(MassDestroyUserMetumRequest $request)
    {
        UserMetum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_metum_create') && Gate::denies('user_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserMetum();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
