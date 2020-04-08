<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\ArtistResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtistResponseRequest;
use App\Http\Requests\UpdateArtistResponseRequest;
use App\Http\Resources\Admin\ArtistResponseResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArtistResponseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('artist_response_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArtistResponseResource(ArtistResponse::with(['order', 'video', 'artist'])->get());

    }

    public function store(StoreArtistResponseRequest $request)
    {
        $artistResponse = ArtistResponse::create($request->all());

        return (new ArtistResponseResource($artistResponse))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(ArtistResponse $artistResponse)
    {
        abort_if(Gate::denies('artist_response_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ArtistResponseResource($artistResponse->load(['order', 'video', 'artist']));

    }

    public function update(UpdateArtistResponseRequest $request, ArtistResponse $artistResponse)
    {
        $artistResponse->update($request->all());

        return (new ArtistResponseResource($artistResponse))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(ArtistResponse $artistResponse)
    {
        abort_if(Gate::denies('artist_response_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistResponse->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
