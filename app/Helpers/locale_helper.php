<?php

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
