<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
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

            $nameLocaleColumn = localeColumn('name');

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('id', fn ($row) => $row->id ?? '');
            $table->editColumn($nameLocaleColumn, fn ($row) => $row->$nameLocaleColumn ?? '');
            $table->editColumn('parent_name', fn ($row) => $row->parent->$nameLocaleColumn ?? '');
            $table->editColumn('access', fn ($row) => labelAccess($row->access));
            $table->addColumn('created_at', fn ($row) => $row->created_at ?? '');
            $table->addColumn('actions', function ($row) {
                $viewGate      = 'sub_category_show';
                $editGate      = 'sub_category_edit';
                $deleteGate    = 'sub_category_delete';
                $crudRoutePart = 'sub-categories';

                return view('admin.partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->rawColumns(['actions', 'placeholder', 'parent', 'access']);

            return $table->make(true);
        }

        return view('admin.subCategories.index');
    }

    /**
     * @param SubCategoryService $subCategoryService
     * @return View
     */
    public function create(SubCategoryService $subCategoryService) : View
    {
        abort_if(Gate::denies('sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Category::all()
            ->pluck(localeColumn('name'), 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $accessTypes = collect($subCategoryService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        $roles = Role::all()->pluck('title', 'id');
        $users = User::all()->pluck('email', 'id');

        return view('admin.subCategories.create', compact(
            'parents',
            'accessTypes',
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
        /** @var SubCategoryService $subCategory */
        $subCategory = SubCategory::query()->create($request->all());

        $subCategoryService->handleRelationships($subCategory, $request);

        return redirect()->route('admin.sub-categories.index');
    }

    /**
     * @param SubCategoryService $subCategoryService
     * @param SubCategory $subCategory
     * @return View
     */
    public function edit(SubCategoryService $subCategoryService, SubCategory $subCategory) : View
    {
        abort_if(Gate::denies('sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Category::all()
            ->pluck(localeColumn('name'), 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $accessTypes = collect($subCategoryService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        $allUsers = User::all()->pluck('email', 'id');
        $allRoles = Role::all()->pluck('title', 'id');

        $roleIds = $subCategory->roles()->pluck('id')->toArray();
        $userIds = $subCategory->users()->pluck('id')->toArray();

        $subCategory->load('parent');

        return view('admin.subCategories.edit', compact(
            'parents',
            'subCategory',
            'accessTypes',
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

        return redirect()->route('admin.sub-categories.index');
    }

    /**
     * @param SubCategory $subCategory
     * @return View
     */
    public function show(SubCategory $subCategory) : View
    {
        abort_if(Gate::denies('sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCategory->load('parent', 'users', 'roles');

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
