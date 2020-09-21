<?php

namespace App\Services;

use App\Course;
use App\Traits\FilterConstantsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseService
{
    use FilterConstantsTrait;

    public const COURSE_ACCESS_TYPE_PUBLIC = 'public';
    public const COURSE_ACCESS_TYPE_PROTECTED = 'protected';
    public const COURSE_ACCESS_TYPE_PRIVATE = 'private';

    /**
     * @return array
     */
    public static function getAccessTypes() : array
    {
        return self::filterConstants("COURSE_ACCESS");
    }

    /**
     * @param Course $course
     * @param string $imagePath
     */
    public function handleImage(Course $course, string $imagePath) : void
    {
        if ($course->image_path && $course->image_path !== $imagePath) {
            $imagePath = storage_path('app/public/' . $course->image_path);
            File::delete($imagePath);
        }
    }

    /**
     * @param Course $course
     * @param Request $request
     */
    public function handleRelationships(Course $course, Request $request) : void
    {
        $course->roles()->sync($request->role_ids);
        $course->users()->sync($request->user_ids);
        $course->categories()->sync($request->category_ids);
        $course->documents()->sync($request->document_ids);
    }

}
