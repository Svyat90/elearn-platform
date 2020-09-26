<?php

namespace App\Services;

use App\Course;
use App\Role;
use App\Traits\FilterConstantsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class CourseService extends AbstractAccessService
{
    use FilterConstantsTrait;

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

    /**
     * @return Builder|BelongsToMany
     */
    public function getAvailableCourses()
    {
        if ( ! $this->getUser()) {
            return $this->getPublicCourses();
        }

        // Get public and protected courses
        return $this->getUser()->courses()
            ->where('access', self::ACCESS_TYPE_PUBLIC)
            ->orWhere(function (Builder $query) {
                $query
                    ->where('user_id', $this->getUser()->id)
                    ->where('access', self::ACCESS_TYPE_PROTECTED)
                    ->whereIn('id', $this->getProtectedCourseIds());
            });
    }

    /**
     * @return Builder
     */
    public function getPublicCourses() : Builder
    {
        return Course::query()->where('access', self::ACCESS_TYPE_PUBLIC);
    }

    /**
     * @return Collection
     */
    public function getProtectedCourses() : Collection
    {
        return $this->getUser()->courses()
            ->where('access', self::ACCESS_TYPE_PROTECTED)
            ->whereIn('id', $this->getProtectedCourseIds())
            ->get();
    }

    /**
     * @return array
     */
    private function getProtectedCourseIds() : array
    {
        if ( ! $this->getUser())
            return [];

        $roleCourses = $this->getRolesCourses();
        $userCourses = $this->getUserCourses();

        return $roleCourses
            ->merge($userCourses)
            ->unique()
            ->toArray();
    }

    /**
     * @return Collection
     */
    private function getRolesCourses() : Collection
    {
        return $this->getUser()->roles->map(function (Role $role) {
            return $role->courses->map(function (Course $course) {
                return $course->id;
            });
        })->collapse();
    }

    /**
     * @return Collection
     */
    private function getUserCourses() : Collection
    {
        return $this->getUser()->courses->map(function (Course $course) {
            return $course->id;
        });
    }

}
