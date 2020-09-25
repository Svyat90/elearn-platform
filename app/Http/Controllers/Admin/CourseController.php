<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Course;
use App\Document;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AccessStatuses;
use App\Http\Controllers\Traits\AccessTypes;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Course\MassDestroyCourseRequest;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Role;
use App\Services\CourseService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CourseController extends Controller
{
    use MediaUploadingTrait, AccessTypes, AccessStatuses;

    /**
     * CourseController constructor.
     */
    public function __construct()
    {
        $this->shareAccessTypes();
        $this->shareAccessStatuses();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Course::query()->select(sprintf('%s.*', (new Course)->table));
            $table = Datatables::of($query);

            $nameLocaleColumn = localeColumn('name');
            $nameIssuerLocaleColumn = localeColumn('name_issuer');
            $topicLocaleColumn = localeColumn('topic');

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('id', fn ($row) => $row->id ?? '');
            $table->editColumn($nameLocaleColumn, fn ($row) => $row->$nameLocaleColumn ?? '');
            $table->editColumn($nameIssuerLocaleColumn, fn ($row) => $row->$nameIssuerLocaleColumn ?? '');
            $table->editColumn($topicLocaleColumn, fn ($row) => $row->$topicLocaleColumn ?? '');
            $table->editColumn('access', fn ($row) => labelAccess($row->access));
            $table->editColumn('status', fn ($row) => labelStatus($row->status));
            $table->addColumn('published_at', fn ($row) => $row->published_at ?? '');
            $table->addColumn('image', fn ($row) => $row->image_path ? sprintf('<img src="%s" width="50px" height="50px" />', storageUrl($row->image_path)) : '');
            $table->addColumn('actions', function ($row) {
                $viewGate      = 'course_show';
                $editGate      = 'course_edit';
                $deleteGate    = 'course_delete';
                $crudRoutePart = 'courses';

                return view('admin.partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'access', 'status']);

            return $table->make(true);
        }

        return view('admin.courses.index');
    }

    /**
     * @param CourseService $courseService
     * @return View
     */
    public function create(CourseService $courseService) : View
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck(localeColumn('name'), 'id');
        $documents = Document::all()->pluck(localeColumn('name'), 'id');
        $users = User::all()->pluck('email', 'id');
        $roles = Role::all()->pluck('title', 'id');

        $accessTypes = collect($courseService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courses.create', compact(
            'accessTypes',
                'categories',
                'documents',
                'roles',
                'users'
            )
        );
    }

    /**
     * @param StoreCourseRequest $request
     * @param CourseService $courseService
     * @return RedirectResponse
     */
    public function store(StoreCourseRequest $request, CourseService $courseService) : RedirectResponse
    {
        /** @var Course $course */
        $course = Course::query()->create($request->validated());

        $courseService->handleRelationships($course, $request);

        return redirect()->route('admin.courses.index');
    }

    /**
     * @param Course $course
     * @param CourseService $courseService
     * @return View
     */
    public function edit(Course $course, CourseService $courseService) : View
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allCategories = Category::all()->pluck(localeColumn('name'), 'id');
        $allDocuments = Document::all()->pluck(localeColumn('name'), 'id');
        $allUsers = User::all()->pluck('email', 'id');
        $allRoles = Role::all()->pluck('title', 'id');

        $categoryIds = $course->categories()->pluck('id')->toArray();
        $documentIds = $course->documents()->pluck('id')->toArray();
        $roleIds = $course->roles()->pluck('id')->toArray();
        $userIds = $course->users()->pluck('id')->toArray();

        $accessTypes = collect($courseService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courses.edit', compact(
            'course',
            'accessTypes',
            'categoryIds',
            'documentIds',
            'roleIds',
            'userIds',
            'allCategories',
            'allDocuments',
            'allUsers',
            'allRoles'
            )
        );
    }

    /**
     * @param UpdateCourseRequest $request
     * @param Course $course
     * @param CourseService $courseService
     * @return RedirectResponse
     */
    public function update(
        UpdateCourseRequest $request,
        Course $course,
        CourseService $courseService
    ) : RedirectResponse
    {
        $courseService->handleImage($course, $request->image_path);
        $courseService->handleRelationships($course, $request);

        $course->update($request->validated());

        return redirect()->route('admin.courses.index');
    }

    /**
     * @param Course $course
     * @return View
     */
    public function show(Course $course) : View
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('categories', 'roles', 'users', 'documents');

        return view('admin.courses.show', compact('course'));
    }

    /**
     * @param Course $course
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Course $course) : RedirectResponse
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back();
    }

    /**
     * @param MassDestroyCourseRequest $request
     * @return Response
     */
    public function massDestroy(MassDestroyCourseRequest $request) : Response
    {
        Course::query()->whereIn('id', $request->ids)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
