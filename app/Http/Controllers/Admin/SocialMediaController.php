<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySocialMediumRequest;
use App\Http\Requests\StoreSocialMediumRequest;
use App\Http\Requests\UpdateSocialMediumRequest;
use App\SocialMedium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SocialMediaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('social_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SocialMedium::query()->select(sprintf('%s.*', (new SocialMedium)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'social_medium_show';
                $editGate      = 'social_medium_edit';
                $deleteGate    = 'social_medium_delete';
                $crudRoutePart = 'social-media';

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
            $table->editColumn('short_code', function ($row) {
                return $row->short_code ? $row->short_code : "";
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.socialMedia.index');
    }

    public function create()
    {
        abort_if(Gate::denies('social_medium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialMedia.create');
    }

    public function store(StoreSocialMediumRequest $request)
    {
        $socialMedium = SocialMedium::create($request->all());

        return redirect()->route('admin.social-media.index');

    }

    public function edit(SocialMedium $socialMedium,$id)
    {
        $socialMedium = SocialMedium::find($id);
        abort_if(Gate::denies('social_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialMedia.edit', compact('socialMedium'));
    }

    public function update(Request $request, SocialMedium $socialMedium,$id)
    {
        $socialMedium = SocialMedium::find($id);
        $socialMedium->update($request->all());

        return redirect()->route('admin.social-media.index');

    }

    public function show(SocialMedium $socialMedium,$id)
    {
        $socialMedium = SocialMedium::find($id);
        abort_if(Gate::denies('social_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialMedia.show', compact('socialMedium'));
    }

    public function destroy(SocialMedium $socialMedium,$id)
    {
        $socialMedium = SocialMedium::find($id);
        abort_if(Gate::denies('social_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialMedium->delete();

        return back();

    }

    public function massDestroy(MassDestroySocialMediumRequest $request)
    {
        SocialMedium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
