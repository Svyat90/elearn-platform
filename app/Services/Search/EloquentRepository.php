<?php

namespace App\Services\Search;

use App\Http\Requests\Front\Search\SearchRequest;
use App\Services\Document\DocumentSearchService;
use Illuminate\Support\Collection;

class EloquentRepository implements SearchService
{
    /**
     * @param SearchRequest $request
     * @return Collection
     */
    public function search(SearchRequest $request) : Collection
    {
        $service = new DocumentSearchService;

        return $service->getSearchAvailableDocuments($request)->get();
    }

}
