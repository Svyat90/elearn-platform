<?php

namespace App\Http\Controllers\Traits;

use App\Setting;
use Illuminate\Support\Facades\View;

trait SettingTrait
{
    public function shareSettings() : void
    {
        $settings = Setting::query()->pluck('val', 'key')->toArray();

        View::share(compact('settings'));
    }
}
