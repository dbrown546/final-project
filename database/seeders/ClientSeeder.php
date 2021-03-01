<?php

namespace Database\Seeders;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $client->name = 'Client 1';
        $client->permission = json_encode(['HF', 'PL', 'VC', 'RE', 'PC']);
        $client->description = 'Client 1 Description';
        $client->save();

        $client = new Client();
        $client->name = 'Client 2';
        $client->permission = json_encode(['VC', 'RE']);
        $client->description = 'Client 2 Description';
        $client->save();

        $client = new Client();
        $client->name = 'Client 3';
        $client->permission = json_encode(['PL', 'PC']);
        $client->description = 'Client 3 Description';
        $client->save();
    }
}
