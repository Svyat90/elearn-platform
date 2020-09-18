<?php

namespace App\Http\Requests\Category;

use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'access'   => [
                'sometimes',
                'nullable',
                Rule::in($categoryService->getAccessTypes())
            ]
        ];
    }
}
