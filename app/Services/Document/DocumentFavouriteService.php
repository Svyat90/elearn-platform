<?php

namespace App\Services\Document;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DocumentFavouriteService extends DocumentService
{

    /**
     * @param int $documentId
     * @return bool
     */
    public function toggleFavorite(int $documentId) : bool
    {
        if ( ! $this->getUser()) {
            return false;
        }

        $queryBuilder = DB::table('document_favorite')
            ->where('document_id', $documentId)
            ->where('user_id', $this->getUser()->id);

        if ((clone $queryBuilder)->first()) {
            $queryBuilder->delete();

            return false;
        }

        DB::table('document_favorite')->insert([
            'document_id' => $documentId,
            'user_id' => $this->getUser()->id
        ]);

        return true;
    }

    /**
     * @return Collection
     */
    public function getFavouriteDocuments() : Collection
    {
        if ( ! $this->getUser()) {
            return collect();
        }

        return $this->getAvailableDocuments()
            ->join('document_favorite', function ($join) {
                $join->on('document_favorite.document_id', 'documents.id');
                $join->on('document_favorite.user_id', DB::raw($this->getUser()->id));
            })->get();
    }

}
