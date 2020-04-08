@extends('layouts.admin')
@section('content')
@can('order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.orders.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Order">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.order.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.message') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.payment_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.language') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.video_for') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.video_from') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.from_gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.video_to') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.to_gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.customer_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.occasion_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.delivery_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.delivery_phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.hide_video') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.promo_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.promo_discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.booking_amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.booking_datetime') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.payment_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.order.fields.order_status') }}
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
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
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
    ajax: "{{ route('admin.orders.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'message', name: 'message' },
{ data: 'payment_status', name: 'payment_status' },
{ data: 'language_name', name: 'language.name' },
{ data: 'video_for', name: 'video_for' },
{ data: 'video_from', name: 'video_from' },
{ data: 'from_gender', name: 'from_gender' },
{ data: 'video_to', name: 'video_to' },
{ data: 'to_gender', name: 'to_gender' },
{ data: 'customer_name', name: 'customer_name' },
{ data: 'occasion_type_name', name: 'occasion_type.name' },
{ data: 'delivery_email', name: 'delivery_email' },
{ data: 'delivery_phone', name: 'delivery_phone' },
{ data: 'hide_video', name: 'hide_video' },
{ data: 'promo_code', name: 'promo_code' },
{ data: 'promo_discount', name: 'promo_discount' },
{ data: 'booking_amount', name: 'booking_amount' },
{ data: 'booking_datetime', name: 'booking_datetime' },
{ data: 'payment_by', name: 'payment_by' },
{ data: 'order_status', name: 'order_status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-Order').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection