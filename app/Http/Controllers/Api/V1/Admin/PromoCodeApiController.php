<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePromoCodeRequest;
use App\Http\Requests\UpdatePromoCodeRequest;
use App\Http\Resources\Admin\PromoCodeResource;
use App\PromoCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PromoCodeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('promo_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PromoCodeResource(PromoCode::all());

    }

    public function store(StorePromoCodeRequest $request)
    {
        $promoCode = PromoCode::create($request->all());

        return (new PromoCodeResource($promoCode))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(PromoCode $promoCode)
    {
        abort_if(Gate::denies('promo_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PromoCodeResource($promoCode);

    }

    public function update(UpdatePromoCodeRequest $request, PromoCode $promoCode)
    {
        $promoCode->update($request->all());

        return (new PromoCodeResource($promoCode))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(PromoCode $promoCode)
    {
        abort_if(Gate::denies('promo_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $promoCode->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
