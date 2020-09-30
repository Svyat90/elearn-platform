<?php

namespace App\Http\Controllers\Front;

use App\Document;
use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Document\DocumentFavouriteRequest;
use App\Http\Requests\Front\Document\DocumentWatchLaterRequest;
use App\Http\Requests\Front\Search\SearchRequest;
use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use Illuminate\Auth\Access\AuthorizationException;

class DocumentController extends FrontController
{

    /**
     * @param SearchRequest $request
     * @param DocumentService $documentService
     * @return View
     */
    public function index(SearchRequest $request, DocumentService $documentService) : View
    {
        $documents = $documentService
            ->getSearchAvailableDocuments($request)
            ->paginate($this->pageLimit);

        return view('front.documents.index', compact('documents'));
    }

    /**
     * @param Document $document
     * @return View
     * @throws AuthorizationException
     */
    public function show(Document $document) : View
    {
        $this->authorize('show', $document);

        $document->load('categories', 'relatedDocuments');

        return view('front.documents.show', compact('document'));
    }

    /**
     * @param DocumentFavouriteRequest $request
     * @param DocumentService $documentService
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function favorite(DocumentFavouriteRequest $request, DocumentService $documentService) : JsonResponse
    {
        $this->authorize('favorite', $request->documentId);

        $result = $documentService->toggleFavorite($request->documentId);

        return $this->getSuccessResponse(new JsonResource([
            'isFavorite' => $result
        ]));
    }

    /**
     * @param DocumentWatchLaterRequest $request
     * @param DocumentService $documentService
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function watchLater(DocumentWatchLaterRequest $request, DocumentService $documentService) : JsonResponse
    {
        $this->authorize('watchLater', $request->documentId);

        $result = $documentService->toggleWatchLater($request->documentId);

        return $this->getSuccessResponse(new JsonResource([
            'isWatchLater' => $result
        ]));
    }

}
