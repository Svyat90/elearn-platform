@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userWalletHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-wallet-histories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.userWalletHistory.fields.txn_type') }}</label>
                <select class="form-control {{ $errors->has('txn_type') ? 'is-invalid' : '' }}" name="txn_type" id="txn_type">
                    <option value disabled {{ old('txn_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\UserWalletHistory::TXN_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('txn_type', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('txn_type'))
                    <span class="text-danger">{{ $errors->first('txn_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userWalletHistory.fields.txn_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.userWalletHistory.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userWalletHistory.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="txn_info">{{ trans('cruds.userWalletHistory.fields.txn_info') }}</label>
                <input class="form-control {{ $errors->has('txn_info') ? 'is-invalid' : '' }}" type="text" name="txn_info" id="txn_info" value="{{ old('txn_info', '') }}">
                @if($errors->has('txn_info'))
                    <span class="text-danger">{{ $errors->first('txn_info') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userWalletHistory.fields.txn_info_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.userWalletHistory.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\UserWalletHistory::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userWalletHistory.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userWalletHistory.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userWalletHistory.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="earn_from_id">{{ trans('cruds.userWalletHistory.fields.earn_from') }}</label>
                <select class="form-control select2 {{ $errors->has('earn_from') ? 'is-invalid' : '' }}" name="earn_from_id" id="earn_from_id">
                    @foreach($earn_froms as $id => $earn_from)
                        <option value="{{ $id }}" {{ old('earn_from_id') == $id ? 'selected' : '' }}>{{ $earn_from }}</option>
                    @endforeach
                </select>
                @if($errors->has('earn_from'))
                    <span class="text-danger">{{ $errors->first('earn_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userWalletHistory.fields.earn_from_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection