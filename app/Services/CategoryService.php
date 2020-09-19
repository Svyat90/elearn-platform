<?php

namespace App\Services;

use App\Traits\FilterConstantsTrait;

class CategoryService
{
    use FilterConstantsTrait;

    public const CATEGORY_ACCESS_TYPE_PUBLIC = 'public';
    public const CATEGORY_ACCESS_TYPE_PROTECTED = 'protected';
    public const CATEGORY_ACCESS_TYPE_PRIVATE = 'private';

    /**
     * @return array
     */
    public static function getAccessTypes() : array
    {
        return static::filterConstants("CATEGORY_ACCESS_TYPE");
    }

}
