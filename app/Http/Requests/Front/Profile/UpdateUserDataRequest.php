<?php

namespace App\Http\Requests\Front\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class UpdateUserDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Session::flash('updateUserData', true);

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
            'first_name'    => 'sometimes|nullable|max:255',
            'last_name'     => 'sometimes|nullable|max:255',
            'email'         => 'required|unique:users,email,' . auth()->user()->id,
            'position'      => 'sometimes|nullable|max:255',
            'institution'   => 'sometimes|nullable|max:255',
            'phone'         => 'sometimes|nullable|max:255',
        ];
    }
}
