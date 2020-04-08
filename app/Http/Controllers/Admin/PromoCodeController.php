<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPromoCodeRequest;
use App\Http\Requests\StorePromoCodeRequest;
use App\Http\Requests\UpdatePromoCodeRequest;
use App\PromoCode;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PromoCodeController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('promo_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PromoCode::query()->select(sprintf('%s.*', (new PromoCode)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'promo_code_show';
                $editGate      = 'promo_code_edit';
                $deleteGate    = 'promo_code_delete';
                $crudRoutePart = 'promo-codes';

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
            $table->editColumn('promo_code', function ($row) {
                return $row->promo_code ? $row->promo_code : "";
            });
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : "";
            });
            $table->editColumn('minimum_order_value', function ($row) {
                return $row->minimum_order_value ? $row->minimum_order_value : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.promoCodes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('promo_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.promoCodes.create');
    }

    public function store(StorePromoCodeRequest $request)
    {
        $promoCode = PromoCode::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $promoCode->id]);
        }

        return redirect()->route('admin.promo-codes.index');

    }

    public function edit(PromoCode $promoCode)
    {
        abort_if(Gate::denies('promo_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.promoCodes.edit', compact('promoCode'));
    }

    public function update(UpdatePromoCodeRequest $request, PromoCode $promoCode)
    {
        $promoCode->update($request->all());

        return redirect()->route('admin.promo-codes.index');

    }

    public function show(PromoCode $promoCode)
    {
        abort_if(Gate::denies('promo_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.promoCodes.show', compact('promoCode'));
    }

    public function destroy(PromoCode $promoCode)
    {
        abort_if(Gate::denies('promo_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $promoCode->delete();

        return back();

    }

    public function massDestroy(MassDestroyPromoCodeRequest $request)
    {
        PromoCode::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('promo_code_create') && Gate::denies('promo_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PromoCode();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

}
