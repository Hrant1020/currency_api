<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $casts = [
        'sell' => 'float',
        'buy' => 'float',
    ];


    public function getSellAttribute($sell)
    {
        return  $sell + $sell * config('app.commission_percentage') / 100;
    }
}
