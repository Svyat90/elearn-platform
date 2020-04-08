<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.agentPaymentHistory.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userAgentPaymentHistories">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.txn_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.any_fees') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.any_charges') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.final_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.txn_for') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.txn_info') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.proccesed_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.referred_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentPaymentHistory.fields.earn_from') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agentPaymentHistories as $key => $agentPaymentHistory)
                            <tr data-entry-id="{{ $agentPaymentHistory->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $agentPaymentHistory->id ?? '' }}
                                </td>
                                <td>
                                    {{ App\AgentPaymentHistory::TXN_TYPE_SELECT[$agentPaymentHistory->txn_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $agentPaymentHistory->any_fees ?? '' }}
                                </td>
                                <td>
                                    {{ $agentPaymentHistory->any_charges ?? '' }}
                                </td>
                                <td>
                                    {{ $agentPaymentHistory->final_amount ?? '' }}
                                </td>
                                <td>
                                    {{ App\AgentPaymentHistory::TXN_FOR_SELECT[$agentPaymentHistory->txn_for] ?? '' }}
                                </td>
                                <td>
                                    {{ $agentPaymentHistory->txn_info ?? '' }}
                                </td>
                                <td>
                                    {{ App\AgentPaymentHistory::STATUS_SELECT[$agentPaymentHistory->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $agentPaymentHistory->proccesed_by ?? '' }}
                                </td>
                                <td>
                                    {{ $agentPaymentHistory->user->referred_by ?? '' }}
                                </td>
                                <td>
                                    {{ $agentPaymentHistory->user->referred_by ?? '' }}
                                </td>
                                <td>
                                    {{ $agentPaymentHistory->earn_from->name ?? '' }}
                                </td>
                                <td>
                                    @can('agent_payment_history_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.agent-payment-histories.show', $agentPaymentHistory->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan


                                    @can('agent_payment_history_delete')
                                        <form action="{{ route('admin.agent-payment-histories.destroy', $agentPaymentHistory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('agent_payment_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.agent-payment-histories.massDestroy') }}",
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
  $('.datatable-userAgentPaymentHistories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection