@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pageSeo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.page-seos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pageSeo.fields.id') }}
                        </th>
                        <td>
                            {{ $pageSeo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pageSeo.fields.page_url') }}
                        </th>
                        <td>
                            {{ $pageSeo->page_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pageSeo.fields.meta_title') }}
                        </th>
                        <td>
                            {{ $pageSeo->meta_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pageSeo.fields.meta_description') }}
                        </th>
                        <td>
                            {!! $pageSeo->meta_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pageSeo.fields.meta_keywords') }}
                        </th>
                        <td>
                            {!! $pageSeo->meta_keywords !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pageSeo.fields.social_image_url') }}
                        </th>
                        <td>
                            @if($pageSeo->social_image_url)
                                <a href="{{ $pageSeo->social_image_url->getUrl() }}" target="_blank">
                                    <img src="{{ $pageSeo->social_image_url->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.page-seos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection