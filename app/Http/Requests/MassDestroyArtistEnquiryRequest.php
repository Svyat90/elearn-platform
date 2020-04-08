<?php

namespace App\Http\Requests;

use App\ArtistEnquiry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyArtistEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('artist_enquiry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:artist_enquiries,id',
        ];

    }
}
