<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use App\Collections\MyCollection;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();

        Collection::macro('myCollection', function ($items = []) {
            return new MyCollection($items);
        });
    }
}
