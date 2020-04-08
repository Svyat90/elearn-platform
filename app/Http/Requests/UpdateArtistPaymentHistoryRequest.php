<?php

namespace App\Http\Requests;

use App\ArtistPaymentHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateArtistPaymentHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('artist_payment_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'proccesed_by' => [
                'max:256'],
        ];

    }
}
