<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Http\Requests\Front\Category\IndexCategoryRequest;
use App\Repositories\DocumentRepository;
use App\Services\DocumentService;
use App\SubCategory;
use Illuminate\View\View;

class SubCategoryController extends FrontController
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
     * @param SubCategory $subCategory
     * @return View
     */
    public function show(IndexCategoryRequest $request, DocumentService $documentService, SubCategory $subCategory) : View
    {
        $documents = $documentService
            ->getAvailableCategoryDocuments($subCategory, $request, 'sub_category_id')
            ->paginate($this->pageLimit);

        $allTypes = $this->documentRepository->getDocumentTypes();
        $allIssuers = $this->documentRepository->getDocumentIssuers();
        $allTopics = $this->documentRepository->getDocumentTopics();

        return view('front.subCategories.show', compact(
                'subCategory',
                'documents',
                'allTypes',
                'allIssuers',
                'allTopics'
            )
        );
    }

}
