<?php

namespace App\Http\Controllers\Traits;

use App\Services\AbstractAccessService;
use Illuminate\Support\Facades\View;

trait AccessStatuses
{
    public function shareAccessStatuses() : void
    {
        $statuses = AbstractAccessService::getStatuses();

        $statusesSelect = collect($statuses)
            ->prepend(trans('global.pleaseSelect'), '');

        View::share(compact('statuses', 'statusesSelect'));
    }
}
