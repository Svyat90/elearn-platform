<?php

namespace App\Services\Document;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DocumentWatchLaterService extends DocumentService
{

    /**
     * @param int $documentId
     * @return bool
     */
    public function toggleWatchLater(int $documentId) : bool
    {
        if ( ! $this->getUser()) {
            return false;
        }

        $queryBuilder = DB::table('document_watch_later')
            ->where('document_id', $documentId)
            ->where('user_id', $this->getUser()->id);

        if ((clone $queryBuilder)->first()) {
            $queryBuilder->delete();

            return false;
        }

        DB::table('document_watch_later')->insert([
            'document_id' => $documentId,
            'user_id' => $this->getUser()->id
        ]);

        return true;
    }

    /**
     * @return Collection
     */
    public function getWatchLaterDocuments() : Collection
    {
        if ( ! $this->getUser()) {
            return collect();
        }

        return $this->getAvailableDocuments()
            ->join('document_watch_later', function ($join) {
                $join->on('document_watch_later.document_id', 'documents.id');
                $join->on('document_watch_later.user_id', DB::raw($this->getUser()->id));
            })->get();
    }

}
