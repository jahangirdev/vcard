<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Vcards;

class VcardsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('vcards', function () {
            return new Vcards;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
