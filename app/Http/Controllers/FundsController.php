<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Fund;
use Illuminate\Http\Request;

class FundsController extends Controller
{
    public function index(Client $clients)
    {
        return view('funds', [
            'clients' => $clients->get()
        ]);
    }

    public function showFunds(Client $client, Fund $funds)
    {
        return view('client', [
            'client' => $client,
            'funds' => $funds->get()
        ]);
    }
}
