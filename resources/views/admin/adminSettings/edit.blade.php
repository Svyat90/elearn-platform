@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.adminSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.admin-settings.update", [$adminSetting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="company_commission">{{ trans('cruds.adminSetting.fields.company_commission') }}</label>
                <input class="form-control {{ $errors->has('company_commission') ? 'is-invalid' : '' }}" type="number" name="company_commission" id="company_commission" value="{{ old('company_commission', $adminSetting->company_commission) }}" step="0.01">
                @if($errors->has('company_commission'))
                    <span class="text-danger">{{ $errors->first('company_commission') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.company_commission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referral_user_commision">{{ trans('cruds.adminSetting.fields.referral_user_commision') }}</label>
                <input class="form-control {{ $errors->has('referral_user_commision') ? 'is-invalid' : '' }}" type="number" name="referral_user_commision" id="referral_user_commision" value="{{ old('referral_user_commision', $adminSetting->referral_user_commision) }}" step="0.01">
                @if($errors->has('referral_user_commision'))
                    <span class="text-danger">{{ $errors->first('referral_user_commision') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.referral_user_commision_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referal_artist_commision">{{ trans('cruds.adminSetting.fields.referal_artist_commision') }}</label>
                <input class="form-control {{ $errors->has('referal_artist_commision') ? 'is-invalid' : '' }}" type="number" name="referal_artist_commision" id="referal_artist_commision" value="{{ old('referal_artist_commision', $adminSetting->referal_artist_commision) }}" step="0.01">
                @if($errors->has('referal_artist_commision'))
                    <span class="text-danger">{{ $errors->first('referal_artist_commision') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.referal_artist_commision_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referal_agent_commision">{{ trans('cruds.adminSetting.fields.referal_agent_commision') }}</label>
                <input class="form-control {{ $errors->has('referal_agent_commision') ? 'is-invalid' : '' }}" type="number" name="referal_agent_commision" id="referal_agent_commision" value="{{ old('referal_agent_commision', $adminSetting->referal_agent_commision) }}" step="0.01">
                @if($errors->has('referal_agent_commision'))
                    <span class="text-danger">{{ $errors->first('referal_agent_commision') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.referal_agent_commision_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_video_show_count_web">{{ trans('cruds.adminSetting.fields.artist_video_show_count_web') }}</label>
                <input class="form-control {{ $errors->has('artist_video_show_count_web') ? 'is-invalid' : '' }}" type="number" name="artist_video_show_count_web" id="artist_video_show_count_web" value="{{ old('artist_video_show_count_web', $adminSetting->artist_video_show_count_web) }}" step="1">
                @if($errors->has('artist_video_show_count_web'))
                    <span class="text-danger">{{ $errors->first('artist_video_show_count_web') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.artist_video_show_count_web_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="artist_video_show_count_app">{{ trans('cruds.adminSetting.fields.artist_video_show_count_app') }}</label>
                <input class="form-control {{ $errors->has('artist_video_show_count_app') ? 'is-invalid' : '' }}" type="number" name="artist_video_show_count_app" id="artist_video_show_count_app" value="{{ old('artist_video_show_count_app', $adminSetting->artist_video_show_count_app) }}" step="1">
                @if($errors->has('artist_video_show_count_app'))
                    <span class="text-danger">{{ $errors->first('artist_video_show_count_app') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.adminSetting.fields.artist_video_show_count_app_helper') }}</span>
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