@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.occasion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.occasions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.occasion.fields.id') }}
                        </th>
                        <td>
                            {{ $occasion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.occasion.fields.name') }}
                        </th>
                        <td>
                            {{ $occasion->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.occasions.index') }}">
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
            <a class="nav-link" href="#occasion_type_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="occasion_type_orders">
            @includeIf('admin.occasions.relationships.occasionTypeOrders', ['orders' => $occasion->occasionTypeOrders])
        </div>
    </div>
</div>
>>>>>>> quickadminpanel_2020_04_08_10_05_50

@endsection