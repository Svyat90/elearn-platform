<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Category\IndexCategoryRequest;
use App\Repositories\DocumentRepository;
use App\Services\DocumentService;
use Illuminate\View\View;
use Illuminate\Auth\Access\AuthorizationException;

class CategoryController extends FrontController
{
    /**
     * @var DocumentRepository
     */
    protected DocumentRepository $documentRepository;

    /**
     * CategoryController constructor.
     * @param DocumentRepository $documentRepository
     */
    public function __construct(DocumentRepository $documentRepository)
    {
        parent::__construct();
        $this->documentRepository = $documentRepository;
    }

    /**
     * @param IndexCategoryRequest $request
     * @param DocumentService $documentService
     * @param Category $category
     * @return View
     * @throws AuthorizationException
     */
    public function show(IndexCategoryRequest $request, DocumentService $documentService, Category $category) : View
    {
        $this->authorize('show', $category);

        $documents = $documentService
            ->getAvailableCategoryDocuments($category, $request, 'category_id')
            ->paginate($this->pageLimit);

        $allTypes = $this->documentRepository->getDocumentTypes();
        $allIssuers = $this->documentRepository->getDocumentIssuers();
        $allTopics = $this->documentRepository->getDocumentTopics();

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
