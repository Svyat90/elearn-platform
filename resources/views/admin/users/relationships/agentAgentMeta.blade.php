<div class="m-3">
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
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-agentAgentMeta">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.agentMetum.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.agentMetum.fields.user') }}
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
                                {{ trans('cruds.agentMetum.fields.agent') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agentMeta as $key => $agentMetum)
                            <tr data-entry-id="{{ $agentMetum->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $agentMetum->id ?? '' }}
                                </td>
                                <td>
                                    {{ $agentMetum->user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $agentMetum->agent_commission ?? '' }}
                                </td>
                                <td>
                                    {{ $agentMetum->state ?? '' }}
                                </td>
                                <td>
                                    {{ $agentMetum->city ?? '' }}
                                </td>
                                <td>
                                    {{ $agentMetum->agent_status ?? '' }}
                                </td>
                                <td>
                                    {{ $agentMetum->registered_on ?? '' }}
                                </td>
                                <td>
                                    {{ $agentMetum->agent->first_name ?? '' }}
                                </td>
                                <td>
                                    @can('agent_metum_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.agent-meta.show', $agentMetum->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('agent_metum_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.agent-meta.edit', $agentMetum->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('agent_metum_delete')
                                        <form action="{{ route('admin.agent-meta.destroy', $agentMetum->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('agent_metum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.agent-meta.massDestroy') }}",
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
  $('.datatable-agentAgentMeta:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection