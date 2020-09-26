<?php

namespace App\Http\Requests\Front\Contact;

use Illuminate\Foundation\Http\FormRequest;

class SendContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'email'  => 'required|email',
            'name'  => 'required|string',
            'phone'  => 'required|string',
            'message'  => 'required|string',
        ];
    }
}
