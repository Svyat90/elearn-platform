<?php

namespace App\Http\Controllers\Admin;

use App\AgentMetum;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgentMetumRequest;
use App\Http\Requests\StoreAgentMetumRequest;
use App\Http\Requests\UpdateAgentMetumRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgentMetaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('agent_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AgentMetum::with(['user', 'agent'])->select(sprintf('%s.*', (new AgentMetum)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'agent_metum_show';
                $editGate      = 'agent_metum_edit';
                $deleteGate    = 'agent_metum_delete';
                $crudRoutePart = 'agent-meta';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->editColumn('agent_commission', function ($row) {
                return $row->agent_commission ? $row->agent_commission : "";
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : "";
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : "";
            });
            $table->editColumn('agent_status', function ($row) {
                return $row->agent_status ? $row->agent_status : "";
            });

            $table->addColumn('agent_first_name', function ($row) {
                return $row->agent ? $row->agent->first_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'agent']);

            return $table->make(true);
        }

        return view('admin.agentMeta.index');
    }

    public function create()
    {
        abort_if(Gate::denies('agent_metum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agents = User::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.agentMeta.create', compact('users', 'agents'));
    }

    public function store(StoreAgentMetumRequest $request)
    {
        $agentMetum = AgentMetum::create($request->all());

        return redirect()->route('admin.agent-meta.index');

    }

    public function edit(AgentMetum $agentMetum)
    {
        abort_if(Gate::denies('agent_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agents = User::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agentMetum->load('user', 'agent');

        return view('admin.agentMeta.edit', compact('users', 'agents', 'agentMetum'));
    }

    public function update(UpdateAgentMetumRequest $request, AgentMetum $agentMetum)
    {
        $agentMetum->update($request->all());

        return redirect()->route('admin.agent-meta.index');

    }

    public function show(AgentMetum $agentMetum)
    {
        abort_if(Gate::denies('agent_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agentMetum->load('user', 'agent');

        return view('admin.agentMeta.show', compact('agentMetum'));
    }

    public function destroy(AgentMetum $agentMetum)
    {
        abort_if(Gate::denies('agent_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agentMetum->delete();

        return back();

    }

    public function massDestroy(MassDestroyAgentMetumRequest $request)
    {
        AgentMetum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
