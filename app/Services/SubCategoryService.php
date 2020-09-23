<?php

namespace App\Services;

use App\SubCategory;
use App\Traits\FilterConstantsTrait;
use Illuminate\Http\Request;

class SubCategoryService
{
    use FilterConstantsTrait;

    public const SUB_CATEGORY_ACCESS_TYPE_PUBLIC = 'public';
    public const SUB_CATEGORY_ACCESS_TYPE_PROTECTED = 'protected';
    public const SUB_CATEGORY_ACCESS_TYPE_PRIVATE = 'private';

    /**
     * @return array
     */
    public static function getAccessTypes() : array
    {
        return static::filterConstants("SUB_CATEGORY_ACCESS_TYPE");
    }

    /**
     * @param SubCategory $subCategory
     * @param Request $request
     */
    public function handleRelationships(SubCategory $subCategory, Request $request) : void
    {
        $subCategory->roles()->sync($request->role_ids);
        $subCategory->users()->sync($request->user_ids);
    }

}
