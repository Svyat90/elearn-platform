<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Search\SearchRequest;
use App\Http\Resources\DocumentResourceCollection;
use App\Services\Document\DocumentSearchService;
use App\Services\Search\SearchService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class SearchController extends FrontController
{

    /**
     * @param SearchRequest $request
     * @param SearchService $documentRepository
     * @param DocumentSearchService $documentSearchService
     * @return JsonResource
     */
    public function search(
        SearchRequest $request,
        SearchService $documentRepository,
        DocumentSearchService $documentSearchService
    ) : JsonResource {
        if ($documentSearchService->isEmptyFilters($request)) {
            $documents = new Collection();

        } else {
            $searchFields = $documentSearchService->fillSearchFields($request);
            $documents = $documentRepository->search($request->input('query'), $searchFields);
            $documentSearchService->filterAccess($documents);

            $documents
                ->take($this->pageLimit)
                ->map(function ($document) use ($request) {
                    $document->wrapName = wrapQueryString($request->input('query'), $document->{localeAppColumn('name')});
                    return $document;
                });
        }

        return new DocumentResourceCollection($documents);
    }

}
