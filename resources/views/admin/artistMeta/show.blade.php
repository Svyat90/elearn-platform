@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.artistMetum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artist-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.id') }}
                        </th>
                        <td>
                            {{ $artistMetum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.artist') }}
                        </th>
                        <td>
                            {{ $artistMetum->artist->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.display_name') }}
                        </th>
                        <td>
                            {{ $artistMetum->display_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.profile_info') }}
                        </th>
                        <td>
                            {!! $artistMetum->profile_info !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.languages') }}
                        </th>
                        <td>
                            @foreach($artistMetum->languages as $key => $languages)
                                <span class="label label-info">{{ $languages->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.main_catogery') }}
                        </th>
                        <td>
                            {{ $artistMetum->main_catogery->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.sub_category') }}
                        </th>
                        <td>
                            {{ $artistMetum->sub_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.tags') }}
                        </th>
                        <td>
                            @foreach($artistMetum->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.artist_fee') }}
                        </th>
                        <td>
                            {{ $artistMetum->artist_fee }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.artist_commission') }}
                        </th>
                        <td>
                            {{ $artistMetum->artist_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.company_commission') }}
                        </th>
                        <td>
                            {{ $artistMetum->company_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.order_status_email') }}
                        </th>
                        <td>
                            {{ $artistMetum->order_status_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.profile_photo_url') }}
                        </th>
                        <td>
                            @if($artistMetum->profile_photo_url)
                                <a href="{{ $artistMetum->profile_photo_url->getUrl() }}" target="_blank">
                                    <img src="{{ $artistMetum->profile_photo_url->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.intro_video_url') }}
                        </th>
                        <td>
                            @if($artistMetum->intro_video_url)
                                <a href="{{ $artistMetum->intro_video_url->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.url_name') }}
                        </th>
                        <td>
                            {{ $artistMetum->url_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.social_instagram') }}
                        </th>
                        <td>
                            {{ $artistMetum->social_instagram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.social_facebook') }}
                        </th>
                        <td>
                            {{ $artistMetum->social_facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.social_youtube') }}
                        </th>
                        <td>
                            {{ $artistMetum->social_youtube }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.social_tiktok') }}
                        </th>
                        <td>
                            {{ $artistMetum->social_tiktok }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.social_snapchat') }}
                        </th>
                        <td>
                            {{ $artistMetum->social_snapchat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.social_twitter') }}
                        </th>
                        <td>
                            {{ $artistMetum->social_twitter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.social_twitch') }}
                        </th>
                        <td>
                            {{ $artistMetum->social_twitch }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.social_linkedin') }}
                        </th>
                        <td>
                            {{ $artistMetum->social_linkedin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artistMetum.fields.artist_status') }}
                        </th>
                        <td>
                            {{ App\ArtistMetum::ARTIST_STATUS_SELECT[$artistMetum->artist_status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artist-meta.index') }}">
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
            <a class="nav-link" href="#artist_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#artist_artist_responses" role="tab" data-toggle="tab">
                {{ trans('cruds.artistResponse.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="artist_orders">
            @includeIf('admin.artistMeta.relationships.artistOrders', ['orders' => $artistMetum->artistOrders])
        </div>
        <div class="tab-pane" role="tabpanel" id="artist_artist_responses">
            @includeIf('admin.artistMeta.relationships.artistArtistResponses', ['artistResponses' => $artistMetum->artistArtistResponses])
        </div>
    </div>
</div>

@endsection