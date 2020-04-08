@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.adminSetting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AdminSetting">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.adminSetting.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.adminSetting.fields.company_commission') }}
                    </th>
                    <th>
                        {{ trans('cruds.adminSetting.fields.referral_user_commision') }}
                    </th>
                    <th>
                        {{ trans('cruds.adminSetting.fields.referal_artist_commision') }}
                    </th>
                    <th>
                        {{ trans('cruds.adminSetting.fields.referal_agent_commision') }}
                    </th>
                    <th>
                        {{ trans('cruds.adminSetting.fields.artist_video_show_count_web') }}
                    </th>
                    <th>
                        {{ trans('cruds.adminSetting.fields.artist_video_show_count_app') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.admin-settings.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'company_commission', name: 'company_commission' },
{ data: 'referral_user_commision', name: 'referral_user_commision' },
{ data: 'referal_artist_commision', name: 'referal_artist_commision' },
{ data: 'referal_agent_commision', name: 'referal_agent_commision' },
{ data: 'artist_video_show_count_web', name: 'artist_video_show_count_web' },
{ data: 'artist_video_show_count_app', name: 'artist_video_show_count_app' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-AdminSetting').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection