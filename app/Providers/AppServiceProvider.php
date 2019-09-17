<?php

namespace App\Providers;
use App\Domain;
use App\Link\Link;
use App\Project;
use App\Observers\DomainObserver;
use App\Observers\LinkObserver;
use App\Observers\ProjectObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Link::observe(LinkObserver::class);
        Project::observe(ProjectObserver::class);
        Domain::observe(DomainObserver::class);
    }
}
