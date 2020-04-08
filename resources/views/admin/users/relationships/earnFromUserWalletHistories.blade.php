<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.userWalletHistory.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-earnFromUserWalletHistories">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.userWalletHistory.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.userWalletHistory.fields.txn_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.userWalletHistory.fields.amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.userWalletHistory.fields.txn_info') }}
                            </th>
                            <th>
                                {{ trans('cruds.userWalletHistory.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.userWalletHistory.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.userWalletHistory.fields.earn_from') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userWalletHistories as $key => $userWalletHistory)
                            <tr data-entry-id="{{ $userWalletHistory->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $userWalletHistory->id ?? '' }}
                                </td>
                                <td>
                                    {{ App\UserWalletHistory::TXN_TYPE_SELECT[$userWalletHistory->txn_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $userWalletHistory->amount ?? '' }}
                                </td>
                                <td>
                                    {{ $userWalletHistory->txn_info ?? '' }}
                                </td>
                                <td>
                                    {{ App\UserWalletHistory::STATUS_SELECT[$userWalletHistory->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $userWalletHistory->user->referred_by ?? '' }}
                                </td>
                                <td>
                                    {{ $userWalletHistory->earn_from->first_name ?? '' }}
                                </td>
                                <td>
                                    @can('user_wallet_history_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.user-wallet-histories.show', $userWalletHistory->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan


                                    @can('user_wallet_history_delete')
                                        <form action="{{ route('admin.user-wallet-histories.destroy', $userWalletHistory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_wallet_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-wallet-histories.massDestroy') }}",
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
  $('.datatable-earnFromUserWalletHistories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection