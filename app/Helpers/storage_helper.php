<?php

if (!function_exists('default_locale')) {

    /**
     * @param string|null $path
     * @return string
     */
    function storageUrl( ? string $path = null) : string
    {
        if ( ! $path) return '';

        return sprintf("%s/storage/%s", config('app.url'), $path);
    }
}
