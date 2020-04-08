<?php

namespace App\Http\Requests;

use App\ArtistEnquiry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreArtistEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('artist_enquiry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'                  => [
                'max:256',
                'required'],
            'contact_no'            => [
                'max:256'],
            'social_media_type'     => [
                'max:256'],
            'social_media'          => [
                'max:256'],
            'social_media_followrs' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
