@extends('layouts.admin')
@section('content')
@can('artist_response_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.artist-responses.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.artistResponse.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.artistResponse.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ArtistResponse">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.order') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.artist_action') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.video_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.video') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.artist_note') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.action_update') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.completion_update') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistResponse.fields.artist') }}
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
@can('artist_response_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.artist-responses.massDestroy') }}",
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
    ajax: "{{ route('admin.artist-responses.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'order_payment_status', name: 'order.payment_status' },
{ data: 'artist_action', name: 'artist_action' },
{ data: 'video_status', name: 'video_status' },
{ data: 'video_name', name: 'video.name' },
{ data: 'artist_note', name: 'artist_note' },
{ data: 'action_update', name: 'action_update' },
{ data: 'completion_update', name: 'completion_update' },
{ data: 'artist_display_name', name: 'artist.display_name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-ArtistResponse').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection