<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Currency;
use GuzzleHttp\Client;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Currency $currency, Client $client)
    {
        /*if (is_null(session('rates'))) {
            $response = $client->get('https://openexchangerates.org/api/latest.json?app_id='.config('abcn.openexchangerates.app_id'))->json();
            $rates['USD'] = $response['rates']['USD'];
            $rates['GBP'] = $response['rates']['GBP'];
            $rates['EUR'] = $response['rates']['EUR'];
            $rates['AUD'] = $response['rates']['AUD'];
            session(['rates' => $rates]);
        }

        if (is_null(session('currency'))) {
            session(['currency' => 'USD']);
        }
        if (is_null(session('currencies'))) {
            $currencies = [];
            foreach ($currency->all() as $key => $currency) {
                $currencies[] = (object)['id' => $currency->id, 'name' => $currency->name, 'symbol' => $currency->symbol, 'image' => $currency->image];
            }
            session(['currencies' => $currencies]);
        }*/
        //var_dump(session('currencies'),session('currency'),session('rates'));

        view()->share('currencies', session('currencies'));
    }
}
