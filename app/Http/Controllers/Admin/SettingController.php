<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\AdminController;
use App\Services\SettingService;
use App\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends AdminController
{
    /**
     * @var SettingService
     */
    private SettingService $service;

    /**
     * SettingController constructor.
     */
    public function __construct(SettingService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function index() : View
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = $this->service->getSettingsWithHomeCategory();

        return view('admin.settings.index', compact('settings'));
    }


    /**
     * @param Setting $setting
     * @return View
     */
    public function edit(Setting $setting) : View
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allCategories = Category::all()->pluck(localeColumn('name'), 'id');

        return view('admin.settings.edit', compact('setting', 'allCategories'));
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
