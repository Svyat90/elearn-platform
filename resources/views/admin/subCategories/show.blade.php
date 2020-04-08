@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $subCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $subCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.color') }}
                        </th>
                        <td>
                            {{ $subCategory->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.image') }}
                        </th>
                        <td>
                            @if($subCategory->image)
                                <a href="{{ $subCategory->image->getUrl() }}" target="_blank">
                                    <img src="{{ $subCategory->image->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subCategory.fields.parent') }}
                        </th>
                        <td>
                            {{ $subCategory->parent->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sub-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD

=======
<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#sub_category_artist_meta" role="tab" data-toggle="tab">
                {{ trans('cruds.artistMetum.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="sub_category_artist_meta">
            @includeIf('admin.subCategories.relationships.subCategoryArtistMeta', ['artistMeta' => $subCategory->subCategoryArtistMeta])
        </div>
    </div>
</div>
>>>>>>> quickadminpanel_2020_04_08_10_05_50

@endsection