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
        if (is_null(session('currency'))) {            
            $currency = $currencyModel->find(1);
            $currency = ['id' => $currency->id, 'name' => $currency->name, 'symbol' => $currency->symbol, 'image' => $currency->image];
            session(['currency' => $currency]);
        }

        if (is_null(session('rates')) || is_null(session('rate'))) {
            $url = 'https://openexchangerates.org/api/latest.json?app_id='.env('APP_ID','14ce569cde554a9a928d9af06d8e45db').'';
            $curl = curl_init();
            curl_setopt ($curl, CURLOPT_URL, $url);
            curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec ($curl);
            curl_close ($curl);
            $result = json_decode($result,true);
            $currency = $result['rates'];

            $response['rates'] = [
                'USD' => $currency['USD'],//1
                'GBP' => $currency['GBP'],//1.7
                'EUR' => $currency['EUR'],//1.2
                'AUD' => $currency['AUD']//0.8
            ];
            $rates['USD'] = $response['rates']['USD'];
            $rates['GBP'] = $response['rates']['GBP'];
            $rates['EUR'] = $response['rates']['EUR'];
            $rates['AUD'] = $response['rates']['AUD'];
            session(['rates' => $rates]);
            $currency_name = session('currency.name');
            session(['rate' => $response['rates'][$currency_name]]);
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
