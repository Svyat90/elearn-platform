<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Document;
use App\Helpers\ImageHelper;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Traits\AccessStatuses;
use App\Http\Controllers\Traits\AccessTypes;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Document\MassDestroyDocumentRequest;
use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Role;
use App\Services\Document\DocumentService;
use App\Services\ImageService;
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

class DocumentController extends AdminController
{
    use MediaUploadingTrait,
        AccessTypes,
        AccessStatuses;

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
        abort_if(Gate::denies('document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Document::query()->select(sprintf('%s.*', (new Document)->table));

            $nameLocale = localeColumn('name');
            $nameIssuerLocale = localeColumn('name_issuer');
            $topicLocale = localeColumn('topic');
            $typeLocale = localeColumn('type');

            return Datatables::of($query)
                ->addColumn('placeholder', '&nbsp;')
                ->addColumn('actions', '&nbsp;')
                ->editColumn('id', fn ($row) => $row->id ?? '')
                ->editColumn('type', fn ($row) => $row->type ?? '')
                ->editColumn('number', fn ($row) => $row->number ?? '')
                ->editColumn($nameLocale, fn ($row) => $row->$nameLocale ?? '')
                ->editColumn($nameIssuerLocale, fn ($row) => $row->$nameIssuerLocale ?? '')
                ->editColumn($topicLocale, fn ($row) => $row->$topicLocale ?? '')
                ->editColumn($typeLocale, fn ($row) => $row->$typeLocale ?? '')
                ->editColumn('access', fn ($row) => labelAccess($row->access))
                ->editColumn('status', fn ($row) => labelStatus($row->status))
                ->addColumn('approved_at', fn ($row) => $row->approved_at ?? '')
                ->addColumn('published_at', fn ($row) => $row->published_at ?? '')
                ->addColumn('image', fn ($row) => ImageHelper::smallImage($row->image_path))
                ->addColumn('actions', fn ($row) => $this->renderActionsRow($row, 'document'))
                ->rawColumns(['actions', 'placeholder', 'image', 'access', 'status'])
                ->make(true);
        }

        return view('admin.documents.index');
    }

    /**
     * @return View
     */
    public function create() : View
    {
        abort_if(Gate::denies('document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck(localeColumn('name'), 'id');
        $subCategories = SubCategory::all()->pluck(localeColumn('name'), 'id');
        $users = User::all()->pluck('email', 'id');
        $roles = Role::all()->pluck('title', 'id');
        $documents = Document::query()->pluck(localeColumn('name'), 'id');

        return view('admin.documents.create', compact(
                'categories',
                'subCategories',
                'documents',
                'roles',
                'users'
            )
        );
    }

    /**
     * @param StoreDocumentRequest $request
     * @param DocumentService $documentService
     * @param ImageService $imageService
     * @return RedirectResponse
     */
    public function store(
        StoreDocumentRequest $request,
        DocumentService $documentService,
        ImageService $imageService
    ) : RedirectResponse
    {
        /** @var Document $document */
        $document = Document::query()->create($request->validated());

        $document->content_file = DocumentService::getDocumentContent($document->file_path);
        $document->save();

        $documentService->handleRelationships($document, $request);

        $imageService->saveThumbs(
            ImageService::IMAGE_TYPE_DOCUMENT,
            $request->input('image_path')
        );

        return redirect()->route('admin.documents.index');
    }

    /**
     * @param Document $document
     * @return View
     */
    public function edit(Document $document) : View
    {
        abort_if(Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allDocuments = Document::all()->pluck(localeColumn('name'), 'id')->except([$document->id]);
        $allCategories = Category::all()->pluck(localeColumn('name'), 'id');
        $allSubCategories = SubCategory::all()->pluck(localeColumn('name'), 'id');
        $allUsers = User::all()->pluck('email', 'id');
        $allRoles = Role::all()->pluck('title', 'id');

        $document->load('categories', 'subCategories', 'roles', 'users', 'relatedDocuments');

        $relatedDocumentIds = $document->relatedDocuments->pluck('id')->toArray();
        $categoryIds = $document->categories->pluck('id')->toArray();
        $subCategoryIds = $document->subCategories->pluck('id')->toArray();
        $roleIds = $document->roles->pluck('id')->toArray();
        $userIds = $document->users->pluck('id')->toArray();

        return view('admin.documents.edit', compact(
            'document',
            'categoryIds',
            'subCategoryIds',
            'relatedDocumentIds',
            'roleIds',
            'userIds',
            'allCategories',
            'allSubCategories',
            'allDocuments',
            'allUsers',
            'allRoles'
            )
        );
    }

    /**
     * @param UpdateDocumentRequest $request
     * @param Document $document
     * @param DocumentService $documentService
     * @return RedirectResponse
     */
    public function update(
        UpdateDocumentRequest $request,
        Document $document,
        DocumentService $documentService
    ) : RedirectResponse
    {
        $documentService->handleImage($document, $request->image_path);
        $documentService->handleFile($document, $request->file_path);
        $documentService->handleRelationships($document, $request);

        $document->update($request->validated());

        $document->content_file = DocumentService::getDocumentContent($document->refresh()->file_path);
        $document->save();

        return redirect()->route('admin.documents.index');
    }

    /**
     * @param Document $document
     * @return View
     */
    public function show(Document $document) : View
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->load('categories', 'roles', 'users', 'courses', 'relatedDocuments');

        return view('admin.documents.show', compact('document'));
    }

    /**
     * @param Document $document
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Document $document) : RedirectResponse
    {
        abort_if(Gate::denies('document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->delete();

        return back();
    }

    /**
     * @param MassDestroyDocumentRequest $request
     * @return Response
     */
    public function massDestroy(MassDestroyDocumentRequest $request) : Response
    {
        Document::query()->whereIn('id', $request->ids)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
