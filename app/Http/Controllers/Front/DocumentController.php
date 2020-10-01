<?php

namespace App\Http\Controllers\Front;

use App\Document;
use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Document\DocumentFavouriteRequest;
use App\Http\Requests\Front\Document\DocumentWatchLaterRequest;
use App\Http\Requests\Front\Search\SearchRequest;
use App\Services\Document\DocumentFavouriteService;
use App\Services\Document\DocumentSearchService;
use App\Services\Document\DocumentWatchLaterService;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use Illuminate\Auth\Access\AuthorizationException;

class DocumentController extends FrontController
{

    /**
     * @param SearchRequest $request
     * @param DocumentSearchService $searchService
     * @return View
     */
    public function index(SearchRequest $request, DocumentSearchService $searchService) : View
    {
        $documents = $searchService
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
     * @param DocumentFavouriteService $favouriteService
     * @return Response|JsonResponse
     */
    public function favorite(DocumentFavouriteRequest $request, DocumentFavouriteService $favouriteService)
    {
        /** @var User $user */
        $user = auth()->user();
        if ($user->cant('favorite', Document::query()->find($request->documentId))) {
            return Response::deny(__('main.access_denied'));
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
        /** @var User $user */
        $user = auth()->user();
        if ($user->cant('watchLater', Document::query()->find($request->documentId))) {
            return Response::deny(__('main.access_denied'));
        }

        $result = $watchLaterService->toggleWatchLater($request->documentId);

        return $this->getSuccessResponse(new JsonResource([
            'isWatchLater' => $result
        ]));
    }

}
