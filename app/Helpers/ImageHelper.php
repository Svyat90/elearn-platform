<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * @param string|null $path
     * @return string
     */
    public static function smallImage(? string $path) : string
    {
        return $path
            ? sprintf('<img src="%s" width="50px" height="50px" />', storageUrl($path, 'small'))
            : '';
    }
}
