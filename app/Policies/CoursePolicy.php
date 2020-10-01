<?php

namespace App\Policies;

use App\Course;
use App\Services\Course\CourseService;
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
            ? $this->allow()
            : $this->deny(__('main.access_denied'), 403);
    }

    /**
     * @param User $user
     * @param Course $course
     * @return Response
     */
    public function favorite(User $user, Course $course) : Response
    {
        return in_array($course->id, $this->availableCourseIds)
            ? $this->allow()
            : $this->deny(__('main.access_denied'), 403);
    }

    /**
     * @param User $user
     * @param Course $course
     * @return Response
     */
    public function watchLater(User $user, Course $course) : Response
    {
        return in_array($course->id, $this->availableCourseIds)
            ? $this->allow()
            : $this->deny(__('main.access_denied'), 403);
    }

}
