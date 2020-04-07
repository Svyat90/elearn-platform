<?php

namespace App\Http\Controllers\Admin;

use App\AminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAminUserRequest;
use App\Http\Requests\StoreAminUserRequest;
use App\Http\Requests\UpdateAminUserRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AminUserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('amin_user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AminUser::query()->select(sprintf('%s.*', (new AminUser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'amin_user_show';
                $editGate      = 'amin_user_edit';
                $deleteGate    = 'amin_user_delete';
                $crudRoutePart = 'amin-users';

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
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.aminUsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('amin_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aminUsers.create');
    }

    public function store(StoreAminUserRequest $request)
    {
        $aminUser = AminUser::create($request->all());

        return redirect()->route('admin.amin-users.index');

    }

    public function edit(AminUser $aminUser)
    {
        abort_if(Gate::denies('amin_user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aminUsers.edit', compact('aminUser'));
    }

    public function update(UpdateAminUserRequest $request, AminUser $aminUser)
    {
        $aminUser->update($request->all());

        return redirect()->route('admin.amin-users.index');

    }

    public function show(AminUser $aminUser)
    {
        abort_if(Gate::denies('amin_user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.aminUsers.show', compact('aminUser'));
    }

    public function destroy(AminUser $aminUser)
    {
        abort_if(Gate::denies('amin_user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aminUser->delete();

        return back();

    }

    public function massDestroy(MassDestroyAminUserRequest $request)
    {
        AminUser::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
