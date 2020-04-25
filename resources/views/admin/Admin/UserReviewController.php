<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserReviewRequest;
use App\Http\Requests\StoreUserReviewRequest;
use App\Http\Requests\UpdateUserReviewRequest;
use App\UserReview;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserReviewController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserReview::with(['video'])->select(sprintf('%s.*', (new UserReview)->table));
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
            $table->editColumn('stars', function ($row) {
                return $row->stars ? $row->stars : "";
            });
            $table->editColumn('show_video', function ($row) {
                return $row->show_video ? UserReview::SHOW_VIDEO_RADIO[$row->show_video] : '';
            });
            $table->editColumn('review_apporval', function ($row) {
                return $row->review_apporval ? UserReview::REVIEW_APPORVAL_SELECT[$row->review_apporval] : '';
            });
            $table->addColumn('video_name', function ($row) {
                return $row->video ? $row->video->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'video']);

            return $table->make(true);
        }

        return view('admin.userReviews.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videos = Video::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userReviews.create', compact('videos'));
    }

    public function store(StoreUserReviewRequest $request)
    {
        $userReview = UserReview::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userReview->id]);
        }

        return redirect()->route('admin.user-reviews.index');

    }

    public function edit(UserReview $userReview)
    {
        abort_if(Gate::denies('user_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videos = Video::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userReview->load('video');

        return view('admin.userReviews.edit', compact('videos', 'userReview'));
    }

    public function update(UpdateUserReviewRequest $request, UserReview $userReview)
    {
        $userReview->update($request->all());

        return redirect()->route('admin.user-reviews.index');

    }

    public function show(UserReview $userReview)
    {
        abort_if(Gate::denies('user_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userReview->load('video');

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_review_create') && Gate::denies('user_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserReview();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
