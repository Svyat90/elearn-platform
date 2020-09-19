<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\MassDestroySubCategoryRequest;
use App\Http\Requests\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;
use App\Services\CategoryService;
use App\SubCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SubCategoryController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('sub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubCategory::with(['parent'])->select(sprintf('%s.*', (new SubCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->addColumn('actions', function ($row) {
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

            $localeColumn = localeColumn('name');

            $table->addColumn('id', fn ($row) => $row->id ?? '');
            $table->addColumn('name', fn ($row) => $row->$localeColumn ?? '');
            $table->addColumn('parent_name', fn ($row) => $row->parent->$localeColumn ?? '');
            $table->addColumn('access', fn ($row) => $row->access ?? '');
            $table->addColumn('created_at', fn ($row) => $row->created_at ?? '');

            $table->rawColumns(['actions', 'placeholder', 'parent']);

            return $table->make(true);
        }

        return view('admin.subCategories.index');
    }

    /**
     * @param CategoryService $categoryService
     * @return View
     */
    public function create(CategoryService $categoryService) : View
    {
        abort_if(Gate::denies('sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Category::all()
            ->pluck(localeColumn('name'), 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $accessTypes = collect($categoryService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subCategories.create', compact('parents', 'accessTypes'));
    }

    /**
     * @param StoreSubCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSubCategoryRequest $request) : RedirectResponse
    {
        SubCategory::query()->create($request->all());

        return redirect()->route('admin.sub-categories.index');
    }

    /**
     * @param CategoryService $categoryService
     * @param SubCategory $subCategory
     * @return View
     */
    public function edit(CategoryService $categoryService, SubCategory $subCategory) : View
    {
        abort_if(Gate::denies('sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Category::all()
            ->pluck(localeColumn('name'), 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $accessTypes = collect($categoryService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        $subCategory->load('parent');

        return view('admin.subCategories.edit', compact('parents', 'subCategory', 'accessTypes'));
    }

    /**
     * @param UpdateSubCategoryRequest $request
     * @param SubCategory $subCategory
     * @return RedirectResponse
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory) : RedirectResponse
    {
        $subCategory->update($request->all());

        return redirect()->route('admin.sub-categories.index');
    }

    /**
     * @param SubCategory $subCategory
     * @return View
     */
    public function show(SubCategory $subCategory) : View
    {
        abort_if(Gate::denies('sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCategory->load('parent');

        return view('admin.subCategories.show', compact('subCategory'));
    }

    /**
     * @param SubCategory $subCategory
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(SubCategory $subCategory) : RedirectResponse
    {
        abort_if(Gate::denies('sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCategory->delete();

        return back();
    }

    /**
     * @param MassDestroySubCategoryRequest $request
     * @return Response
     */
    public function massDestroy(MassDestroySubCategoryRequest $request) : Response
    {
        SubCategory::query()->whereIn('id', $request->ids)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
