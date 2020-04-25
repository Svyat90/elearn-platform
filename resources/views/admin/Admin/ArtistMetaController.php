<?php

namespace App\Http\Controllers\Admin;

use App\ArtistMetum;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArtistMetumRequest;
use App\Http\Requests\StoreArtistMetumRequest;
use App\Http\Requests\UpdateArtistMetumRequest;
use App\Language;
use App\SubCategory;
use App\Tag;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArtistMetaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('artist_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArtistMetum::with(['artist', 'languages', 'main_catogery', 'sub_category', 'tags'])->select(sprintf('%s.*', (new ArtistMetum)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'artist_metum_show';
                $editGate      = 'artist_metum_edit';
                $deleteGate    = 'artist_metum_delete';
                $crudRoutePart = 'artist-meta';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('artist_first_name', function ($row) {
                return $row->artist ? $row->artist->first_name : '';
            });

            $table->editColumn('display_name', function ($row) {
                return $row->display_name ? $row->display_name : "";
            });
            $table->editColumn('tagline', function ($row) {
                return $row->tagline ? $row->tagline : "";
            });
            $table->editColumn('languages', function ($row) {
                $labels = [];

                foreach ($row->languages as $language) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $language->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('main_catogery_name', function ($row) {
                return $row->main_catogery ? $row->main_catogery->name : '';
            });

            $table->addColumn('sub_category_name', function ($row) {
                return $row->sub_category ? $row->sub_category->name : '';
            });

            $table->editColumn('tags', function ($row) {
                $labels = [];

                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('artist_fee', function ($row) {
                return $row->artist_fee ? $row->artist_fee : "";
            });
            $table->editColumn('artist_commission', function ($row) {
                return $row->artist_commission ? $row->artist_commission : "";
            });
            $table->editColumn('company_commission', function ($row) {
                return $row->company_commission ? $row->company_commission : "";
            });
            $table->editColumn('order_status_email', function ($row) {
                return $row->order_status_email ? $row->order_status_email : "";
            });
            $table->editColumn('profile_photo_url', function ($row) {
                if ($photo = $row->profile_photo_url) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';

            });
            $table->editColumn('intro_video_url', function ($row) {
                return $row->intro_video_url ? '<a href="' . $row->intro_video_url->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('url_name', function ($row) {
                return $row->url_name ? $row->url_name : "";
            });
            $table->editColumn('social_instagram', function ($row) {
                return $row->social_instagram ? $row->social_instagram : "";
            });
            $table->editColumn('social_facebook', function ($row) {
                return $row->social_facebook ? $row->social_facebook : "";
            });
            $table->editColumn('social_youtube', function ($row) {
                return $row->social_youtube ? $row->social_youtube : "";
            });
            $table->editColumn('social_tiktok', function ($row) {
                return $row->social_tiktok ? $row->social_tiktok : "";
            });
            $table->editColumn('social_snapchat', function ($row) {
                return $row->social_snapchat ? $row->social_snapchat : "";
            });
            $table->editColumn('social_twitter', function ($row) {
                return $row->social_twitter ? $row->social_twitter : "";
            });
            $table->editColumn('social_twitch', function ($row) {
                return $row->social_twitch ? $row->social_twitch : "";
            });
            $table->editColumn('social_linkedin', function ($row) {
                return $row->social_linkedin ? $row->social_linkedin : "";
            });
            $table->editColumn('artist_status', function ($row) {
                return $row->artist_status ? ArtistMetum::ARTIST_STATUS_SELECT[$row->artist_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'artist', 'languages', 'main_catogery', 'sub_category', 'tags', 'profile_photo_url', 'intro_video_url']);

            return $table->make(true);
        }

        return view('admin.artistMeta.index');
    }

    public function create()
    {
        abort_if(Gate::denies('artist_metum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artists = User::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::all()->pluck('name', 'id');

        $main_catogeries = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_categories = SubCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::all()->pluck('name', 'id');

        return view('admin.artistMeta.create', compact('artists', 'languages', 'main_catogeries', 'sub_categories', 'tags'));
    }

    public function store(StoreArtistMetumRequest $request)
    {
        $artistMetum = ArtistMetum::create($request->all());
        $artistMetum->languages()->sync($request->input('languages', []));
        $artistMetum->tags()->sync($request->input('tags', []));

        if ($request->input('profile_photo_url', false)) {
            $artistMetum->addMedia(storage_path('tmp/uploads/' . $request->input('profile_photo_url')))->toMediaCollection('profile_photo_url');
        }

        if ($request->input('intro_video_url', false)) {
            $artistMetum->addMedia(storage_path('tmp/uploads/' . $request->input('intro_video_url')))->toMediaCollection('intro_video_url');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $artistMetum->id]);
        }

        return redirect()->route('admin.artist-meta.index');

    }

    public function edit(ArtistMetum $artistMetum)
    {
        abort_if(Gate::denies('artist_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artists = User::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $languages = Language::all()->pluck('name', 'id');

        $main_catogeries = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_categories = SubCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::all()->pluck('name', 'id');

        $artistMetum->load('artist', 'languages', 'main_catogery', 'sub_category', 'tags');

        return view('admin.artistMeta.edit', compact('artists', 'languages', 'main_catogeries', 'sub_categories', 'tags', 'artistMetum'));
    }

    public function update(UpdateArtistMetumRequest $request, ArtistMetum $artistMetum)
    {
        $artistMetum->update($request->all());
        $artistMetum->languages()->sync($request->input('languages', []));
        $artistMetum->tags()->sync($request->input('tags', []));

        if ($request->input('profile_photo_url', false)) {
            if (!$artistMetum->profile_photo_url || $request->input('profile_photo_url') !== $artistMetum->profile_photo_url->file_name) {
                $artistMetum->addMedia(storage_path('tmp/uploads/' . $request->input('profile_photo_url')))->toMediaCollection('profile_photo_url');
            }

        } elseif ($artistMetum->profile_photo_url) {
            $artistMetum->profile_photo_url->delete();
        }

        if ($request->input('intro_video_url', false)) {
            if (!$artistMetum->intro_video_url || $request->input('intro_video_url') !== $artistMetum->intro_video_url->file_name) {
                $artistMetum->addMedia(storage_path('tmp/uploads/' . $request->input('intro_video_url')))->toMediaCollection('intro_video_url');
            }

        } elseif ($artistMetum->intro_video_url) {
            $artistMetum->intro_video_url->delete();
        }

        return redirect()->route('admin.artist-meta.index');

    }

    public function show(ArtistMetum $artistMetum)
    {
        abort_if(Gate::denies('artist_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistMetum->load('artist', 'languages', 'main_catogery', 'sub_category', 'tags', 'artistOrders', 'artistArtistResponses', 'artistUserWishlists');

        return view('admin.artistMeta.show', compact('artistMetum'));
    }

    public function destroy(ArtistMetum $artistMetum)
    {
        abort_if(Gate::denies('artist_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistMetum->delete();

        return back();

    }

    public function massDestroy(MassDestroyArtistMetumRequest $request)
    {
        ArtistMetum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('artist_metum_create') && Gate::denies('artist_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ArtistMetum();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
