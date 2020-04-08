<div class="m-3">
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
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-languageOrders">
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
                                {{ trans('cruds.order.fields.artist') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                            <tr data-entry-id="{{ $order->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $order->id ?? '' }}
                                </td>
                                <td>
                                    {{ $order->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->message ?? '' }}
                                </td>
                                <td>
                                    {{ App\Order::PAYMENT_STATUS_SELECT[$order->payment_status] ?? '' }}
                                </td>
                                <td>
                                    {{ $order->language->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->video_for ?? '' }}
                                </td>
                                <td>
                                    {{ $order->video_from ?? '' }}
                                </td>
                                <td>
                                    {{ $order->from_gender ?? '' }}
                                </td>
                                <td>
                                    {{ $order->video_to ?? '' }}
                                </td>
                                <td>
                                    {{ $order->to_gender ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->occasion_type->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->delivery_email ?? '' }}
                                </td>
                                <td>
                                    {{ $order->delivery_phone ?? '' }}
                                </td>
                                <td>
                                    {{ $order->hide_video ?? '' }}
                                </td>
                                <td>
                                    {{ $order->promo_code ?? '' }}
                                </td>
                                <td>
                                    {{ $order->promo_discount ?? '' }}
                                </td>
                                <td>
                                    {{ $order->booking_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $order->booking_datetime ?? '' }}
                                </td>
                                <td>
                                    {{ App\Order::PAYMENT_BY_SELECT[$order->payment_by] ?? '' }}
                                </td>
                                <td>
                                    {{ App\Order::ORDER_STATUS_SELECT[$order->order_status] ?? '' }}
                                </td>
                                <td>
                                    {{ $order->artist->display_name ?? '' }}
                                </td>
                                <td>
                                    @can('order_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('order_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('order_delete')
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
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
  $('.datatable-languageOrders:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection