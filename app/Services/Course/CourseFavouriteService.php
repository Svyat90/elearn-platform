<?php

namespace App\Services\Course;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CourseFavouriteService extends CourseService
{

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

        return $this->getAvailableCourses()
            ->join('course_favorite', function ($join) {
                $join->on('course_favorite.course_id', 'courses.id');
                $join->on('course_favorite.user_id', DB::raw($this->getUser()->id));
            })->get();
    }

}
