<?php


namespace App\Services;


use App\Models\Rate;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class RatesService
 * @package App\Services
 */
class RatesService
{
    public function rates()
    {
        return  QueryBuilder::for(Rate::class)
                    ->defaultSort('-sell')
                    ->allowedSorts('sell')
                    ->get();
    }

    public function filter()
    {
        return  QueryBuilder::for(Rate::class)
                    ->allowedFilters('currency')
                    ->first();
    }

    public function convert($from, $to, $value)
    {
        $rate = Rate::whereIn('currency', [$from, $to])->first();

        if ($from === 'BTC') {
            $convertRate = $rate->buy;
            $convertedValue = round($value * $convertRate, 2);
        } else {
            $convertRate = round(1 / $rate->sell, 10);
            $convertedValue = round($value * $convertRate, 10);
        }

        return compact(['convertedValue', 'convertRate']);
    }
}
