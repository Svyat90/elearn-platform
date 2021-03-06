<?php

if (!function_exists('storageUrl')) {

    /**
     * @param string|null $path
     * @param string|null $type
     * @return string
     */
    function storageUrl( ? string $path = null, ? string $type = null) : string
    {
        if ( ! $path) return '';

        if ($type !== null) {
            [$path, $exp] = explode(".", $path);
            switch ($type) {
                case 'small':
                    $path = sprintf('%s-%s.%s', $path, 'small', $exp);
                    break;
                case 'medium':
                    $path = sprintf('%s-%s.%s', $path, 'medium', $exp);
                    break;
                case 'large':
                    $path = sprintf('%s-%s.%s', $path, 'large', $exp);
                    break;
            }
        }

        return sprintf("%s/storage/%s", config('app.url'), $path);
    }
}

if (!function_exists('fileStoragePath')) {

    /**
     * @param string|null $path
     * @return string
     */
    function fileStoragePath( ? string $path = null) : string
    {
        if ( ! $path) return '';

        return storage_path("app/public/" . $path);
    }
}

if (!function_exists('categoryImagePath')) {

    /**
     * @param int $categoryId
     * @return string
     */
    function categoryImagePath(int $categoryId) : string
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

if (!function_exists('favoriteImagePath')) {

    /**
     * @param bool $isFavourite
     * @return string
     */
    function favoriteImagePath(bool $isFavourite) : string
    {
        if ($isFavourite) {
            return asset('front/images/bookmark.svg');
        }

        return asset('front/images/bookmark-white.svg');
    }
}

if (!function_exists('watchLaterImagePath')) {

    /**
     * @param bool $isFavourite
     * @return string
     */
    function watchLaterImagePath(bool $isFavourite) : string
    {
        if ($isFavourite) {
            return asset('front/images/clock.svg');
        }

        return asset('front/images/clock-white.svg');
    }
}

