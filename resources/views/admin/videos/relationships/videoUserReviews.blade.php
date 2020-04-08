<div class="m-3">
    @can('user_review_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.user-reviews.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.userReview.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.userReview.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-videoUserReviews">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.userReview.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.userReview.fields.text') }}
                            </th>
                            <th>
                                {{ trans('cruds.userReview.fields.stars') }}
                            </th>
                            <th>
                                {{ trans('cruds.userReview.fields.show_video') }}
                            </th>
                            <th>
                                {{ trans('cruds.userReview.fields.review_apporval') }}
                            </th>
                            <th>
                                {{ trans('cruds.userReview.fields.video') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userReviews as $key => $userReview)
                            <tr data-entry-id="{{ $userReview->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $userReview->id ?? '' }}
                                </td>
                                <td>
                                    {{ $userReview->text ?? '' }}
                                </td>
                                <td>
                                    {{ $userReview->stars ?? '' }}
                                </td>
                                <td>
                                    {{ App\UserReview::SHOW_VIDEO_RADIO[$userReview->show_video] ?? '' }}
                                </td>
                                <td>
                                    {{ App\UserReview::REVIEW_APPORVAL_SELECT[$userReview->review_apporval] ?? '' }}
                                </td>
                                <td>
                                    {{ $userReview->video->name ?? '' }}
                                </td>
                                <td>
                                    @can('user_review_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.user-reviews.show', $userReview->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('user_review_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.user-reviews.edit', $userReview->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('user_review_delete')
                                        <form action="{{ route('admin.user-reviews.destroy', $userReview->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_review_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-reviews.massDestroy') }}",
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
  $('.datatable-videoUserReviews:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection