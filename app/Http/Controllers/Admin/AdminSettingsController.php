<?php

namespace App\Http\Controllers\Admin;

use App\AdminSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAdminSettingRequest;
use App\Http\Requests\StoreAdminSettingRequest;
use App\Http\Requests\UpdateAdminSettingRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AdminSettingsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('admin_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AdminSetting::query()->select(sprintf('%s.*', (new AdminSetting)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'admin_setting_show';
                $editGate      = 'admin_setting_edit';
                $deleteGate    = 'admin_setting_delete';
                $crudRoutePart = 'admin-settings';

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
            $table->editColumn('company_commission', function ($row) {
                return $row->company_commission ? $row->company_commission : "";
            });
            $table->editColumn('referral_user_commision', function ($row) {
                return $row->referral_user_commision ? $row->referral_user_commision : "";
            });
            $table->editColumn('referal_artist_commision', function ($row) {
                return $row->referal_artist_commision ? $row->referal_artist_commision : "";
            });
            $table->editColumn('referal_agent_commision', function ($row) {
                return $row->referal_agent_commision ? $row->referal_agent_commision : "";
            });
            $table->editColumn('artist_video_show_count_web', function ($row) {
                return $row->artist_video_show_count_web ? $row->artist_video_show_count_web : "";
            });
            $table->editColumn('artist_video_show_count_app', function ($row) {
                return $row->artist_video_show_count_app ? $row->artist_video_show_count_app : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.adminSettings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('admin_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adminSettings.create');
    }

    public function store(StoreAdminSettingRequest $request)
    {
        $adminSetting = AdminSetting::create($request->all());

        return redirect()->route('admin.admin-settings.index');

    }

    public function edit(AdminSetting $adminSetting)
    {
        abort_if(Gate::denies('admin_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adminSettings.edit', compact('adminSetting'));
    }

    public function update(UpdateAdminSettingRequest $request, AdminSetting $adminSetting)
    {
        $adminSetting->update($request->all());

        return redirect()->route('admin.admin-settings.index');

    }

    public function show(AdminSetting $adminSetting)
    {
        abort_if(Gate::denies('admin_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adminSettings.show', compact('adminSetting'));
    }

    public function destroy(AdminSetting $adminSetting)
    {
        abort_if(Gate::denies('admin_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adminSetting->delete();

        return back();

    }

    public function massDestroy(MassDestroyAdminSettingRequest $request)
    {
        AdminSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
