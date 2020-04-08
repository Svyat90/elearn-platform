<?php

namespace App\Http\Requests;

use App\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'message'          => [
                'required'],
            'video_for'        => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'video_from'       => [
                'max:256'],
            'from_gender'      => [
                'max:256'],
            'video_to'         => [
                'max:256'],
            'to_gender'        => [
                'max:256'],
            'customer_name'    => [
                'max:256'],
            'delivery_email'   => [
                'max:256'],
            'delivery_phone'   => [
                'max:256'],
            'hide_video'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'promo_code'       => [
                'max:256'],
            'booking_datetime' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable'],
        ];

    }
}
