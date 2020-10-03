<?php

namespace App\Services\Search;

use App\Http\Requests\Front\Search\SearchRequest;
use Illuminate\Support\Collection;

interface SearchService
{

    /**
     * @param SearchRequest $request
     * @return Collection
     */
    public function search(SearchRequest $request) : Collection;

}
