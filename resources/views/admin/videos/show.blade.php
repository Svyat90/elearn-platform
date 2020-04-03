@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.video.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.videos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.id') }}
                        </th>
                        <td>
                            {{ $video->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.name') }}
                        </th>
                        <td>
                            {{ $video->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.text') }}
                        </th>
                        <td>
                            {!! $video->text !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.file') }}
                        </th>
                        <td>
                            @if($video->file)
                                <a href="{{ $video->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.user') }}
                        </th>
                        <td>
                            {{ $video->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.video.fields.status') }}
                        </th>
                        <td>
                            {{ App\Video::STATUS_SELECT[$video->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.videos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#video_user_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.userReview.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#video_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#video_order_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.orderHistory.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="video_user_reviews">
            @includeIf('admin.videos.relationships.videoUserReviews', ['userReviews' => $video->videoUserReviews])
        </div>
        <div class="tab-pane" role="tabpanel" id="video_orders">
            @includeIf('admin.videos.relationships.videoOrders', ['orders' => $video->videoOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="video_order_histories">
            @includeIf('admin.videos.relationships.videoOrderHistories', ['orderHistories' => $video->videoOrderHistories])
        </div>
    </div>
</div>

@endsection