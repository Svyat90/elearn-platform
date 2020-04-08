@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.socialMedium.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.social-media.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.id') }}
                        </th>
                        <td>
                            {{ $socialMedium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.name') }}
                        </th>
                        <td>
                            {{ $socialMedium->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.short_code') }}
                        </th>
                        <td>
                            {{ $socialMedium->short_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialMedium.fields.website') }}
                        </th>
                        <td>
                            {{ $socialMedium->website }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.social-media.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection