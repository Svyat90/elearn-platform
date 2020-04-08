<?php

namespace App\Http\Requests;

use App\ArtistMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyArtistMetumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('artist_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:artist_meta,id',
        ];

    }
}
