<?php

namespace App\Providers;

use App\Category;
use App\Course;
use App\Document;
use App\Policies\CategoryPolicy;
use App\Policies\CoursePolicy;
use App\Policies\DocumentPolicy;
use App\Policies\SubCategoryPolicy;
use App\SubCategory;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Document::class => DocumentPolicy::class,
        Course::class => CoursePolicy::class,
        Category::class => CategoryPolicy::class,
        SubCategory::class => SubCategoryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!app()->runningInConsole()) {
            Passport::routes();
        }
    }

}
