@extends('layouts.admin')
@section('content')
    @can('document_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.documents.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.document.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.document.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Category">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.document.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.number') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.name') }} ({{ config('app.locale_default_column') }})
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.name_issuer') }} ({{ config('app.locale_default_column') }})
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.topic') }} ({{ config('app.locale_default_column') }})
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.access') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.approved_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.published_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.created_at') }}
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
            @can('document_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.documents.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
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
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            let nameLocaleColumn = '{{ localeColumn('name') }}';
            let nameIssuerLocaleColumn = '{{ localeColumn('name_issuer') }}';
            let topicLocaleColumn = '{{ localeColumn('topic') }}';

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.documents.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image'},
                    {data: 'type', name: 'type'},
                    {data: 'number', name: 'number'},
                    {data: nameLocaleColumn, name: nameLocaleColumn},
                    {data: nameIssuerLocaleColumn, name: nameIssuerLocaleColumn},
                    {data: topicLocaleColumn, name: topicLocaleColumn},
                    {data: 'access', name: 'access'},
                    {data: 'status', name: 'status'},
                    {data: 'approved_at', name: 'approved_at'},
                    {data: 'published_at', name: 'published_at'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: '{{ trans('global.actions') }}'}
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            };
            $('.datatable-Category').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });

    </script>
@endsection
