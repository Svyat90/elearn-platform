@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.emailSubscription.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.email-subscriptions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.emailSubscription.fields.id') }}
                        </th>
                        <td>
                            {{ $emailSubscription->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailSubscription.fields.email_address') }}
                        </th>
                        <td>
                            {{ $emailSubscription->email_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailSubscription.fields.subscribed_on') }}
                        </th>
                        <td>
                            {{ $emailSubscription->subscribed_on }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailSubscription.fields.unsubscribed_on') }}
                        </th>
                        <td>
                            {{ $emailSubscription->unsubscribed_on }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emailSubscription.fields.status') }}
                        </th>
                        <td>
                            {{ App\EmailSubscription::STATUS_RADIO[$emailSubscription->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.email-subscriptions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection