<?php

namespace App\Http\Requests\Front\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseWatchLaterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // ToDo check user access

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'courseId' => 'required|int|exists:courses,id'
        ];
    }
}
