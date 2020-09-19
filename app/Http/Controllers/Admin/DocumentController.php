<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Document\MassDestroyDocumentRequest;
use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Services\DocumentService;
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

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addColumn('id', fn ($row) => $row->id ?? '');
            $table->addColumn('type', fn ($row) => $row->type ?? '');
            $table->addColumn('number', fn ($row) => $row->number ?? '');
            $table->addColumn('name', fn ($row) => $row->{localeColumn('name')} ?? '');
            $table->addColumn('name_issuer', fn ($row) => $row->{localeColumn('name_issuer')} ?? '');
            $table->addColumn('topic', fn ($row) => $row->{localeColumn('topic')} ?? '');
            $table->addColumn('access', fn ($row) => $row->access ?? '');
            $table->addColumn('status', fn ($row) => $row->status ?? '');
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

            $table->rawColumns(['actions', 'placeholder', 'image']);

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

        $accessTypes = collect($documentService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        $statuses = $documentService->getStatuses();
        $statusesSelect = collect($statuses)
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.documents.create', compact(
            'accessTypes',
                'statuses',
                'statusesSelect'
            )
        );
    }

    /**
     * @param StoreDocumentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreDocumentRequest $request) : RedirectResponse
    {
        Document::query()->create($request->validated());

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

        $accessTypes = collect($documentService->getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        $statuses = $documentService->getStatuses();
        $statusesSelect = collect($statuses)
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.documents.edit', compact(
            'document',
            'accessTypes',
            'statuses',
            'statusesSelect'
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

        $document->update($request->validated());

        return redirect()->route('admin.documents.index');
    }

    /**
     * @param Document $document
     * @return View
     */
    public function show(Document $document) : View
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

//        $document->load('parentSubCategories');

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
