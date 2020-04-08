@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.artistResponse.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artist-responses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.artistResponse.fields.id') }}
                        </th>
                        <td>
                            {{ $artistResponse->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistResponse.fields.order') }}
                        </th>
                        <td>
                            {{ $artistResponse->order->payment_status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistResponse.fields.artist_action') }}
                        </th>
                        <td>
                            {{ App\ArtistResponse::ARTIST_ACTION_SELECT[$artistResponse->artist_action] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistResponse.fields.video_status') }}
                        </th>
                        <td>
                            {{ App\ArtistResponse::VIDEO_STATUS_SELECT[$artistResponse->video_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistResponse.fields.video') }}
                        </th>
                        <td>
                            {{ $artistResponse->video->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistResponse.fields.artist_note') }}
                        </th>
                        <td>
                            {{ $artistResponse->artist_note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistResponse.fields.action_update') }}
                        </th>
                        <td>
                            {{ $artistResponse->action_update }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistResponse.fields.completion_update') }}
                        </th>
                        <td>
                            {{ $artistResponse->completion_update }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artist-responses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection