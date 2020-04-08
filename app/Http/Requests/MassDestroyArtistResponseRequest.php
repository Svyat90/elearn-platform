<?php

namespace App\Http\Requests;

use App\ArtistResponse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyArtistResponseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('artist_response_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:artist_responses,id',
        ];

    }
}
