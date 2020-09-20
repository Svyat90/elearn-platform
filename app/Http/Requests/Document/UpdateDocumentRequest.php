<?php

namespace App\Http\Requests\Document;

use App\Services\DocumentService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * @param DocumentService $documentService
     * @return string[]
     */
    public function rules(DocumentService  $documentService)
    {
        return [
            'type' => 'sometimes|nullable|max:255',
            'number' => 'sometimes|nullable|max:255',
            'name_ru' => 'sometimes|nullable|max:255',
            'name_ro' => 'sometimes|nullable|max:255',
            'name_en' => 'sometimes|nullable|max:255',
            'name_issuer_ru' => 'sometimes|nullable|max:255',
            'name_issuer_ro' => 'sometimes|nullable|max:255',
            'name_issuer_en' => 'sometimes|nullable|max:255',
            'topic_ru' => 'sometimes|nullable|max:255',
            'topic_ro' => 'sometimes|nullable|max:255',
            'topic_en' => 'sometimes|nullable|max:255',
            'description' => 'sometimes|nullable',
            'status' => 'required|' . Rule::in($documentService->getStatuses()),
            'access' => 'required|' . Rule::in($documentService->getAccessTypes()),
            'approved_at' => 'sometimes|nullable',
            'published_at' => 'sometimes|nullable',
            'image_path' => 'sometimes|string',
            'file_path' => 'sometimes|string',
            'category_ids'   => 'sometimes|array',
            'category_ids.*' => 'integer|exists:categories,id',
            'role_ids'   => 'sometimes|array',
            'role_ids.*' => 'integer|exists:roles,id',
            'user_ids'   => 'sometimes|array',
            'user_ids.*' => 'integer|exists:users,id',
        ];
    }

}
