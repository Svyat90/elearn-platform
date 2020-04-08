@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.agentMetum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agent-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.agentMetum.fields.id') }}
                        </th>
                        <td>
                            {{ $agentMetum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentMetum.fields.user') }}
                        </th>
                        <td>
                            {{ $agentMetum->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentMetum.fields.agent_commission') }}
                        </th>
                        <td>
                            {{ $agentMetum->agent_commission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentMetum.fields.state') }}
                        </th>
                        <td>
                            {{ $agentMetum->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentMetum.fields.city') }}
                        </th>
                        <td>
                            {{ $agentMetum->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentMetum.fields.agent_status') }}
                        </th>
                        <td>
                            {{ $agentMetum->agent_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentMetum.fields.registered_on') }}
                        </th>
                        <td>
                            {{ $agentMetum->registered_on }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.agentMetum.fields.agent') }}
                        </th>
                        <td>
                            {{ $agentMetum->agent->first_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.agent-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection