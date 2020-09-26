<?php

namespace App\Http\Controllers\Traits;

use App\Services\DocumentService;
use App\User;
use Illuminate\Support\Facades\View;

trait WatchLaterTrait
{

    /**
     * Share favourites documents
     *
     * @param User|null $user
     */
    public function shareWatchLater(?User $user): void
    {
        $documentService = new DocumentService();
        $documentService->setUser($user);

        $watchLaterDocumentIds = $documentService->getWatchLaterDocuments()
            ->pluck('id')
            ->toArray();

        View::share(compact('watchLaterDocumentIds'));
    }

}
