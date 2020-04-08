@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.artistEnquiry.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artist-enquiries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.id') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.artist') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->artist->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.name') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.email') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.contact_no') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.social_media_type') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->social_media_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.social_media') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->social_media }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.social_media_followrs') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->social_media_followrs }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.country') }}
                        </th>
                        <td>
                            {{ $artistEnquiry->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.note') }}
                        </th>
                        <td>
                            {!! $artistEnquiry->note !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistEnquiry.fields.status') }}
                        </th>
                        <td>
                            {{ App\ArtistEnquiry::STATUS_SELECT[$artistEnquiry->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artist-enquiries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection