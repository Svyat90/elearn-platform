<?php

namespace App\Services;

use App\Course;
use App\Role;
use App\Traits\FilterConstantsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
     * @param int $courseId
     * @return bool
     */
    public function toggleFavorite(int $courseId) : bool
    {
        if ( ! $this->getUser()) {
            return false;
        }

        $queryBuilder = DB::table('course_favorite')
            ->where('course_id', $courseId)
            ->where('user_id', $this->getUser()->id);

        if ((clone $queryBuilder)->first()) {
            $queryBuilder->delete();

            return false;
        }

        DB::table('course_favorite')->insert([
            'course_id' => $courseId,
            'user_id' => $this->getUser()->id
        ]);

        return true;
    }

    /**
     * @return Collection
     */
    public function getFavouriteCourses() : Collection
    {
        if ( ! $this->getUser()) {
            return collect();
        }

        return $this->getAvailableUserCourses()
            ->join('course_favorite', function ($join) {
                $join->on('course_favorite.course_id', 'courses.id');
                $join->on('course_favorite.user_id', DB::raw($this->getUser()->id));
            })->get();
    }

    /**
     * @param int $courseId
     * @return bool
     */
    public function toggleWatchLater(int $courseId) : bool
    {
        if ( ! $this->getUser()) {
            return false;
        }

        $queryBuilder = DB::table('course_watch_later')
            ->where('course_id', $courseId)
            ->where('user_id', $this->getUser()->id);

        if ((clone $queryBuilder)->first()) {
            $queryBuilder->delete();

            return false;
        }

        DB::table('course_watch_later')->insert([
            'course_id' => $courseId,
            'user_id' => $this->getUser()->id
        ]);

        return true;
    }

    /**
     * @return Collection
     */
    public function getWatchLaterCourses() : Collection
    {
        if ( ! $this->getUser()) {
            return collect();
        }

        return $this->getAvailableUserCourses()
            ->join('course_watch_later', function ($join) {
                $join->on('course_watch_later.course_id', 'courses.id');
                $join->on('course_watch_later.user_id', DB::raw($this->getUser()->id));
            })->get();
    }

    /**
     * @return Builder|BelongsToMany
     */
    public function getAvailableCourses()
    {
        if ( ! $this->getUser()) {
            return $this->getPublicCourses();
        }

        return Course::query()
            ->where('access', self::ACCESS_TYPE_PUBLIC)
            ->orWhere(function (Builder $query) {
                $query
                    ->where('access', self::ACCESS_TYPE_PROTECTED)
                    ->whereIn('id', $this->getProtectedCourseIds());
            });
    }

    /**
     * @return Builder|BelongsToMany
     */
    public function getAvailableUserCourses()
    {
        if ( ! $this->getUser()) {
            return $this->getPublicCourses();
        }

        // Get public and protected courses
        return $this->getUser()->courses()
            ->where('access', self::ACCESS_TYPE_PUBLIC)
            ->orWhere(function (Builder $query) {
                $query
                    ->where('course_user.user_id', $this->getUser()->id)
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
