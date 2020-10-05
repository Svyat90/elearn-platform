<?php

namespace App\Providers;

use App\Document;
use App\Services\Search\ElasticSearchObserver;
use App\Services\Search\SearchService;
use App\Services\Search\ElasticSearchRepository;
use App\Services\Search\EloquentRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SearchService::class, function ($app) {
            if ( ! config('services.search.enabled')) {
                return new EloquentRepository();
            }

            return new ElasticSearchRepository(
                $app->make(Client::class)
            );
        });

        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('services.search.enabled')) {
            Document::observe(ElasticSearchObserver::class);
        }
    }
}
