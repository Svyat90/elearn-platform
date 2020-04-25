@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.user.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.roles') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.first_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.last_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email_verified_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.mobile_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.country') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.referral_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.referred_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.registration_platform') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.ig_token') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.ig_username') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.user_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.birth_date') }}
                    </th>
                    <th>
                        {{ trans('general.user.fields.avatar') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.registration_source') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.registered_on') }}
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
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.users.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'roles', name: 'roles.title' },
{ data: 'first_name', name: 'first_name' },
{ data: 'last_name', name: 'last_name' },
{ data: 'email', name: 'email' },
{ data: 'email_verified_at', name: 'email_verified_at' },
{ data: 'mobile_no', name: 'mobile_no' },
{ data: 'country_name', name: 'country.name' },
{ data: 'gender_name', name: 'gender.name' },
{ data: 'referral_code', name: 'referral_code' },
{ data: 'referred_by', name: 'referred_by' },
{ data: 'registration_platform', name: 'registration_platform' },
{ data: 'ig_token', name: 'ig_token' },
{ data: 'ig_username', name: 'ig_username' },
{ data: 'user_status', name: 'user_status' },
{ data: 'birth_date', name: 'birth_date' },
{ data: 'avatar', name: 'avatar', sortable: false, searchable: false },
{ data: 'registration_source', name: 'registration_source' },
{ data: 'registered_on', name: 'registered_on' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-User').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection