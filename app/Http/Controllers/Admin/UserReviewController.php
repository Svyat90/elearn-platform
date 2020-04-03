<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserReviewRequest;
use App\Http\Requests\StoreUserReviewRequest;
use App\Http\Requests\UpdateUserReviewRequest;
use App\User;
use App\UserReview;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserReviewController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserReview::with(['user'])->select(sprintf('%s.*', (new UserReview)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_review_show';
                $editGate      = 'user_review_edit';
                $deleteGate    = 'user_review_delete';
                $crudRoutePart = 'user-reviews';

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

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.userReviews.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userReviews.create', compact('users'));
    }

    public function store(StoreUserReviewRequest $request)
    {
        $userReview = UserReview::create($request->all());

        return redirect()->route('admin.user-reviews.index');

    }

    public function edit(UserReview $userReview)
    {
        abort_if(Gate::denies('user_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userReview->load('user');

        return view('admin.userReviews.edit', compact('users', 'userReview'));
    }

    public function update(UpdateUserReviewRequest $request, UserReview $userReview)
    {
        $userReview->update($request->all());

        return redirect()->route('admin.user-reviews.index');

    }

    public function show(UserReview $userReview)
    {
        abort_if(Gate::denies('user_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userReview->load('user');

        return view('admin.userReviews.show', compact('userReview'));
    }

    public function destroy(UserReview $userReview)
    {
        abort_if(Gate::denies('user_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userReview->delete();

        return back();

    }

    public function massDestroy(MassDestroyUserReviewRequest $request)
    {
        UserReview::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
