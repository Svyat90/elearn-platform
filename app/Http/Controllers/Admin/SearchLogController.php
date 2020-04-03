<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySearchLogRequest;
use App\Http\Requests\StoreSearchLogRequest;
use App\Http\Requests\UpdateSearchLogRequest;
use App\SearchLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchLogController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('search_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $searchLogs = SearchLog::all();

        return view('admin.searchLogs.index', compact('searchLogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('search_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.searchLogs.create');
    }

    public function store(StoreSearchLogRequest $request)
    {
        $searchLog = SearchLog::create($request->all());

        return redirect()->route('admin.search-logs.index');

    }

    public function edit(SearchLog $searchLog)
    {
        abort_if(Gate::denies('search_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.searchLogs.edit', compact('searchLog'));
    }

    public function update(UpdateSearchLogRequest $request, SearchLog $searchLog)
    {
        $searchLog->update($request->all());

        return redirect()->route('admin.search-logs.index');

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
