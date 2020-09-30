<?php

namespace App\Policies;

use App\Document;
use App\Services\DocumentService;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * @var array
     */
    protected array $availableDocumentIds = [];

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->availableDocumentIds = (new DocumentService())
            ->getAvailableDocuments()
            ->pluck('id')
            ->toArray();
    }

    /**
     * @param User $user
     * @param Document $document
     * @return Response
     */
    public function show(User $user, Document $document) : Response
    {
        return in_array($document->id, $this->availableDocumentIds)
            ? Response::allow()
            : Response::deny(__('main.access_denied'));
    }

    /**
     * @param User $user
     * @param int $documentId
     * @return Response
     */
    public function favorite(User $user, int $documentId) : Response
    {
        return in_array($documentId, $this->availableDocumentIds)
            ? Response::allow()
            : Response::deny(__('main.access_denied'));
    }

    /**
     * @param User $user
     * @param int $documentId
     * @return Response
     */
    public function watchLater(User $user, int $documentId) : Response
    {
        return in_array($documentId, $this->availableDocumentIds)
            ? Response::allow()
            : Response::deny(__('main.access_denied'));
    }

}
