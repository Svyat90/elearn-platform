@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.searchLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.search-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.searchLog.fields.id') }}
                        </th>
                        <td>
                            {{ $searchLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.searchLog.fields.search_term') }}
                        </th>
                        <td>
                            {{ $searchLog->search_term }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.searchLog.fields.search_from') }}
                        </th>
                        <td>
                            {{ App\SearchLog::SEARCH_FROM_SELECT[$searchLog->search_from] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.search-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection