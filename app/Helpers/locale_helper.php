<?php

use App\Services\AbstractAccessService;

if (!function_exists('localeColumn')) {

    /**
     * @param string $column
     * @return string
     */
    function localeColumn(string $column) : string
    {
        return sprintf("%s_%s", $column, config('app.locale_default_column'));
    }
}

if (!function_exists('localeAppColumn')) {

    /**
     * @param string $column
     * @return string
     */
    function localeAppColumn(string $column) : string
    {
        return sprintf("%s_%s", $column, app()->getLocale());
    }
}

if (!function_exists('localeStatus')) {

    /**
     * @param string $status
     * @return string
     */
    function localeStatus(string $status) : string
    {
        switch ($status) {
            case AbstractAccessService::STATUS_INITIAL:
                return trans('main.initial');
            case AbstractAccessService::STATUS_UPDATED:
                return trans('main.updated');
            case AbstractAccessService::STATUS_CANCELED:
                return trans('main.canceled');
            default:
                return "";
        }
    }
}
