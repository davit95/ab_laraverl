<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Currency;
use GuzzleHttp\Client;
use DateTime;

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
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        $last_refresh_time = session('last_refresh_time')?session('last_refresh_time'):(new DateTime('now'))->format('Y-m-d H:i:s');
        session(['last_refresh_time' => $last_refresh_time]);
        $session_duration = strtotime($now)-strtotime($last_refresh_time);
        if ($session_duration > 3600) {
            session()->forget('rates');
            session()->forget('rate');
            session(['last_refresh_time' => $now]);
        }
        // var_dump(session('rates'));
        // 12:36 array(4) { ["USD"]=> int(1) ["GBP"]=> float(0.663552) ["EUR"]=> float(0.941814) ["AUD"]=> float(1.367075) }
        // 15:11 array(4) { ["USD"]=> int(1) ["GBP"]=> float(0.664254) ["EUR"]=> float(0.941269) ["AUD"]=> float(1.364812) }
        if (is_null(session('currency'))) {
            $currency = $currencyModel->find(1);
            $currency = ['id' => $currency->id, 'name' => $currency->name, 'symbol' => $currency->symbol, 'image' => $currency->image];
            session(['currency' => $currency]);
        }

        // if (is_null(session('rates')) || is_null(session('rate'))) {
        //     $response = $client->get('https://openexchangerates.org/api/latest.json?app_id='.config('abcn.openexchangerates.app_id'))->json();            
        //     $rates['USD'] = $response['rates']['USD'];
        //     $rates['GBP'] = $response['rates']['GBP'];
        //     $rates['EUR'] = $response['rates']['EUR'];
        //     $rates['AUD'] = $response['rates']['AUD'];
        //     session(['rates' => $rates]);
        //     $currency_name = session('currency.name');
        //     session(['rate' => $response['rates'][$currency_name]]);
        // }        

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
