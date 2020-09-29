<?php

namespace App\Http\Controllers\Traits;

use App\Services\CourseService;
use App\Services\DocumentService;
use App\User;
use Illuminate\Support\Facades\View;

trait FavouritesTrait
{

    /**
     * Share favourites documents
     *
     * @param User|null $user
     */
    public function shareFavourites(?User $user): void
    {
        $documentService = new DocumentService();
        $documentService->setUser($user);

        $favouriteDocumentIds = $documentService->getFavouriteDocuments()
            ->pluck('id')
            ->toArray();

        $courseService = new CourseService();
        $courseService->setUser($user);

        $favouriteCourseIds = $courseService->getFavouriteCourses()
            ->pluck('id')
            ->toArray();

        View::share(compact('favouriteDocumentIds', 'favouriteCourseIds'));
    }

}
