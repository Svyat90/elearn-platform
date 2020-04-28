@extends('layouts.admin')
@section('content')

@include("admin._common.dateRangeHeader")

@can('agent_payment_history_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.agent-payment-histories.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.agentPaymentHistory.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.agentPaymentHistory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AgentPaymentHistory">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('agent_payment_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.agent-payment-histories.massDestroy') }}",
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
    ajax: "{!! isset($_GET['from']) ? route('admin.agent-payment-histories.index').'?from='.$_GET['from'].'&to='.$_GET['to'] : route('admin.agent-payment-histories.index') !!}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'txn_type', name: 'txn_type' },
{ data: 'any_fees', name: 'any_fees' },
{ data: 'any_charges', name: 'any_charges' },
{ data: 'final_amount', name: 'final_amount' },
{ data: 'txn_for', name: 'txn_for' },
{ data: 'txn_info', name: 'txn_info' },
{ data: 'status', name: 'status' },
{ data: 'proccesed_by', name: 'proccesed_by' },
{ data: 'user_referred_by', name: 'user.referred_by' },
{ data: 'user.referred_by', name: 'user.referred_by' },
{ data: 'earn_from_name', name: 'earn_from.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-AgentPaymentHistory').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection