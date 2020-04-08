<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubCategoryRequest;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\SubCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubCategory::with(['parent'])->select(sprintf('%s.*', (new SubCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sub_category_show';
                $editGate      = 'sub_category_edit';
                $deleteGate    = 'sub_category_delete';
                $crudRoutePart = 'sub-categories';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : "";
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';

            });
            $table->addColumn('parent_name', function ($row) {
                return $row->parent ? $row->parent->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'parent']);

            return $table->make(true);
        }

        return view('admin.subCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subCategories.create', compact('parents'));
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $subCategory = SubCategory::create($request->all());

        if ($request->input('image', false)) {
            $subCategory->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $subCategory->id]);
        }

        return redirect()->route('admin.sub-categories.index');

    }

    public function edit(SubCategory $subCategory)
    {
        abort_if(Gate::denies('sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subCategory->load('parent');

        return view('admin.subCategories.edit', compact('parents', 'subCategory'));
    }

    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory->update($request->all());

        if ($request->input('image', false)) {
            if (!$subCategory->image || $request->input('image') !== $subCategory->image->file_name) {
                $subCategory->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }

        } elseif ($subCategory->image) {
            $subCategory->image->delete();
        }

        return redirect()->route('admin.sub-categories.index');

    }

    public function show(SubCategory $subCategory)
    {
        abort_if(Gate::denies('sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

<<<<<<< HEAD
        $subCategory->load('parent');
=======
        $subCategory->load('parent', 'subCategoryArtistMeta');
>>>>>>> quickadminpanel_2020_04_08_10_05_50

        return view('admin.subCategories.show', compact('subCategory'));
    }

    public function destroy(SubCategory $subCategory)
    {
        abort_if(Gate::denies('sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCategory->delete();

        return back();

    }

    public function massDestroy(MassDestroySubCategoryRequest $request)
    {
        SubCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sub_category_create') && Gate::denies('sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SubCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
