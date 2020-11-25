<?php

namespace App\Http\Controllers\Traits;

use App\Services\TranslationService;
use Illuminate\Support\Facades\View;

trait TranslationTrait
{
    public function shareTranslations() : void
    {
        $service = new TranslationService;

        $languages = $service->getLanguages();

        View::share(compact('languages'));
    }
}
