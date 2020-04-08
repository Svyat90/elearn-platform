<div class="m-3">
    @can('artist_metum_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.artist-meta.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.artistMetum.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.artistMetum.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-languagesArtistMeta">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.artist') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.display_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.languages') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.main_catogery') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.sub_category') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.tags') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.artist_fee') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.artist_commission') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.company_commission') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.order_status_email') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.profile_photo_url') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.intro_video_url') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.url_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.social_instagram') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.social_facebook') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.social_youtube') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.social_tiktok') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.social_snapchat') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.social_twitter') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.social_twitch') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.social_linkedin') }}
                            </th>
                            <th>
                                {{ trans('cruds.artistMetum.fields.artist_status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($artistMeta as $key => $artistMetum)
                            <tr data-entry-id="{{ $artistMetum->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $artistMetum->id ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->artist->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->display_name ?? '' }}
                                </td>
                                <td>
                                    @foreach($artistMetum->languages as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $artistMetum->main_catogery->name ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->sub_category->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($artistMetum->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $artistMetum->artist_fee ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->artist_commission ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->company_commission ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->order_status_email ?? '' }}
                                </td>
                                <td>
                                    @if($artistMetum->profile_photo_url)
                                        <a href="{{ $artistMetum->profile_photo_url->getUrl() }}" target="_blank">
                                            <img src="{{ $artistMetum->profile_photo_url->getUrl('thumb') }}" width="50px" height="50px">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($artistMetum->intro_video_url)
                                        <a href="{{ $artistMetum->intro_video_url->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $artistMetum->url_name ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->social_instagram ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->social_facebook ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->social_youtube ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->social_tiktok ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->social_snapchat ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->social_twitter ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->social_twitch ?? '' }}
                                </td>
                                <td>
                                    {{ $artistMetum->social_linkedin ?? '' }}
                                </td>
                                <td>
                                    {{ App\ArtistMetum::ARTIST_STATUS_SELECT[$artistMetum->artist_status] ?? '' }}
                                </td>
                                <td>
                                    @can('artist_metum_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.artist-meta.show', $artistMetum->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('artist_metum_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.artist-meta.edit', $artistMetum->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('artist_metum_delete')
                                        <form action="{{ route('admin.artist-meta.destroy', $artistMetum->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('artist_metum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.artist-meta.massDestroy') }}",
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
  $('.datatable-languagesArtistMeta:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection