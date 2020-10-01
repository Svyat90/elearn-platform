<?php

namespace App\Http\Controllers\Front;

use App\Document;
use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Search\SearchRequest;
use App\Http\Resources\DocumentResourceCollection;
use App\Services\Document\DocumentSearchService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class SearchController extends FrontController
{

    /**
     * @param SearchRequest $request
     * @param DocumentSearchService $searchService
     * @return JsonResource
     */
    public function search(SearchRequest $request, DocumentSearchService $searchService) : JsonResource
    {
        if ($searchService->isEmptyFilters($request)) {
            $documents = new Collection();

        } else {
            $documents = $searchService
                ->getSearchAvailableDocuments($request)
                ->limit($this->pageLimit)
                ->get()
                ->map(function (Document $document) use ($request) {
                    $document->wrapName = wrapQueryString($request->input('query'), $document->{localeAppColumn('name')});
                    return $document;
                });
        }

        return new DocumentResourceCollection($documents);
    }

}
