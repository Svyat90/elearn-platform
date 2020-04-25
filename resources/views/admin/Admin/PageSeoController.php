<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPageSeoRequest;
use App\Http\Requests\StorePageSeoRequest;
use App\Http\Requests\UpdatePageSeoRequest;
use App\PageSeo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PageSeoController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('page_seo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PageSeo::query()->select(sprintf('%s.*', (new PageSeo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'page_seo_show';
                $editGate      = 'page_seo_edit';
                $deleteGate    = 'page_seo_delete';
                $crudRoutePart = 'page-seos';

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
            $table->editColumn('page_url', function ($row) {
                return $row->page_url ? $row->page_url : "";
            });
            $table->editColumn('meta_title', function ($row) {
                return $row->meta_title ? $row->meta_title : "";
            });
            $table->editColumn('social_image_url', function ($row) {
                if ($photo = $row->social_image_url) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';

            });

            $table->rawColumns(['actions', 'placeholder', 'social_image_url']);

            return $table->make(true);
        }

        return view('admin.pageSeos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('page_seo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageSeos.create');
    }

    public function store(StorePageSeoRequest $request)
    {
        $pageSeo = PageSeo::create($request->all());

        if ($request->input('social_image_url', false)) {
            $pageSeo->addMedia(storage_path('tmp/uploads/' . $request->input('social_image_url')))->toMediaCollection('social_image_url');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pageSeo->id]);
        }

        return redirect()->route('admin.page-seos.index');

    }

    public function edit(PageSeo $pageSeo)
    {
        abort_if(Gate::denies('page_seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageSeos.edit', compact('pageSeo'));
    }

    public function update(UpdatePageSeoRequest $request, PageSeo $pageSeo)
    {
        $pageSeo->update($request->all());

        if ($request->input('social_image_url', false)) {
            if (!$pageSeo->social_image_url || $request->input('social_image_url') !== $pageSeo->social_image_url->file_name) {
                $pageSeo->addMedia(storage_path('tmp/uploads/' . $request->input('social_image_url')))->toMediaCollection('social_image_url');
            }

        } elseif ($pageSeo->social_image_url) {
            $pageSeo->social_image_url->delete();
        }

        return redirect()->route('admin.page-seos.index');

    }

    public function show(PageSeo $pageSeo)
    {
        abort_if(Gate::denies('page_seo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pageSeos.show', compact('pageSeo'));
    }

    public function destroy(PageSeo $pageSeo)
    {
        abort_if(Gate::denies('page_seo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageSeo->delete();

        return back();

    }

    public function massDestroy(MassDestroyPageSeoRequest $request)
    {
        PageSeo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('page_seo_create') && Gate::denies('page_seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PageSeo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
