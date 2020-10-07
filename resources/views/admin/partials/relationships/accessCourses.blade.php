<div class="m-3">
@can('course_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.courses.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.course.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.course.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-documents">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.course.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.name') }} ({{ config('app.locale_default_column') }})
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.name_issuer') }} ({{ config('app.locale_default_column') }})
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.topic') }} ({{ config('app.locale_default_column') }})
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.access') }}
                    </th>
                    <th>
                        {{ trans('cruds.document.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.published_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.course.fields.created_at') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $key => $course)
                    <tr data-entry-id="{{ $course->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $course->id ?? '' }}
                        </td>
                        <td>
                            {!! sprintf('<img src="%s" width="100px" />', storageUrl($course->image_path, 'small')) !!}
                        </td>
                        <td>
                            {{ $course->{localeColumn('name')} }}
                        </td>
                        <td>
                            {{ $course->{localeColumn('name_issuer')} }}
                        </td>
                        <td>
                            {{ $course->{localeColumn('topic')} }}
                        </td>
                        <td>
                            {!! labelAccess($course->access) !!}
                        </td>
                        <td>
                            {!! labelStatus($document->status) !!}
                        </td>
                        <td>
                            {{ $course->published_at }}
                        </td>
                        <td>
                            {{ $course->created_at }}
                        </td>
                        <td>
                            @can('course_show')
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.courses.show', $course->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                            @endcan

                            @can('course_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.courses.edit', $course->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                            @endcan

                            @can('course_delete')
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                      onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
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
            @can('course_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.courses.massDestroy') }}",
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
            $('.datatable-documents:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
