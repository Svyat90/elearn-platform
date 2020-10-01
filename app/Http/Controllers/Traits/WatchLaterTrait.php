<?php

namespace App\Http\Controllers\Traits;

use App\Services\Course\CourseWatchLaterService;
use App\Services\Document\DocumentWatchLaterService;
use App\User;
use Illuminate\Support\Facades\View;

trait WatchLaterTrait
{

    /**
     * Share favourites documents
     *
     * @param User|null $user
     */
    public function shareWatchLater( ? User $user): void
    {
        $documentWatchLaterService = new DocumentWatchLaterService();
        $documentWatchLaterService->setUser($user);

        $watchLaterDocumentIds = $documentWatchLaterService->getWatchLaterDocuments()
            ->pluck('id')
            ->toArray();

        $courseWatchLaterService = new CourseWatchLaterService();
        $courseWatchLaterService->setUser($user);

        $watchLaterCourseIds = $courseWatchLaterService->getWatchLaterCourses()
            ->pluck('id')
            ->toArray();

        View::share(compact('watchLaterDocumentIds', 'watchLaterCourseIds'));
    }

}
