<?php

namespace App\Services\Search;

use Elasticsearch\Client;

class ElasticSearchObserver
{
    /**
     * @var Client
     */
    private Client $elasticSearch;

    /**
     * ElasticSearchObserver constructor.
     * @param Client $elasticSearch
     */
    public function __construct(Client $elasticSearch)
    {
        $this->elasticSearch = $elasticSearch;
    }

    /**
     * @param $model
     */
    public function saved($model) : void
    {
        $this->elasticSearch->index([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
            'body' => $model->toSearchArray()
        ]);
    }

    /**
     * @param $model
     */
    public function deleted($model) : void
    {
        $this->elasticSearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey()
        ]);
    }

}
