@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userReview.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userReview.fields.id') }}
                        </th>
                        <td>
                            {{ $userReview->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userReview.fields.review_text') }}
                        </th>
                        <td>
                            {!! $userReview->review_text !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userReview.fields.stars') }}
                        </th>
                        <td>
                            {{ $userReview->stars }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userReview.fields.show_video') }}
                        </th>
                        <td>
                            {{ App\UserReview::SHOW_VIDEO_RADIO[$userReview->show_video] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userReview.fields.review_apporval') }}
                        </th>
                        <td>
                            {{ App\UserReview::REVIEW_APPORVAL_SELECT[$userReview->review_apporval] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userReview.fields.video') }}
                        </th>
                        <td>
                            {{ $userReview->video->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection