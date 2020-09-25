<?php

namespace App\Repositories;

use App\Document;
use App\Services\DocumentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DocumentRepository extends Model
{

    /**
     * @return Collection
     */
    public function getDocumentTypes() : Collection
    {
        return Document::query()
            ->select('type')
            ->distinct()
            ->pluck('type');
    }

    /**
     * @return Collection
     */
    public function getDocumentIssuers() : Collection
    {
        $localeColumn = localeAppColumn('name_issuer');

        return Document::query()
            ->select($localeColumn)
            ->distinct()
            ->pluck($localeColumn);
    }

    /**
     * @return Collection
     */
    public function getDocumentTopics() : Collection
    {
        $localeColumn = localeAppColumn('topic');

        return Document::query()
            ->select($localeColumn)
            ->distinct()
            ->pluck($localeColumn);
    }

    /**
     * @param int $limit
     * @return Collection
     */
    public function getRandomPublicDocuments(int $limit) : Collection
    {
        return Document::query()
            ->where('access', DocumentService::ACCESS_TYPE_PUBLIC)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

}