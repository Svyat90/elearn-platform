<?php

namespace App\Http\Requests;

use App\UserWishlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserWishlistRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_wishlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
        ];

    }
}
