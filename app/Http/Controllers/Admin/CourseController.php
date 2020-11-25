<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Course;
use App\Document;
use App\Helpers\ImageHelper;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Traits\AccessStatuses;
use App\Http\Controllers\Traits\AccessTypes;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Course\MassDestroyCourseRequest;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Role;
use App\Services\Course\CourseService;
use App\Services\ImageService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CourseController extends AdminController
{
    use MediaUploadingTrait, AccessTypes, AccessStatuses;

    /**
     * CourseController constructor.
     */
    public function __construct()
    {
        parent::__construct();
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

            $nameLocale = localeColumn('name');
            $nameIssuerLocale = localeColumn('name_issuer');
            $topicLocale = localeColumn('topic');

            return Datatables::of($query)
                ->addColumn('placeholder', '&nbsp;')
                ->addColumn('actions', '&nbsp;')
                ->editColumn('id', fn ($row) => $row->id ?? '')
                ->editColumn($nameLocale, fn ($row) => $row->$nameLocale ?? '')
                ->editColumn($nameIssuerLocale, fn ($row) => $row->$nameIssuerLocale ?? '')
                ->editColumn($topicLocale, fn ($row) => $row->$topicLocale ?? '')
                ->editColumn('access', fn ($row) => labelAccess($row->access))
                ->editColumn('status', fn ($row) => labelStatus($row->status))
                ->addColumn('published_at', fn ($row) => $row->published_at ?? '')
                ->addColumn('image', fn ($row) => ImageHelper::smallImage($row->image_path))
                ->addColumn('actions', fn ($row) => $this->renderActionsRow($row, 'course'))
                ->rawColumns(['actions', 'placeholder', 'image', 'access', 'status'])
                ->make(true);
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
     * @param ImageService $imageService
     * @return RedirectResponse
     */
    public function store(
        StoreCourseRequest $request,
        CourseService $courseService,
        ImageService $imageService
    ) : RedirectResponse
    {
        /** @var Course $course */
        $course = Course::query()->create($request->validated());

        $courseService->handleRelationships($course, $request);

        $imageService->saveThumbs(
            ImageService::IMAGE_TYPE_COURSE,
            $request->input('image_path')
        );

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
