<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOccasionRequest;
use App\Http\Requests\StoreOccasionRequest;
use App\Http\Requests\UpdateOccasionRequest;
use App\Occasion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OccasionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('occasion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Occasion::query()->select(sprintf('%s.*', (new Occasion)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'occasion_show';
                $editGate      = 'occasion_edit';
                $deleteGate    = 'occasion_delete';
                $crudRoutePart = 'occasions';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.occasions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('occasion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.occasions.create');
    }

    public function store(StoreOccasionRequest $request)
    {
        $occasion = Occasion::create($request->all());

        return redirect()->route('admin.occasions.index');

    }

    public function edit(Occasion $occasion)
    {
        abort_if(Gate::denies('occasion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.occasions.edit', compact('occasion'));
    }

    public function update(UpdateOccasionRequest $request, Occasion $occasion)
    {
        $occasion->update($request->all());

        return redirect()->route('admin.occasions.index');

    }

    public function show(Occasion $occasion)
    {
        abort_if(Gate::denies('occasion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.occasions.show', compact('occasion'));
    }

    public function destroy(Occasion $occasion)
    {
        abort_if(Gate::denies('occasion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $occasion->delete();

        return back();

    }

    public function massDestroy(MassDestroyOccasionRequest $request)
    {
        Occasion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
