<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOccasionRequest;
use App\Http\Requests\UpdateOccasionRequest;
use App\Http\Resources\Admin\OccasionResource;
use App\Occasion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OccasionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('occasion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OccasionResource(Occasion::all());

    }

    public function store(StoreOccasionRequest $request)
    {
        $occasion = Occasion::create($request->all());

        return (new OccasionResource($occasion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Occasion $occasion)
    {
        abort_if(Gate::denies('occasion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OccasionResource($occasion);

    }

    public function update(UpdateOccasionRequest $request, Occasion $occasion)
    {
        $occasion->update($request->all());

        return (new OccasionResource($occasion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Occasion $occasion)
    {
        abort_if(Gate::denies('occasion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $occasion->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
