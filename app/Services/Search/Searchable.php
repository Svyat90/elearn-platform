<?php

namespace App\Services\Search;

trait Searchable
{
    public static function bootSearchable() : void
    {
        if (config('services.search.enabled')) {
            static::observe(ElasticSearchObserver::class);
        }
    }

    /**
     * @return string
     */
    public function getSearchIndex()
    {
        return $this->getTable();
    }

    /**
     * @return string
     */
    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }

        return $this->getTable();
    }

    /**
     * @return array
     */
    public function toSearchArray()
    {
        if (method_exists(static::class, 'toArrayWithContent')) {
            return $this->toArrayWithContent();
        }

        return $this->toArray();
    }

}
