<?php

namespace App\Http\Controllers\Traits;

use App\Services\AbstractAccessService;
use Illuminate\Support\Facades\View;

trait AccessTypes
{
    public function shareAccessTypes() : void
    {
        $accessTypes = collect(AbstractAccessService::getAccessTypes())
            ->prepend(trans('global.pleaseSelect'), '');

        View::share(compact('accessTypes'));
    }
}
