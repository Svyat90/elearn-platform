@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ArtistMetum">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.artistMetum.fields.id') }}
                    </th>
                    <th>
                        {{ trans('general.artistMetum.fields.artist') }}
                    </th>
                    <th>
                        {{ trans('cruds.artistMetum.fields.display_name') }}
                    </th>
                    <th>
                        {{ trans('general.artistMetum.fields.tagline') }}
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
                        {{ trans('general.artistMetum.fields.artist_fee') }}
                    </th>
                    <th>
                        {{ trans('general.artistMetum.fields.artist_commission') }}
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('artist_metum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.artist-meta.massDestroy') }}",
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
    ajax: "{{ route('admin.artist-meta.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'artist_first_name', name: 'artist.first_name' },
{ data: 'display_name', name: 'display_name' },
{ data: 'tagline', name: 'tagline' },
{ data: 'languages', name: 'languages.name' },
{ data: 'main_catogery_name', name: 'main_catogery.name' },
{ data: 'sub_category_name', name: 'sub_category.name' },
{ data: 'tags', name: 'tags.name' },
{ data: 'artist_fee', name: 'artist_fee' },
{ data: 'artist_commission', name: 'artist_commission' },
{ data: 'company_commission', name: 'company_commission' },
{ data: 'order_status_email', name: 'order_status_email' },
{ data: 'profile_photo_url', name: 'profile_photo_url', sortable: false, searchable: false },
{ data: 'intro_video_url', name: 'intro_video_url', sortable: false, searchable: false },
{ data: 'url_name', name: 'url_name' },
{ data: 'social_instagram', name: 'social_instagram' },
{ data: 'social_facebook', name: 'social_facebook' },
{ data: 'social_youtube', name: 'social_youtube' },
{ data: 'social_tiktok', name: 'social_tiktok' },
{ data: 'social_snapchat', name: 'social_snapchat' },
{ data: 'social_twitter', name: 'social_twitter' },
{ data: 'social_twitch', name: 'social_twitch' },
{ data: 'social_linkedin', name: 'social_linkedin' },
{ data: 'artist_status', name: 'artist_status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  $('.datatable-ArtistMetum').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection