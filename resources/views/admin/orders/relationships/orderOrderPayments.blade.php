<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.orderPayment.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-orderOrderPayments">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.orderPayment.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderPayment.fields.order') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderPayment.fields.payment_by') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderPayment.fields.booking_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderPayment.fields.recieved_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderPayment.fields.payment_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.orderPayment.fields.pg_txnid') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderPayments as $key => $orderPayment)
                            <tr data-entry-id="{{ $orderPayment->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $orderPayment->id ?? '' }}
                                </td>
                                <td>
                                    {{ $orderPayment->order->payment_status ?? '' }}
                                </td>
                                <td>
                                    {{ App\OrderPayment::PAYMENT_BY_SELECT[$orderPayment->payment_by] ?? '' }}
                                </td>
                                <td>
                                    {{ $orderPayment->booking_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $orderPayment->recieved_amount ?? '' }}
                                </td>
                                <td>
                                    {{ App\OrderPayment::PAYMENT_STATUS_SELECT[$orderPayment->payment_status] ?? '' }}
                                </td>
                                <td>
                                    {{ $orderPayment->pg_txnid ?? '' }}
                                </td>
                                <td>
                                    @can('order_payment_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.order-payments.show', $orderPayment->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan


                                    @can('order_payment_delete')
                                        <form action="{{ route('admin.order-payments.destroy', $orderPayment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('order_payment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.order-payments.massDestroy') }}",
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
  $('.datatable-orderOrderPayments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection