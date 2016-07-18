<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Configuration;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Configuration::environment($this->app['config']->get('services.braintree.environment'));
        // Configuration::merchantId($this->app['config']->get('services.braintree.merchant_id'));
        // Configuration::publicKey($this->app['config']->get('services.braintree.public_key'));
        // Configuration::privateKey($this->app['config']->get('services.braintree.private_key'));
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
