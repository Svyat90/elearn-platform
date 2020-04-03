<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVideoRequest;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('video_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Video::query()->select(sprintf('%s.*', (new Video)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'video_show';
                $editGate      = 'video_edit';
                $deleteGate    = 'video_delete';
                $crudRoutePart = 'videos';

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

        return view('admin.videos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('video_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.videos.create');
    }

    public function store(StoreVideoRequest $request)
    {
        $video = Video::create($request->all());

        return redirect()->route('admin.videos.index');

    }

    public function edit(Video $video)
    {
        abort_if(Gate::denies('video_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.videos.edit', compact('video'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->all());

        return redirect()->route('admin.videos.index');

    }

    public function show(Video $video)
    {
        abort_if(Gate::denies('video_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.videos.show', compact('video'));
    }

    public function destroy(Video $video)
    {
        abort_if(Gate::denies('video_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $video->delete();

        return back();

    }

    public function massDestroy(MassDestroyVideoRequest $request)
    {
        Video::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
