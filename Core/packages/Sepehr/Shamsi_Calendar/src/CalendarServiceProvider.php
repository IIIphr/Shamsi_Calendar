<?php

namespace Sepehr\Shamsi_Calendar;

use Illuminate\Support\ServiceProvider;

class CalendarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('yoosuf\Calculator\CalendarController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
    }
}
