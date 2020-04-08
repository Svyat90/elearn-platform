<div class="m-3">
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
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-countryUsers">
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
                                {{ trans('cruds.user.fields.status') }}
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
                                {{ trans('cruds.user.fields.avatar') }}
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
                    <tbody>
                        @foreach($users as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $user->id ?? '' }}
                                </td>
                                <td>
                                    @foreach($user->roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $user->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->last_name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email_verified_at ?? '' }}
                                </td>
                                <td>
                                    {{ $user->mobile_no ?? '' }}
                                </td>
                                <td>
                                    {{ $user->country->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->gender->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->referral_code ?? '' }}
                                </td>
                                <td>
                                    {{ $user->referred_by ?? '' }}
                                </td>
                                <td>
                                    {{ App\User::REGISTRATION_PLATFORM_SELECT[$user->registration_platform] ?? '' }}
                                </td>
                                <td>
                                    {{ App\User::STATUS_SELECT[$user->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $user->ig_token ?? '' }}
                                </td>
                                <td>
                                    {{ $user->ig_username ?? '' }}
                                </td>
                                <td>
                                    {{ App\User::USER_STATUS_SELECT[$user->user_status] ?? '' }}
                                </td>
                                <td>
                                    {{ $user->birth_date ?? '' }}
                                </td>
                                <td>
                                    @if($user->avatar)
                                        <a href="{{ $user->avatar->getUrl() }}" target="_blank">
                                            <img src="{{ $user->avatar->getUrl('thumb') }}" width="50px" height="50px">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ App\User::REGISTRATION_SOURCE_SELECT[$user->registration_source] ?? '' }}
                                </td>
                                <td>
                                    {{ $user->registered_on ?? '' }}
                                </td>
                                <td>
                                    @can('user_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('user_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('user_delete')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  $('.datatable-countryUsers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection