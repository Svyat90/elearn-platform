<?php

namespace App\Repositories;

use App\Category;
use App\Services\DocumentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryRepository extends Model
{

    /**
     * @return Collection
     */
    public function getCategoriesForHome() : Collection
    {
        return Category::query()
            ->where('access', DocumentService::ACCESS_TYPE_PUBLIC)
            ->orderBy('id', 'asc')
            ->limit(4)
            ->get();
    }

}
