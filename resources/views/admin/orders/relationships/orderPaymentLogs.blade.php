<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.paymentLog.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-orderPaymentLogs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.paymentLog.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.paymentLog.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.paymentLog.fields.order') }}
                            </th>
                            <th>
                                {{ trans('cruds.paymentLog.fields.amount') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paymentLogs as $key => $paymentLog)
                            <tr data-entry-id="{{ $paymentLog->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $paymentLog->id ?? '' }}
                                </td>
                                <td>
                                    {{ $paymentLog->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $paymentLog->order->payment_status ?? '' }}
                                </td>
                                <td>
                                    {{ $paymentLog->amount ?? '' }}
                                </td>
                                <td>
                                    @can('payment_log_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.payment-logs.show', $paymentLog->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  $('.datatable-orderPaymentLogs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection