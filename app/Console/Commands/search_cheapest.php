<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class search_cheapest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:search-cheapest{price}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get the cheapest product';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
{
    $thresholdPrice = $this->argument('price');

    $cheapestProducts = DB::table('pharmacy_medicine')
        ->where('price', '>', $thresholdPrice)
        ->limit(10)
        ->get(); // Retrieve the results
        \Log::info('Query executed:', ['price' => $thresholdPrice, 'result' => $cheapestProducts]);
        dd($cheapestProducts->toJson());
}

    
    
}
