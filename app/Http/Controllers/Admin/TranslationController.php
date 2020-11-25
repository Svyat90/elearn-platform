<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageFileHelper;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Translation\TranslationEditRequest;
use App\Http\Requests\Translation\TranslationUpdateRequest;
use App\Services\TranslationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class TranslationController extends AdminController
{
    /**
     * @var TranslationService
     */
    private TranslationService $service;

    /**
     * TranslationController constructor.
     * @param TranslationService $service
     */
    public function __construct(TranslationService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param TranslationEditRequest $request
     * @return View
     */
    public function edit(TranslationEditRequest $request) : View
    {
        abort_if(Gate::denies('translation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $files = $this->service->getFilesWithContent($request->path);

        return view('admin.translations.edit', compact('files'));
    }

    /**
     * @param TranslationUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(TranslationUpdateRequest $request) : RedirectResponse
    {
        abort_if(Gate::denies('translation_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        LanguageFileHelper::updateLanguageFile($request->data, $request->path);

        return redirect()
            ->back()
            ->with([
                'message' => trans('global.success_update')
            ]);
    }

}
