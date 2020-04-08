<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\ArtistEnquiry;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreArtistEnquiryRequest;
use App\Http\Requests\UpdateArtistEnquiryRequest;
use App\Http\Resources\Admin\ArtistEnquiryResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArtistEnquiryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('artist_enquiry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArtistEnquiryResource(ArtistEnquiry::with(['artist', 'country'])->get());

    }

    public function store(StoreArtistEnquiryRequest $request)
    {
        $artistEnquiry = ArtistEnquiry::create($request->all());

        return (new ArtistEnquiryResource($artistEnquiry))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(ArtistEnquiry $artistEnquiry)
    {
        abort_if(Gate::denies('artist_enquiry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArtistEnquiryResource($artistEnquiry->load(['artist', 'country']));

    }

    public function update(UpdateArtistEnquiryRequest $request, ArtistEnquiry $artistEnquiry)
    {
        $artistEnquiry->update($request->all());

        return (new ArtistEnquiryResource($artistEnquiry))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(ArtistEnquiry $artistEnquiry)
    {
        abort_if(Gate::denies('artist_enquiry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistEnquiry->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
