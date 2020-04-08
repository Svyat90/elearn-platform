<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.artistPaymentHistory.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userArtistPaymentHistories">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.txn_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.any_fees') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.any_charges') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.final_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.txn_for') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.txn_info') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.proccesed_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.referred_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistPaymentHistory.fields.earn_from') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($artistPaymentHistories as $key => $artistPaymentHistory)
                            <tr data-entry-id="{{ $artistPaymentHistory->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $artistPaymentHistory->id ?? '' }}
                                </td>
                                <td>
                                    {{ App\ArtistPaymentHistory::TXN_TYPE_SELECT[$artistPaymentHistory->txn_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $artistPaymentHistory->any_fees ?? '' }}
                                </td>
                                <td>
                                    {{ $artistPaymentHistory->any_charges ?? '' }}
                                </td>
                                <td>
                                    {{ $artistPaymentHistory->final_amount ?? '' }}
                                </td>
                                <td>
                                    {{ App\ArtistPaymentHistory::TXN_FOR_SELECT[$artistPaymentHistory->txn_for] ?? '' }}
                                </td>
                                <td>
                                    {{ $artistPaymentHistory->txn_info ?? '' }}
                                </td>
                                <td>
                                    {{ App\ArtistPaymentHistory::STATUS_SELECT[$artistPaymentHistory->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $artistPaymentHistory->proccesed_by ?? '' }}
                                </td>
                                <td>
                                    {{ $artistPaymentHistory->user->referred_by ?? '' }}
                                </td>
                                <td>
                                    {{ $artistPaymentHistory->user->referred_by ?? '' }}
                                </td>
                                <td>
                                    {{ $artistPaymentHistory->earn_from->name ?? '' }}
                                </td>
                                <td>
                                    @can('artist_payment_history_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.artist-payment-histories.show', $artistPaymentHistory->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan


                                    @can('artist_payment_history_delete')
                                        <form action="{{ route('admin.artist-payment-histories.destroy', $artistPaymentHistory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('artist_payment_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.artist-payment-histories.massDestroy') }}",
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
  $('.datatable-userArtistPaymentHistories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection