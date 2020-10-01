<?php

namespace App\Http\Controllers\Traits;

use App\Services\Course\CourseFavouriteService;
use App\Services\Document\DocumentFavouriteService;
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
        $documentFavouriteService = new DocumentFavouriteService();
        $documentFavouriteService->setUser($user);

        $favouriteDocumentIds = $documentFavouriteService->getFavouriteDocuments()
            ->pluck('id')
            ->toArray();

        $courseFavouriteService = new CourseFavouriteService();
        $courseFavouriteService->setUser($user);

        $favouriteCourseIds = $courseFavouriteService->getFavouriteCourses()
            ->pluck('id')
            ->toArray();

        View::share(compact('favouriteDocumentIds', 'favouriteCourseIds'));
    }

}
