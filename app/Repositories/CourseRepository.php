<?php

namespace App\Repositories;

use App\Course;
use App\Services\DocumentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CourseRepository extends Model
{

    /**
     * @return Collection
     */
    public function getRandomPublicCourses() : Collection
    {
        return Course::query()
            ->where('access', DocumentService::ACCESS_TYPE_PUBLIC)
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }

}
