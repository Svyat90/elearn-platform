<?php

namespace App\Http\Controllers\Front;

use App\Document;
use App\Http\Controllers\FrontController;
use Illuminate\View\View;

class DocumentController extends FrontController
{

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
