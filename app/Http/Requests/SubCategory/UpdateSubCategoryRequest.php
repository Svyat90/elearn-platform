<?php

namespace App\Http\Requests\SubCategory;

use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UpdateSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * @param CategoryService $categoryService
     * @return array
     */
    public function rules(CategoryService $categoryService)
    {
        return [
            'name_ru'  => 'sometimes|nullable|max:255',
            'name_ro'  => 'sometimes|nullable|max:255',
            'name_en'  => 'sometimes|nullable|max:255',
            'parent_id' => 'required|integer|exists:categories,id',
            'access'   => [
                'sometimes',
                'nullable',
                Rule::in($categoryService->getAccessTypes())
            ],
            'role_ids'   => 'sometimes|array',
            'role_ids.*' => 'integer|exists:roles,id',
            'user_ids'   => 'sometimes|array',
            'user_ids.*' => 'integer|exists:users,id',
        ];
    }
}
