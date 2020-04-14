@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.orderPayment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-OrderPayment">
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
                    <th>Created</th>
                    <th>Updated</th>
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
@can('order_payment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.order-payments.massDestroy') }}",
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
    ajax: "{{ route('admin.order-payments.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'order_payment_status', name: 'order.payment_status' },
{ data: 'payment_by', name: 'payment_by' },
{ data: 'booking_amount', name: 'booking_amount' },
{ data: 'recieved_amount', name: 'recieved_amount' },
{ data: 'payment_status', name: 'payment_status' },
{ data: 'pg_txnid', name: 'pg_txnid' },
        { data: 'created_at', name: 'created_at' },
        { data: 'updated_at', name: 'updated_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-OrderPayment').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection