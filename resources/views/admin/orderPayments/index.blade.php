@extends('layouts.admin')
@section('content')
@can('order_payment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.order-payments.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.orderPayment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
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
                        {{ trans('cruds.orderPayment.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderPayment.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderPayment.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderPayment.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.orderPayment.fields.text') }}
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
{ data: 'amount', name: 'amount' },
{ data: 'name', name: 'name' },
{ data: 'address', name: 'address' },
{ data: 'phone', name: 'phone' },
{ data: 'text', name: 'text' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-OrderPayment').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection