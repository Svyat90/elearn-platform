<?php

namespace App\Http\Requests\Front\Category;

use App\Services\DocumentService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexCategoryRequest extends FormRequest
{
    public function authorize()
    {
        // ToDo check user access

        return true;
    }

    /**
     * @param DocumentService $documentService
     * @return string[]
     */
    public function rules(DocumentService $documentService)
    {
        $allTypes = $documentService->getDocumentTypes();
        $allIssuers = $documentService->getDocumentIssuers();
        $allTopics = $documentService->getDocumentTopics();

        return [
            'filter_type'  => 'sometimes|nullable|' . Rule::in($allTypes),
            'filter_issuer'  => 'sometimes|nullable|' . Rule::in($allIssuers),
            'filter_topic'  => 'sometimes|nullable|' . Rule::in($allTopics),
        ];
    }
}
