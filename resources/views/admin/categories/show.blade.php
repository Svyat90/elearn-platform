@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.category.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.id') }}
                        </th>
                        <td>
                            {{ $category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.color') }}
                        </th>
                        <td>
                            {{ $category->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.name') }}
                        </th>
                        <td>
                            {{ $category->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.image') }}
                        </th>
                        <td>
                            @if($category->image)
                                <a href="{{ $category->image->getUrl() }}" target="_blank">
                                    <img src="{{ $category->image->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
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
            <a class="nav-link" href="#parent_sub_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.subCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
<<<<<<< HEAD
            <a class="nav-link" href="#category_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
=======
            <a class="nav-link" href="#main_catogery_artist_meta" role="tab" data-toggle="tab">
                {{ trans('cruds.artistMetum.title') }}
>>>>>>> quickadminpanel_2020_04_08_10_05_50
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="parent_sub_categories">
            @includeIf('admin.categories.relationships.parentSubCategories', ['subCategories' => $category->parentSubCategories])
        </div>
<<<<<<< HEAD
        <div class="tab-pane" role="tabpanel" id="category_users">
            @includeIf('admin.categories.relationships.categoryUsers', ['users' => $category->categoryUsers])
=======
        <div class="tab-pane" role="tabpanel" id="main_catogery_artist_meta">
            @includeIf('admin.categories.relationships.mainCatogeryArtistMeta', ['artistMeta' => $category->mainCatogeryArtistMeta])
>>>>>>> quickadminpanel_2020_04_08_10_05_50
        </div>
    </div>
</div>

@endsection