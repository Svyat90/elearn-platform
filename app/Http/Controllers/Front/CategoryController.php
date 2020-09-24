<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Category\IndexCategoryRequest;
use App\Services\DocumentService;
use Illuminate\View\View;

class CategoryController extends FrontController
{

    /**
     * @param IndexCategoryRequest $request
     * @param DocumentService $documentService
     * @param Category $category
     * @return View
     */
    public function show(IndexCategoryRequest $request, DocumentService $documentService, Category $category) : View
    {
        $documents = $documentService
            ->getAvailableDocuments($category, $request)
            ->paginate($this->pageLimit);

        $allTypes = $documentService->getDocumentTypes();
        $allIssuers = $documentService->getDocumentIssuers();
        $allTopics = $documentService->getDocumentTopics();

        return view('front.categories.show', compact(
            'category',
            'documents',
                'allTypes',
                'allIssuers',
                'allTopics'
            )
        );
    }

}
