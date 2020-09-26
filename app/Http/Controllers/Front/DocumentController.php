<?php

namespace App\Http\Controllers\Front;

use App\Document;
use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Document\DocumentFavouriteRequest;
use App\Http\Requests\Front\Document\DocumentWatchLaterRequest;
use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class DocumentController extends FrontController
{

    /**
     * @param DocumentService $documentService
     * @return View
     */
    public function index(DocumentService $documentService) : View
    {
        $documents = $documentService
            ->getAvailableDocuments()
            ->paginate($this->pageLimit);

        return view('front.documents.index', compact('documents'));
    }

    /**
     * @param Document $document
     * @return View
     */
    public function show(Document $document) : View
    {
        $document->load('categories', 'relatedDocuments');

        return view('front.documents.show', compact('document'));
    }

    /**
     * @param DocumentFavouriteRequest $request
     * @param DocumentService $documentService
     * @return JsonResponse
     */
    public function favorite(DocumentFavouriteRequest $request, DocumentService $documentService) : JsonResponse
    {
        $result = $documentService->toggleFavorite($request->documentId);

        return $this->getSuccessResponse(new JsonResource([
            'isFavorite' => $result
        ]));
    }

    /**
     * @param DocumentWatchLaterRequest $request
     * @param DocumentService $documentService
     * @return JsonResponse
     */
    public function watchLater(DocumentWatchLaterRequest $request, DocumentService $documentService) : JsonResponse
    {
        $result = $documentService->toggleWatchLater($request->documentId);

        return $this->getSuccessResponse(new JsonResource([
            'isWatchLater' => $result
        ]));
    }

}
