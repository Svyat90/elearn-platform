<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AgentMetum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgentMetumRequest;
use App\Http\Requests\UpdateAgentMetumRequest;
use App\Http\Resources\Admin\AgentMetumResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgentMetaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('agent_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AgentMetumResource(AgentMetum::with(['user', 'agent'])->get());

    }

    public function store(StoreAgentMetumRequest $request)
    {
        $agentMetum = AgentMetum::create($request->all());

        return (new AgentMetumResource($agentMetum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(AgentMetum $agentMetum)
    {
        abort_if(Gate::denies('agent_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AgentMetumResource($agentMetum->load(['user', 'agent']));

    }

    public function update(UpdateAgentMetumRequest $request, AgentMetum $agentMetum)
    {
        $agentMetum->update($request->all());

        return (new AgentMetumResource($agentMetum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(AgentMetum $agentMetum)
    {
        abort_if(Gate::denies('agent_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agentMetum->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
