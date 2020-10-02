<?php

namespace App\Services\Search;

use Illuminate\Support\Collection;

interface SearchService
{
    /**
     * @param string $query
     * @param array $fields
     * @return Collection
     */
    public function search(string $query = '', array $fields = []) : Collection;
}
