@extends('layouts.admin')
@section('content')
@can('artist_enquiry_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.artist-enquiries.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.artistEnquiry.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.artistEnquiry.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ArtistEnquiry">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.artist') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.contact_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.social_media_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.social_media') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.social_media_followrs') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.country') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistEnquiry.fields.status') }}
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
@can('artist_enquiry_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.artist-enquiries.massDestroy') }}",
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
    ajax: "{{ route('admin.artist-enquiries.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'artist_first_name', name: 'artist.first_name' },
{ data: 'name', name: 'name' },
{ data: 'email', name: 'email' },
{ data: 'contact_no', name: 'contact_no' },
{ data: 'social_media_type', name: 'social_media_type' },
{ data: 'social_media', name: 'social_media' },
{ data: 'social_media_followrs', name: 'social_media_followrs' },
{ data: 'country_short_code', name: 'country.short_code' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-ArtistEnquiry').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection