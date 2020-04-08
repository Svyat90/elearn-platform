<?php

namespace App\Http\Requests;

use App\ArtistMetum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateArtistMetumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('artist_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'display_name'       => [
                'max:256'],
            'languages.*'        => [
                'integer'],
            'languages'          => [
                'array'],
            'tags.*'             => [
                'integer'],
            'tags'               => [
                'array'],
            'order_status_email' => [
                'max:256'],
            'url_name'           => [
                'max:256'],
            'social_instagram'   => [
                'max:256'],
            'social_facebook'    => [
                'max:256'],
            'social_youtube'     => [
                'max:256'],
            'social_tiktok'      => [
                'max:256'],
            'social_snapchat'    => [
                'max:256'],
            'social_twitter'     => [
                'max:256'],
            'social_twitch'      => [
                'max:256'],
            'social_linkedin'    => [
                'max:256'],
        ];

    }
}
