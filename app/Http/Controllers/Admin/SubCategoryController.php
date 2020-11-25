<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Traits\AccessTypes;
use App\Http\Requests\SubCategory\MassDestroySubCategoryRequest;
use App\Http\Requests\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;
use App\Role;
use App\Services\SubCategoryService;
use App\SubCategory;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SubCategoryController extends AdminController
{
    use AccessTypes;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->shareAccessTypes();
    }

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

            $nameLocaleColumn = localeColumn('name');

            return Datatables::of($query)
                ->addColumn('placeholder', '&nbsp;')
                ->addColumn('actions', '&nbsp;')
                ->addColumn('id', fn ($row) => $row->id ?? '')
                ->editColumn($nameLocaleColumn, fn ($row) => $row->$nameLocaleColumn ?? '')
                ->editColumn('parent_name', fn ($row) => $row->parent->$nameLocaleColumn ?? '')
                ->editColumn('access', fn ($row) => labelAccess($row->access))
                ->addColumn('created_at', fn ($row) => $row->created_at ?? '')
                ->addColumn('actions', fn ($row) => $this->renderActionsRow($row, 'sub_category'))
                ->rawColumns(['actions', 'placeholder', 'parent', 'access'])
                ->make(true);
        }

        return view('admin.subCategories.index');
    }

    /**
     * @return View
     */
    public function create() : View
    {
        abort_if(Gate::denies('sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Category::all()
            ->pluck(localeColumn('name'), 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id');
        $users = User::all()->pluck('email', 'id');

        return view('admin.subCategories.create', compact(
            'parents',
            'roles',
            'users'
        ));
    }

    /**
     * @param SubCategoryService $subCategoryService
     * @param StoreSubCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(SubCategoryService $subCategoryService, StoreSubCategoryRequest $request) : RedirectResponse
    {
        /** @var SubCategory $subCategory */
        $subCategory = SubCategory::query()->create($request->all());

        $subCategoryService->handleRelationships($subCategory, $request);

        return redirect()->route('admin.sub_categories.index');
    }

    /**
     * @param SubCategory $subCategory
     * @return View
     */
    public function edit(SubCategory $subCategory) : View
    {
        abort_if(Gate::denies('sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Category::all()
            ->pluck(localeColumn('name'), 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $allUsers = User::all()->pluck('email', 'id');
        $allRoles = Role::all()->pluck('title', 'id');

        $roleIds = $subCategory->roles()->pluck('id')->toArray();
        $userIds = $subCategory->users()->pluck('id')->toArray();

        $subCategory->load('parent');

        return view('admin.subCategories.edit', compact(
            'parents',
            'subCategory',
            'allUsers',
            'allRoles',
            'roleIds',
            'userIds'
        ));
    }

    /**
     * @param SubCategoryService $subCategoryService
     * @param UpdateSubCategoryRequest $request
     * @param SubCategory $subCategory
     * @return RedirectResponse
     */
    public function update(SubCategoryService $subCategoryService, UpdateSubCategoryRequest $request, SubCategory $subCategory) : RedirectResponse
    {
        $subCategory->update($request->validated());

        $subCategoryService->handleRelationships($subCategory, $request);

        return redirect()->route('admin.sub_categories.index');
    }

    /**
     * @param SubCategory $subCategory
     * @return View
     */
    public function show(SubCategory $subCategory) : View
    {
        abort_if(Gate::denies('sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCategory->load('parent', 'users', 'roles', 'documents');

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
