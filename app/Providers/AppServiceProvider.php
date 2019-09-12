<?php

namespace App\Providers;
use App\Link\Link;
use App\Observers\LinkObserver;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Link::observe(LinkObserver::class);
    }
}
