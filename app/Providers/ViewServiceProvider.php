<?php

namespace App\Providers;

use Illuminate\Session\SessionServiceProvider as ServiceProvider;
use App\Models\Currency;
use GuzzleHttp\Client;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Currency $currencyModel, Client $client)
    {
        if (is_null(session('currency'))) {
            $currency = $currencyModel->find(1);
            $currency = ['id' => $currency->id, 'name' => $currency->name, 'symbol' => $currency->symbol, 'image' => $currency->image];
            session(['currency' => $currency]);
        }

        if (is_null(session('rates'))) {
            $response = $client->get('https://openexchangerates.org/api/latest.json?app_id='.config('abcn.openexchangerates.app_id'))->json();
            $rates['USD'] = $response['rates']['USD'];
            $rates['GBP'] = $response['rates']['GBP'];
            $rates['EUR'] = $response['rates']['EUR'];
            $rates['AUD'] = $response['rates']['AUD'];
            session(['rates' => $rates]);
            session(['rate' => $response['rates'][$currency['name']]]);
        }

        if (is_null(session('currencies'))) {
            $currencies = [];
            foreach ($currencyModel->all() as $key => $currency) {
                $currencies[] = (object)['id' => $currency->id, 'name' => $currency->name, 'symbol' => $currency->symbol, 'image' => $currency->image];
            }
            session(['currencies' => $currencies]);
        }

        view()->share('currencies', session('currencies'));
    }
}
