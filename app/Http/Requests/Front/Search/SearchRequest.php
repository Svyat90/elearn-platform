<?php

namespace App\Http\Requests\Front\Search;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'query' => 'sometimes|nullable|string',
            'filter_all'  => 'sometimes|int',
            'filter_issuer'  => 'sometimes|int',
            'filter_name'  => 'sometimes|int',
            'filter_description'  => 'sometimes|int',
            'filter_content'  => 'sometimes|int',
        ];
    }
}
