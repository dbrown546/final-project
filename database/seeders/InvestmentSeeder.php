<?php

namespace Database\Seeders;

use App\Models\Investment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $investment = new Investment();
        $investment->name = 'Investment ABC';
        $investment->client_id = 1;
        $investment->fund_id = 1;
        $investment->date = Carbon::now();
        $investment->amount = 1000000.00;
        $investment->save();

        $investment = new Investment();
        $investment->name = 'Investment DEF';
        $investment->client_id = 3;
        $investment->fund_id = 2;
        $investment->date = Carbon::now();
        $investment->amount = 1000000.00;
        $investment->save();

        $investment = new Investment();
        $investment->name = 'Investment GHI';
        $investment->client_id = 2;
        $investment->fund_id = 3;
        $investment->date = Carbon::now();
        $investment->amount = 1000000.00;
        $investment->save();

        $investment = new Investment();
        $investment->name = 'Investment JKL';
        $investment->client_id = 2;
        $investment->fund_id = 4;
        $investment->date = Carbon::now();
        $investment->amount = 1000000.00;
        $investment->save();

        $investment = new Investment();
        $investment->name = 'Investment MNO';
        $investment->client_id = 3;
        $investment->fund_id = 5;
        $investment->date = Carbon::now();
        $investment->amount = 1000000.00;
        $investment->save();
    }
}
