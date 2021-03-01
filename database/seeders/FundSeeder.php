<?php

namespace Database\Seeders;

use App\Models\Fund;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fund = new Fund();
        $fund->name = 'ABC';
        $fund->type = 'HF';
        $fund->inception_date = Carbon::now();
        $fund->description = "ABC description";
        $fund->save();

        $fund = new Fund();
        $fund->name = 'DEF';
        $fund->type = 'PL';
        $fund->inception_date = Carbon::now();
        $fund->description = "DEF description";
        $fund->save();

        $fund = new Fund();
        $fund->name = 'GHI';
        $fund->type = 'VC';
        $fund->inception_date = Carbon::now();
        $fund->description = "GHI description";
        $fund->save();

        $fund = new Fund();
        $fund->name = 'JKL';
        $fund->type = 'RE';
        $fund->inception_date = Carbon::now();
        $fund->description = "JKL description";
        $fund->save();

        $fund = new Fund();
        $fund->name = 'MNO';
        $fund->type = 'PC';
        $fund->inception_date = Carbon::now();
        $fund->description = "MNO description";
        $fund->save();
    }
}
