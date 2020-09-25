<?php

if (!function_exists('storageUrl')) {

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

if (!function_exists('categoryImagePath')) {

    /**
     * @param int|null $categoryId
     * @return string
     */
    function categoryImagePath( ? int $categoryId = null) : string
    {
        switch ($categoryId) {
            case 1: $str = 'front/images/cat-img-1.png'; break;
            case 2: $str = 'front/images/cat-img-2.png'; break;
            case 3: $str = 'front/images/cat-img-3.png'; break;
            case 4: $str = 'front/images/cat-img-4.png'; break;
            default: $str = 'front/images/cat-img-3.png';
        }

        return asset($str);
    }
}

