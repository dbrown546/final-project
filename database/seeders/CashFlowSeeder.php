<?php

namespace Database\Seeders;

use App\Models\CashFlow;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CashFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cashFlow = new CashFlow();
        $cashFlow->investment_id = 1;
        $cashFlow->date = Carbon::now();
        $cashFlow->return = '005.00';
        $cashFlow->save();

        $cashFlow = new CashFlow();
        $cashFlow->investment_id = 2;
        $cashFlow->date = Carbon::now();
        $cashFlow->return = '006.00';
        $cashFlow->save();

        $cashFlow = new CashFlow();
        $cashFlow->investment_id = 3;
        $cashFlow->date = Carbon::now();
        $cashFlow->return = '007.00';
        $cashFlow->save();

        $cashFlow = new CashFlow();
        $cashFlow->investment_id = 4;
        $cashFlow->date = Carbon::now();
        $cashFlow->return = '008.00';
        $cashFlow->save();

        $cashFlow = new CashFlow();
        $cashFlow->investment_id = 5;
        $cashFlow->date = Carbon::now();
        $cashFlow->return = '009.00';
        $cashFlow->save();
    }
}
