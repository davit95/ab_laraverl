<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('phone_or_fax', function ($attribute, $value, $parameters)
        {
            //dd($value, 'asd');
            if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $value)) {
              return true;
            } 
            return false;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
