<div class="m-3">
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
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-countryArtistEnquiries">
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
                    <tbody>
                        @foreach($artistEnquiries as $key => $artistEnquiry)
                            <tr data-entry-id="{{ $artistEnquiry->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $artistEnquiry->id ?? '' }}
                                </td>
                                <td>
                                    {{ $artistEnquiry->artist->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $artistEnquiry->name ?? '' }}
                                </td>
                                <td>
                                    {{ $artistEnquiry->email ?? '' }}
                                </td>
                                <td>
                                    {{ $artistEnquiry->contact_no ?? '' }}
                                </td>
                                <td>
                                    {{ $artistEnquiry->social_media_type ?? '' }}
                                </td>
                                <td>
                                    {{ $artistEnquiry->social_media ?? '' }}
                                </td>
                                <td>
                                    {{ $artistEnquiry->social_media_followrs ?? '' }}
                                </td>
                                <td>
                                    {{ $artistEnquiry->country->short_code ?? '' }}
                                </td>
                                <td>
                                    {{ App\ArtistEnquiry::STATUS_SELECT[$artistEnquiry->status] ?? '' }}
                                </td>
                                <td>
                                    @can('artist_enquiry_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.artist-enquiries.show', $artistEnquiry->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('artist_enquiry_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.artist-enquiries.edit', $artistEnquiry->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('artist_enquiry_delete')
                                        <form action="{{ route('admin.artist-enquiries.destroy', $artistEnquiry->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('artist_enquiry_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.artist-enquiries.massDestroy') }}",
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
  $('.datatable-countryArtistEnquiries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection