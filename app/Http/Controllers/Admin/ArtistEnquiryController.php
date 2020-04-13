<?php

namespace App\Http\Controllers\Admin;

use App\ArtistEnquiry;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArtistEnquiryRequest;
use App\Http\Requests\StoreArtistEnquiryRequest;
use App\Http\Requests\UpdateArtistEnquiryRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArtistEnquiryController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('artist_enquiry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArtistEnquiry::with(['artist', 'country'])->select(sprintf('%s.*', (new ArtistEnquiry)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'artist_enquiry_show';
                $editGate      = 'artist_enquiry_edit';
                $deleteGate    = 'artist_enquiry_delete';
                $crudRoutePart = 'artist-enquiries';

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
            $table->addColumn('artist_first_name', function ($row) {
                return $row->artist ? $row->artist->first_name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('contact_no', function ($row) {
                return $row->contact_no ? $row->contact_no : "";
            });
            $table->editColumn('social_media_type', function ($row) {
                return $row->social_media_type ? $row->social_media_type : "";
            });
            $table->editColumn('social_media', function ($row) {
                return $row->social_media ? $row->social_media : "";
            });
            $table->editColumn('social_media_followrs', function ($row) {
                return $row->social_media_followrs ? $row->social_media_followrs : "";
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('country.name', function ($row) {
                return $row->country ? (is_string($row->country) ? $row->country : $row->country->name) : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ArtistEnquiry::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'artist', 'country']);

            return $table->make(true);
        }

        return view('admin.artistEnquiries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('artist_enquiry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artists = User::IsArtistRole()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.artistEnquiries.create', compact('artists', 'countries'));
    }

    public function store(StoreArtistEnquiryRequest $request)
    {
        $artistEnquiry = ArtistEnquiry::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $artistEnquiry->id]);
        }

        return redirect()->route('admin.artist-enquiries.index');

    }

    public function edit(ArtistEnquiry $artistEnquiry)
    {
        abort_if(Gate::denies('artist_enquiry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artists = User::IsArtistRole()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artistEnquiry->load('artist', 'country');

        return view('admin.artistEnquiries.edit', compact('artists', 'countries', 'artistEnquiry'));
    }

    public function update(UpdateArtistEnquiryRequest $request, ArtistEnquiry $artistEnquiry)
    {
        $artistEnquiry->update($request->all());

        return redirect()->route('admin.artist-enquiries.index');

    }

    public function show(ArtistEnquiry $artistEnquiry)
    {
        abort_if(Gate::denies('artist_enquiry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistEnquiry->load('artist', 'country');

        return view('admin.artistEnquiries.show', compact('artistEnquiry'));
    }

    public function destroy(ArtistEnquiry $artistEnquiry)
    {
        abort_if(Gate::denies('artist_enquiry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artistEnquiry->delete();

        return back();

    }

    public function massDestroy(MassDestroyArtistEnquiryRequest $request)
    {
        ArtistEnquiry::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('artist_enquiry_create') && Gate::denies('artist_enquiry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ArtistEnquiry();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
