<?php

namespace App\Http\Requests\Course;

use App\Services\Course\CourseService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * @param CourseService $courseService
     * @return array
     */
    public function rules(CourseService $courseService)
    {
        return [
            'name_ru' => 'sometimes|nullable|max:255',
            'name_ro' => 'sometimes|nullable|max:255',
            'name_en' => 'sometimes|nullable|max:255',
            'name_issuer_ru' => 'sometimes|nullable|max:255',
            'name_issuer_ro' => 'sometimes|nullable|max:255',
            'name_issuer_en' => 'sometimes|nullable|max:255',
            'topic_ru' => 'sometimes|nullable|max:255',
            'topic_ro' => 'sometimes|nullable|max:255',
            'topic_en' => 'sometimes|nullable|max:255',
            'description_ru' => 'sometimes|nullable',
            'description_ro' => 'sometimes|nullable',
            'description_en' => 'sometimes|nullable',
            'status' => 'required|' . Rule::in($courseService->getStatuses()),
            'access' => 'required|' . Rule::in($courseService->getAccessTypes()),
            'published_at' => 'sometimes|nullable',
            'image_path' => 'required|string',
            'category_ids'   => 'sometimes|array',
            'category_ids.*' => 'integer|exists:categories,id',
            'role_ids'   => 'sometimes|array',
            'role_ids.*' => 'integer|exists:roles,id',
            'user_ids'   => 'sometimes|array',
            'user_ids.*' => 'integer|exists:users,id',
            'document_ids'   => 'sometimes|array',
            'document_ids.*' => 'integer|exists:documents,id',
        ];
    }
}
