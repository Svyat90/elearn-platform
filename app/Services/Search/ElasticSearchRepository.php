<?php

namespace App\Services\Search;

use App\Document;
use Elasticsearch\Client;
use Illuminate\Support\Collection;

class ElasticSearchRepository implements SearchService
{
    /**
     * @var Client
     */
    private Client $elasticSearch;

    /**
     * ElasticSearchRepository constructor.
     * @param Client $elasticSearch
     */
    public function __construct(Client $elasticSearch)
    {
        $this->elasticSearch = $elasticSearch;
    }

    /**
     * @param string $query
     * @param array $fields
     * @return Collection
     */
    public function search(string $query = '', array $fields = []) : Collection
    {
        $items = $this->searchOnElasticSearch($query, $fields);

        return collect($items['hits']['hits'] ?? [])
            ->map(function ($item) {
                return (object) $item['_source'];
            });
    }

    /**
     * @param string $query
     * @param array $fields
     * @return array
     */
    private function searchOnElasticSearch(string $query = '', array $fields = []) : array
    {
        $model = new Document;

        return $this->elasticSearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => $fields,
                        'query' => $query,
                    ],
                ],
            ],
        ]);
    }

}
