<?php

namespace App\Http\Controllers\Front;

use App\Document;
use App\Http\Controllers\FrontController;
use App\Services\DocumentService;
use Illuminate\View\View;

class DocumentController extends FrontController
{

    /**
     * @param DocumentService $documentService
     * @return View
     */
    public function index(DocumentService $documentService) : View
    {
        $documents = $documentService
            ->getAvailableDocuments()
            ->paginate($this->pageLimit);

        return view('front.documents.index', compact('documents'));
    }

    /**
     * @param Document $document
     * @return View
     */
    public function show(Document $document) : View
    {
        $document->load('categories', 'relatedDocuments');

        return view('front.documents.show', compact('document'));
    }

}
