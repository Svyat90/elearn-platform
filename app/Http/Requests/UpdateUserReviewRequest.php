<?php

namespace App\Http\Requests;

use App\UserReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserReviewRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'text'  => [
                'required'],
            'stars' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
