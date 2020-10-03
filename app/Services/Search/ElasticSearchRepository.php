<?php

namespace App\Services\Search;

use App\Document;
use App\Http\Requests\Front\Search\SearchRequest;
use App\Services\Document\DocumentService;
use Elasticsearch\Client;
use Illuminate\Support\Arr;
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
     * @param SearchRequest $request
     * @return Collection
     */
    public function search(SearchRequest $request) : Collection
    {
        $fields = $this->fillSearchFields($request);

        $items = $this->searchOnElasticSearch($request->input('query'), $fields);

        return $this->buildCollection($items);
    }

    /**
     * @param string|null $query
     * @param array $fields
     * @return array
     */
    private function searchOnElasticSearch( ? string $query, array $fields = []) : array
    {
        $model = new Document;

        return $this->elasticSearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => $fields,
                        'query' => $query ?? "",
                    ],
                ],
            ],
        ]);
    }

    /**
     * @param SearchRequest $request
     * @return array
     */
    private function fillSearchFields(SearchRequest $request) : array
    {
        $fields = [];
        $allFields = [
            localeAppColumn('name'), localeAppColumn('name_issuer'),
            localeAppColumn('description'), 'content'
        ];

        foreach ($request->validated() as $field => $val) {
            switch (true) {
                case $field === 'filter_all' && $val === "1":
                    return $allFields;
                case $field === 'filter_name' && $val === "1":
                    $fields[] = localeAppColumn('name');
                    break;
                case $field === 'filter_issuer' && $val === "1":
                    $fields[] = localeAppColumn('name_issuer');
                    break;
                case $field === 'filter_description' && $val === "1":
                    $fields[] = localeAppColumn('description');
                    break;
                case $field === 'filter_content' && $val === "1":
                    $fields[] = 'content';
                    break;
            }
        }

        return $fields;
    }

    /**
     * @param array $items
     * @return Collection
     */
    private function buildCollection(array $items) : Collection
    {
        $availableDocIds = (new DocumentService())
            ->getAvailableDocuments()
            ->pluck('id')
            ->toArray();

        $foundIds = Arr::pluck($items['hits']['hits'], '_id');

        return Document::query()
            ->whereIn('id', $foundIds)
            ->get()
            ->filter(function (Document $document) use ($availableDocIds) {
                return in_array($document->id, $availableDocIds);
            });
    }

}
