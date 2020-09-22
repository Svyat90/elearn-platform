<div class="m-3">
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
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-relatedDocuments">
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
                    <tbody>
                    @foreach($relatedDocuments as $key => $relatedDocument)
                        <tr data-entry-id="{{ $relatedDocument->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $relatedDocument->id }}
                            </td>
                            <td>
                                {!! sprintf('<img src="%s" width="50px" />', storageUrl($document->image_path)) !!}
                            </td>
                            <td>
                                {{ $relatedDocument->type }}
                            </td>
                            <td>
                                {{ $relatedDocument->number }}
                            </td>
                            <td>
                                {{ $relatedDocument->{localeColumn('name')} ?? '' }} ({{ config('app.locale_default_column') }})
                            </td>
                            <td>
                                {{ $relatedDocument->{localeColumn('name_issuer')} ?? '' }} ({{ config('app.locale_default_column') }})
                            </td>
                            <td>
                                {{ $relatedDocument->{localeColumn('topic')} ?? '' }} ({{ config('app.locale_default_column') }})
                            </td>
                            <td>
                                {!! labelAccess($document->access) !!}
                            </td>
                            <td>
                                {!! labelDocumentStatus($document->status) !!}
                            </td>
                            <td>
                                {{ $relatedDocument->approved_at }}
                            </td>
                            <td>
                                {{ $relatedDocument->published_at }}
                            </td>
                            <td>
                                {{ $relatedDocument->created_at }}
                            </td>
                            <td>
                                @can('document_show')
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.documents.show', $relatedDocument->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('document_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.documents.edit', $relatedDocument->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('document_delete')
                                    <form action="{{ route('admin.documents.destroy', $relatedDocument->id) }}"
                                          method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                          style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                               value="{{ trans('global.delete') }}">
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
            @can('document_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.documents.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
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

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'desc']],
                pageLength: 25,
            });
            $('.datatable-relatedDocuments:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
