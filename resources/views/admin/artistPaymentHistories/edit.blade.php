@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.artistPaymentHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.artist-payment-histories.update", [$artistPaymentHistory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.artistPaymentHistory.fields.txn_type') }}</label>
                <select class="form-control {{ $errors->has('txn_type') ? 'is-invalid' : '' }}" name="txn_type" id="txn_type">
                    <option value disabled {{ old('txn_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ArtistPaymentHistory::TXN_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('txn_type', $artistPaymentHistory->txn_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('txn_type'))
                    <span class="text-danger">{{ $errors->first('txn_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.txn_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="any_fees">{{ trans('cruds.artistPaymentHistory.fields.any_fees') }}</label>
                <input class="form-control {{ $errors->has('any_fees') ? 'is-invalid' : '' }}" type="number" name="any_fees" id="any_fees" value="{{ old('any_fees', $artistPaymentHistory->any_fees) }}" step="0.01">
                @if($errors->has('any_fees'))
                    <span class="text-danger">{{ $errors->first('any_fees') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.any_fees_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="any_charges">{{ trans('cruds.artistPaymentHistory.fields.any_charges') }}</label>
                <input class="form-control {{ $errors->has('any_charges') ? 'is-invalid' : '' }}" type="number" name="any_charges" id="any_charges" value="{{ old('any_charges', $artistPaymentHistory->any_charges) }}" step="0.01">
                @if($errors->has('any_charges'))
                    <span class="text-danger">{{ $errors->first('any_charges') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.any_charges_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="final_amount">{{ trans('cruds.artistPaymentHistory.fields.final_amount') }}</label>
                <input class="form-control {{ $errors->has('final_amount') ? 'is-invalid' : '' }}" type="number" name="final_amount" id="final_amount" value="{{ old('final_amount', $artistPaymentHistory->final_amount) }}" step="0.01">
                @if($errors->has('final_amount'))
                    <span class="text-danger">{{ $errors->first('final_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.final_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.artistPaymentHistory.fields.txn_for') }}</label>
                <select class="form-control {{ $errors->has('txn_for') ? 'is-invalid' : '' }}" name="txn_for" id="txn_for">
                    <option value disabled {{ old('txn_for', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ArtistPaymentHistory::TXN_FOR_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('txn_for', $artistPaymentHistory->txn_for) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('txn_for'))
                    <span class="text-danger">{{ $errors->first('txn_for') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.txn_for_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="txn_info">{{ trans('cruds.artistPaymentHistory.fields.txn_info') }}</label>
                <input class="form-control {{ $errors->has('txn_info') ? 'is-invalid' : '' }}" type="text" name="txn_info" id="txn_info" value="{{ old('txn_info', $artistPaymentHistory->txn_info) }}">
                @if($errors->has('txn_info'))
                    <span class="text-danger">{{ $errors->first('txn_info') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.txn_info_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.artistPaymentHistory.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\ArtistPaymentHistory::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $artistPaymentHistory->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proccesed_by">{{ trans('cruds.artistPaymentHistory.fields.proccesed_by') }}</label>
                <input class="form-control {{ $errors->has('proccesed_by') ? 'is-invalid' : '' }}" type="text" name="proccesed_by" id="proccesed_by" value="{{ old('proccesed_by', $artistPaymentHistory->proccesed_by) }}">
                @if($errors->has('proccesed_by'))
                    <span class="text-danger">{{ $errors->first('proccesed_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.proccesed_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.artistPaymentHistory.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($artistPaymentHistory->user ? $artistPaymentHistory->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="earn_from_id">{{ trans('cruds.artistPaymentHistory.fields.earn_from') }}</label>
                <select class="form-control select2 {{ $errors->has('earn_from') ? 'is-invalid' : '' }}" name="earn_from_id" id="earn_from_id">
                    @foreach($earn_froms as $id => $earn_from)
                        <option value="{{ $id }}" {{ ($artistPaymentHistory->earn_from ? $artistPaymentHistory->earn_from->id : old('earn_from_id')) == $id ? 'selected' : '' }}>{{ $earn_from }}</option>
                    @endforeach
                </select>
                @if($errors->has('earn_from'))
                    <span class="text-danger">{{ $errors->first('earn_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artistPaymentHistory.fields.earn_from_helper') }}</span>
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