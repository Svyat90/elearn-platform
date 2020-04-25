<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySearchLogRequest;
use App\SearchLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SearchLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('search_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SearchLog::query()->select(sprintf('%s.*', (new SearchLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'search_log_show';
                $editGate      = 'search_log_edit';
                $deleteGate    = 'search_log_delete';
                $crudRoutePart = 'search-logs';

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
            $table->editColumn('search_term', function ($row) {
                return $row->search_term ? $row->search_term : "";
            });
            $table->editColumn('search_from', function ($row) {
                return $row->search_from ? SearchLog::SEARCH_FROM_SELECT[$row->search_from] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.searchLogs.index');
    }

    public function show(SearchLog $searchLog)
    {
        abort_if(Gate::denies('search_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.searchLogs.show', compact('searchLog'));
    }

    public function destroy(SearchLog $searchLog)
    {
        abort_if(Gate::denies('search_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $searchLog->delete();

        return back();

    }

    public function massDestroy(MassDestroySearchLogRequest $request)
    {
        SearchLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
