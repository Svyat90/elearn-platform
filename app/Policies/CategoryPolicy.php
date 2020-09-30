<?php

namespace App\Policies;

use App\Category;
use App\Services\CategoryService;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * @var array
     */
    protected array $availableCategoryIds = [];

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->availableCategoryIds = (new CategoryService())
            ->getAvailableCategories()
            ->pluck('id')
            ->toArray();
    }

    /**
     * @param User $user
     * @param Category $category
     * @return Response
     */
    public function show(User $user, Category $category) : Response
    {
        return in_array($category->id, $this->availableCategoryIds)
            ? Response::allow()
            : Response::deny(__('main.access_denied'));
    }

}
