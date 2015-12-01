<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Currency;
use GuzzleHttp\Client;

class View
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currencyModel = new Currency;
        $client = new Client;
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
        return $next($request);
    }
}
