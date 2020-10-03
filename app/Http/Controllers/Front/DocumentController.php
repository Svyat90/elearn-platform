<?php

namespace App\Http\Controllers\Front;

use App\Document;
use App\Helpers\CollectionHelper;
use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Document\DocumentFavouriteRequest;
use App\Http\Requests\Front\Document\DocumentWatchLaterRequest;
use App\Http\Requests\Front\Search\SearchRequest;
use App\Services\Document\DocumentFavouriteService;
use App\Services\Document\DocumentSearchService;
use App\Services\Document\DocumentWatchLaterService;
use App\Services\Search\SearchService;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Auth\Access\AuthorizationException;

class DocumentController extends FrontController
{

    /**
     * @param SearchRequest $request
     * @param SearchService $documentRepository
     * @param DocumentSearchService $documentSearchService
     * @return View
     */
    public function index(
        SearchRequest $request,
        SearchService $documentRepository,
        DocumentSearchService $documentSearchService
    ) : View {
        if ($documentSearchService->isEmptyFilters($request)) {
            if ($request->input('query')) {
                $documents = new Collection();

            } else {
                $documents = $documentSearchService
                    ->getAvailableDocuments()
                    ->paginate($this->pageLimit);
            }

        } else {
            $items = $documentRepository->search($request);

            $documents = CollectionHelper::paginate($items, $this->pageLimit)
                ->appends([
                    'query' => $request->input('query'),
                    'filter_all' => $request->filter_all,
                    'filter_issuer' => $request->filter_issuer,
                    'filter_name' => $request->filter_name,
                    'filter_description' => $request->filter_description,
                    'filter_content' => $request->filter_content,
                ]);
        }

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
     * @param DocumentFavouriteService $favouriteService
     * @return Response|JsonResponse
     */
    public function favorite(DocumentFavouriteRequest $request, DocumentFavouriteService $favouriteService)
    {
        if ( ! $this->user || $this->user->cant('favorite', Document::query()->find($request->documentId))) {
            return Response::deny(__('main.access_denied'), 403);
        }

        $result = $favouriteService->toggleFavorite($request->documentId);

        return $this->getSuccessResponse(new JsonResource([
            'isFavorite' => $result
        ]));
    }

    /**
     * @param DocumentWatchLaterRequest $request
     * @param DocumentWatchLaterService $watchLaterService
     * @return Response|JsonResponse
     */
    public function watchLater(DocumentWatchLaterRequest $request, DocumentWatchLaterService $watchLaterService)
    {
        if ( ! $this->user || $this->user->cant('watchLater', Document::query()->find($request->documentId))) {
            return Response::deny(__('main.access_denied'), 403);
        }

        $result = $watchLaterService->toggleWatchLater($request->documentId);

        return $this->getSuccessResponse(new JsonResource([
            'isWatchLater' => $result
        ]));
    }

}
