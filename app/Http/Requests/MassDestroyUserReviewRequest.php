<?php

namespace App\Http\Requests;

use App\UserReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserReviewRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_reviews,id',
        ];

    }
}
