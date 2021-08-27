<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

trait CurrencyTrait
{
    public function getCurrency($from, $to)
    {
        $cache_name = $from.$to;

        if (Cache::store('file')->has($cache_name)) {
            return Cache::store('file')->get($cache_name);
        }

        $currency = Http::get('http://data.fixer.io/api/latest?access_key='.config('fixer.access_token').'&format=1');
        $currency = $currency->json();

        $rate = $currency[$to] / $currency[$from];

        Cache::store('file')->remember($cache_name, 7200, function () use ($rate) {
            return $rate;
        });

        return $rate;
    }
}
