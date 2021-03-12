<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FetchRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Currencies BTC Rates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Client $client)
    {
        $rates = json_decode($client->get('https://blockchain.info/ticker')->getBody()->getContents());

        $insertData = [];
        foreach ($rates as $currency => $rate) {
            $insertData[] = [
               'currency' => $currency,
                'buy' => $rate->buy,
                'sell' => $rate->sell,
                'created_at' => now(),
            ];
        }

        DB::table('rates')->truncate();
        DB::table('rates')->insert($insertData);
    }
}
