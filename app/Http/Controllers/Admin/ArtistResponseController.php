<?php

namespace App\Http\Controllers\Admin;

use App\ArtistMetum;
use App\ArtistResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyArtistResponseRequest;
use App\Http\Requests\StoreArtistResponseRequest;
use App\Http\Requests\UpdateArtistResponseRequest;
use App\Order;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArtistResponseController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('artist_response_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArtistResponse::with(['order', 'video', 'artist'])->select(sprintf('%s.*', (new ArtistResponse)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'artist_response_show';
                $editGate      = 'artist_response_edit';
                $deleteGate    = 'artist_response_delete';
                $crudRoutePart = 'artist-responses';

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
            $table->addColumn('order_payment_status', function ($row) {
                return $row->order ? $row->order->payment_status : '';
            });

            $table->editColumn('artist_action', function ($row) {
                return $row->artist_action ? ArtistResponse::ARTIST_ACTION_SELECT[$row->artist_action] : '';
            });
            $table->editColumn('video_status', function ($row) {
                return $row->video_status ? ArtistResponse::VIDEO_STATUS_SELECT[$row->video_status] : '';
            });
            $table->addColumn('video_name', function ($row) {
                return $row->video ? $row->video->name : '';
            });

            $table->editColumn('artist_note', function ($row) {
                return $row->artist_note ? $row->artist_note : "";
            });

            $table->addColumn('artist_display_name', function ($row) {
                return $row->artist ? $row->artist->display_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'order', 'video', 'artist']);

            return $table->make(true);
        }

        return view('admin.artistResponses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('artist_response_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('payment_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videos = Video::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artists = ArtistMetum::all()->pluck('display_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.artistResponses.create', compact('orders', 'videos', 'artists'));
    }

    public function store(StoreArtistResponseRequest $request)
    {
        $artistResponse = ArtistResponse::create($request->all());

        return redirect()->route('admin.artist-responses.index');

    }

    public function edit(ArtistResponse $artistResponse)
    {
        abort_if(Gate::denies('artist_response_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all()->pluck('payment_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videos = Video::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artists = ArtistMetum::all()->pluck('display_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artistResponse->load('order', 'video', 'artist');

        return view('admin.artistResponses.edit', compact('orders', 'videos', 'artists', 'artistResponse'));
    }

    public function update(UpdateArtistResponseRequest $request, ArtistResponse $artistResponse)
    {
        $artistResponse->update($request->all());

        return redirect()->route('admin.artist-responses.index');

    }

    public function show(ArtistResponse $artistResponse)
    {
        abort_if(Gate::denies('artist_response_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistResponse->load('order', 'video', 'artist');

        return view('admin.artistResponses.show', compact('artistResponse'));
    }

    public function destroy(ArtistResponse $artistResponse)
    {
        abort_if(Gate::denies('artist_response_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistResponse->delete();

        return back();

    }

    public function massDestroy(MassDestroyArtistResponseRequest $request)
    {
        ArtistResponse::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
