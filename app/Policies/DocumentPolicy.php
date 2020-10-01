<?php

namespace App\Policies;

use App\Document;
use App\Services\Document\DocumentService;
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
     * @param User|null $user
     * @param Document $document
     * @return Response
     */
    public function show( ? User $user, Document $document) : Response
    {
        return in_array($document->id, $this->availableDocumentIds)
            ? $this->allow()
            : $this->deny(__('main.access_denied'), 403);
    }

    /**
     * @param User $user
     * @param Document $document
     * @return Response
     */
    public function favorite(User $user, Document $document) : Response
    {
        return in_array($document->id, $this->availableDocumentIds)
            ? $this->allow()
            : $this->deny(__('main.access_denied'), 403);
    }

    /**
     * @param User $user
     * @param Document $document
     * @return Response
     */
    public function watchLater(User $user, Document $document) : Response
    {
        return in_array($document->id, $this->availableDocumentIds)
            ? $this->allow()
            : $this->deny(__('main.access_denied'), 403);
    }

}
