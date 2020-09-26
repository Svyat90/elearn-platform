<?php

namespace App\Http\Requests\Front\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentWatchLaterRequest extends FormRequest
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
            'documentId' => 'required|int|exists:documents,id'
        ];
    }
}
