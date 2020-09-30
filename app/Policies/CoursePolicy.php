<?php

namespace App\Policies;

use App\Course;
use App\Services\CourseService;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * @var array
     */
    protected array $availableCourseIds = [];

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->availableCourseIds = (new CourseService())
            ->getAvailableCourses()
            ->pluck('id')
            ->toArray();
    }

    /**
     * @param User|null $user
     * @param Course $course
     * @return Response
     */
    public function show( ? User $user, Course $course) : Response
    {
        return in_array($course->id, $this->availableCourseIds)
            ? Response::allow()
            : Response::deny(__('main.access_denied'));
    }

    /**
     * @param User $user
     * @param int $courseId
     * @return Response
     */
    public function favorite(User $user, int $courseId) : Response
    {
        return in_array($courseId, $this->availableCourseIds)
            ? Response::allow()
            : Response::deny(__('main.access_denied'));
    }

    /**
     * @param User $user
     * @param int $courseId
     * @return Response
     */
    public function watchLater(User $user, int $courseId) : Response
    {
        return in_array($courseId, $this->availableCourseIds)
            ? Response::allow()
            : Response::deny(__('main.access_denied'));
    }

}
