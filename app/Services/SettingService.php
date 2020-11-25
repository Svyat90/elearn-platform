<?php

namespace App\Services;

use App\Category;
use App\Setting;
use Illuminate\Support\Collection;

class SettingService
{
    public const HOME_CATEGORY_DOCUMENTS_KEY = 'home_category_documents';

    /**
     * @return Collection
     */
    public function getSettingsWithHomeCategory() : Collection
    {
        return Setting::all()
            ->toBase()
            ->map(function ($setting) {
                if ($setting->key === self::HOME_CATEGORY_DOCUMENTS_KEY && $setting->val) {
                    $setting->val = Category::query()->find($setting->val)->{localeColumn('name')} ?? '';
                }
                return $setting;
            });
    }

    /**
     * @return mixed
     */
    public static function getHomeCategory()
    {
        $settingHomeCategory = Setting::query()
            ->where('key', self::HOME_CATEGORY_DOCUMENTS_KEY)
            ->first();

        if (! $settingHomeCategory) {
            return null;
        }

        return Category::query()->find($settingHomeCategory->val);
    }

}
