<div class="m-3">
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
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-orderArtistResponses">
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
                    <tbody>
                        @foreach($artistResponses as $key => $artistResponse)
                            <tr data-entry-id="{{ $artistResponse->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $artistResponse->id ?? '' }}
                                </td>
                                <td>
                                    {{ $artistResponse->order->payment_status ?? '' }}
                                </td>
                                <td>
                                    {{ App\ArtistResponse::ARTIST_ACTION_SELECT[$artistResponse->artist_action] ?? '' }}
                                </td>
                                <td>
                                    {{ App\ArtistResponse::VIDEO_STATUS_SELECT[$artistResponse->video_status] ?? '' }}
                                </td>
                                <td>
                                    {{ $artistResponse->video->name ?? '' }}
                                </td>
                                <td>
                                    {{ $artistResponse->artist_note ?? '' }}
                                </td>
                                <td>
                                    {{ $artistResponse->action_update ?? '' }}
                                </td>
                                <td>
                                    {{ $artistResponse->completion_update ?? '' }}
                                </td>
                                <td>
                                    {{ $artistResponse->artist->display_name ?? '' }}
                                </td>
                                <td>
                                    @can('artist_response_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.artist-responses.show', $artistResponse->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('artist_response_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.artist-responses.edit', $artistResponse->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('artist_response_delete')
                                        <form action="{{ route('admin.artist-responses.destroy', $artistResponse->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('artist_response_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.artist-responses.massDestroy') }}",
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
  $('.datatable-orderArtistResponses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection