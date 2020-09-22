<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Document;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Document\MassDestroyDocumentRequest;
use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Role;
use App\Services\DocumentService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DocumentController extends Controller
{
    use MediaUploadingTrait;

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
            $table = Datatables::of($query);

            $nameLocaleColumn = localeColumn('name');
            $nameIssuerLocaleColumn = localeColumn('name_issuer');
            $topicLocaleColumn = localeColumn('topic');

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('id', fn ($row) => $row->id ?? '');
            $table->editColumn('type', fn ($row) => $row->type ?? '');
            $table->editColumn('number', fn ($row) => $row->number ?? '');
            $table->editColumn($nameLocaleColumn, fn ($row) => $row->$nameLocaleColumn ?? '');
            $table->editColumn($nameIssuerLocaleColumn, fn ($row) => $row->$nameIssuerLocaleColumn ?? '');
            $table->editColumn($topicLocaleColumn, fn ($row) => $row->$topicLocaleColumn ?? '');
            $table->editColumn('access', fn ($row) => labelAccess($row->access));
            $table->editColumn('status', fn ($row) => labelDocumentStatus($row->status));
            $table->addColumn('approved_at', fn ($row) => $row->approved_at ?? '');
            $table->addColumn('published_at', fn ($row) => $row->published_at ?? '');
            $table->addColumn('image', fn ($row) => $row->image_path ? sprintf('<img src="%s" width="50px" height="50px" />', storageUrl($row->image_path)) : '');
            $table->addColumn('actions', function ($row) {
                $viewGate      = 'document_show';
                $editGate      = 'document_edit';
                $deleteGate    = 'document_delete';
                $crudRoutePart = 'documents';

                return view('partials.datatablesActions', compact(
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

        return view('admin.documents.index');
    }

    /**
     * @param DocumentService $documentService
     * @return View
     */
    public function create(DocumentService $documentService) : View
    {
        abort_if(Gate::denies('document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck(localeColumn('name'), 'id');
        $users = User::all()->pluck('email', 'id');
        $roles = Role::all()->pluck('title', 'id');
        $documents = Document::query()->pluck(localeColumn('name'), 'id');

        $accessTypes = collect($documentService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        $statuses = $documentService->getStatuses();
        $statusesSelect = collect($statuses)
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.documents.create', compact(
            'accessTypes',
                'statuses',
                'statusesSelect',
                'categories',
                'documents',
                'roles',
                'users'
            )
        );
    }

    /**
     * @param StoreDocumentRequest $request
     * @param DocumentService $documentService
     * @return RedirectResponse
     */
    public function store(StoreDocumentRequest $request, DocumentService $documentService) : RedirectResponse
    {
        $insertData = $request->validated();
        $insertData['description'] = strip_tags($insertData['description']);

        /** @var Document $document */
        $document = Document::query()->create($insertData);

        $documentService->handleRelationships($document, $request);

        return redirect()->route('admin.documents.index');
    }

    /**
     * @param Document $document
     * @param DocumentService $documentService
     * @return View
     */
    public function edit(Document $document, DocumentService $documentService) : View
    {
        abort_if(Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allDocuments = Document::all()->pluck(localeColumn('name'), 'id')->except([$document->id]);
        $allCategories = Category::all()->pluck(localeColumn('name'), 'id');
        $allUsers = User::all()->pluck('email', 'id');
        $allRoles = Role::all()->pluck('title', 'id');

        $document->load('categories', 'roles', 'users', 'relatedDocuments');

        $relatedDocumentIds = $document->relatedDocuments->pluck('id')->toArray();
        $categoryIds = $document->categories->pluck('id')->toArray();
        $roleIds = $document->roles->pluck('id')->toArray();
        $userIds = $document->users->pluck('id')->toArray();

        $accessTypes = collect($documentService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        $statuses = $documentService->getStatuses();
        $statusesSelect = collect($statuses)
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.documents.edit', compact(
            'document',
            'accessTypes',
            'statuses',
            'statusesSelect',
            'categoryIds',
            'relatedDocumentIds',
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

        $updateData = $request->validated();
        $updateData['description'] = strip_tags($updateData['description']);
        $document->update($updateData);

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
