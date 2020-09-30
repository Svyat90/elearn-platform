<?php

namespace App\Http\Requests\Front\Category;

use App\Repositories\DocumentRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * @param DocumentRepository $documentRepository
     * @return string[]
     */
    public function rules(DocumentRepository $documentRepository)
    {
        $allTypes = $documentRepository->getDocumentTypes();
        $allIssuers = $documentRepository->getDocumentIssuers();
        $allTopics = $documentRepository->getDocumentTopics();

        return [
            'filter_type'  => 'sometimes|nullable|' . Rule::in($allTypes),
            'filter_issuer'  => 'sometimes|nullable|' . Rule::in($allIssuers),
            'filter_topic'  => 'sometimes|nullable|' . Rule::in($allTopics),
        ];
    }
}
