@extends('layouts.admin')
@section('content')
@can('agent_metum_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.agent-meta.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.agentMetum.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.agentMetum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AgentMetum">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.agentMetum.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.agentMetum.fields.agent') }}
                    </th>
                    <th>
                        {{ trans('cruds.agentMetum.fields.agent_commission') }}
                    </th>
                    <th>
                        {{ trans('cruds.agentMetum.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.agentMetum.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.agentMetum.fields.agent_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.agentMetum.fields.registered_on') }}
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
@can('agent_metum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.agent-meta.massDestroy') }}",
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
    ajax: "{{ route('admin.agent-meta.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
        { data: 'agent_first_name', name: 'agent.first_name' },
{ data: 'agent_commission', name: 'agent_commission' },
{ data: 'state', name: 'state' },
{ data: 'city', name: 'city' },
{ data: 'agent_status', name: 'agent_status' },
{ data: 'registered_on', name: 'registered_on' },

{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-AgentMetum').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection