<?php

namespace App\Services;

class CategoryService
{
    public const CATEGORY_ACCESS_TYPE_PUBLIC = 'public';
    public const CATEGORY_ACCESS_TYPE_PROTECTED = 'protected';
    public const CATEGORY_ACCESS_TYPE_PRIVATE = 'private';

    /**
     * @return array
     */
    public static function getAccessTypes() : array
    {
        $reflector = new \ReflectionClass(static::class);

        return collect($reflector->getConstants())
            ->filter(function ($item, $key) {
                if (strpos($key, "CATEGORY_ACCESS_TYPE") !== false) return true;
                    else return false;
                })
            ->values()
            ->toArray();
    }

}
