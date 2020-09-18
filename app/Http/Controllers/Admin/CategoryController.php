<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\MassDestroyCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Category::query()->select(sprintf('%s.*', (new Category)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'category_show';
                $editGate      = 'category_edit';
                $deleteGate    = 'category_delete';
                $crudRoutePart = 'categories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', fn ($row) => $row->id ?? '');
            $table->editColumn('name', fn ($row) => $row->{localeColumn('name')} ?? '');
            $table->editColumn('access', fn ($row) => $row->access ?? '');

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.categories.index');
    }

    /**
     * @param CategoryService $categoryService
     * @return View
     */
    public function create(CategoryService $categoryService) : View
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessTypes = $categoryService->getAccessTypes();
        $accessTypesSelect = collect($accessTypes)
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.categories.create', compact('accessTypes', 'accessTypesSelect'));
    }

    /**
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request) : RedirectResponse
    {
        Category::query()->create($request->validated());

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param Category $category
     * @param CategoryService $categoryService
     * @return View
     */
    public function edit(Category $category, CategoryService $categoryService) : View
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessTypes = $categoryService->getAccessTypes();
        $accessTypesSelect = collect($accessTypes)
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.categories.edit', compact('category', 'accessTypes', 'accessTypesSelect'));
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category) : RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param Category $category
     * @return View
     */
    public function show(Category $category) : View
    {
        abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->load('parentSubCategories');

        return view('admin.categories.show', compact('category'));
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category) : RedirectResponse
    {
        abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        return back();
    }

    /**
     * @param MassDestroyCategoryRequest $request
     * @return Response
     */
    public function massDestroy(MassDestroyCategoryRequest $request) : Response
    {
        Category::query()->whereIn('id', $request->ids)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
