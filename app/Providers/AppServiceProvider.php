<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Csv;
use App\Observers\CsvObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Csv::observe(CsvObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
