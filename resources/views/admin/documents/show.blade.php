@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.category.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                @foreach($document->getFillable() as $field)
                    @if($field === 'image_path')
                        <tr>
                            <th>Image</th>
                            <td>{!! sprintf('<img src="%s" width="100px" />', storageUrl($document->{$field})) !!}</td>
                        </tr>
                    @elseif($field === 'file_path')
                        @php
                        $link = storageUrl($document->{$field});
                        $segments = explode("/", $link);
                        @endphp
                        <tr>
                            <th>File (PDF)</th>
                            <td>{!! $link ? sprintf('<a href="%s" target="_blank" />%s</a>', $link, $segments[count($segments)-1]) : '' !!}</td>
                        </tr>
                    @else
                        <tr>
                            <th>{{ trans("cruds.document.fields.{$field}") }}</th>
                            <td>{{ $document->{$field} }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        {{ trans('global.relatedData') }}--}}
{{--    </div>--}}
{{--    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#parent_sub_categories" role="tab" data-toggle="tab">--}}
{{--                {{ trans('cruds.subCategory.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}

{{--    </ul>--}}
{{--    <div class="tab-content">--}}
{{--        <div class="tab-pane" role="tabpanel" id="parent_sub_categories">--}}
{{--            @includeIf('admin.documents.relationships.parentSubCategories', ['subCategories' => $category->parentSubCategories])--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@endsection
