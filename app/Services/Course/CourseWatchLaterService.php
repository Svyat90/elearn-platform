<?php

namespace App\Services\Course;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CourseWatchLaterService extends CourseService
{

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

        return $this->getAvailableCourses()
            ->join('course_watch_later', function ($join) {
                $join->on('course_watch_later.course_id', 'courses.id');
                $join->on('course_watch_later.user_id', DB::raw($this->getUser()->id));
            })->get();
    }

}
