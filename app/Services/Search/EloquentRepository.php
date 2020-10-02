<?php

namespace App\Services\Search;

use App\Http\Requests\Front\Search\SearchRequest;
use App\Services\Document\DocumentSearchService;
use Illuminate\Support\Collection;

class EloquentRepository implements SearchService
{
    /**
     * @param string $query
     * @param array $fields
     * @return Collection
     */
    public function search(string $query = '', array $fields = []) : Collection
    {
        $service = new DocumentSearchService();

        $filters = $this->buildFilters($query, $fields);

        $request = new SearchRequest($filters);

        return $service->getSearchAvailableDocuments($request)->get();
    }

    /**
     * @param string $query
     * @param array $fields
     * @return array
     */
    private function buildFilters(string $query, array $fields) : array
    {
        $filters = [];
        $filters['query'] = $query;

        foreach ($fields as $field) {
            switch (true) {
                case strpos($field, 'name') !== false:
                    $filters['filter_name'] = "1";
                    break;
                case strpos($field, 'name_issuer') !== false:
                    $filters['filter_issuer'] = "1";
                    break;
                case strpos($field, 'description') !== false:
                    $filters['filter_description'] = "1";
                    break;
            }
        }

        return $filters;
    }

}
