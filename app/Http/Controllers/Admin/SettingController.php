<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends AdminController
{
    /**
     * @return View
     */
    public function index() : View
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = Setting::all();

        return view('admin.settings.index', compact('settings'));
    }


    /**
     * @param Setting $setting
     * @return View
     */
    public function edit(Setting $setting) : View
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * @param Setting $setting
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Setting $setting, Request $request) : RedirectResponse
    {
        abort_if(Gate::denies('setting_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setting->update(['val' => $request->input('val')]);

        return redirect()->route('admin.settings.index');
    }

}
