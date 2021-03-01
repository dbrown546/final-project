<?php

namespace App\Http\Controllers;

use App\Models\CashFlow;
use App\Models\Client;
use App\Models\Fund;
use App\Models\Investment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    public function index()
    {
        return view('cash-flow');
    }

    public function getClients(Client $clients)
    {
        return $clients->get();
    }

    public function getClientData(Request $request, Client $client, Investment $investments, Fund $funds)
    {
        $fundIds = $investments->where('client_id', $client->id)->pluck('fund_id');
        $fundTypes = $funds->whereIn('id', $fundIds)->pluck('type')->unique();

        return [
            'client' => $client,
            'fundTypes' => $fundTypes
        ];
    }

    public function getInvestments(Request $request, Client $client, Investment $investments)
    {
        $fundType = $request->fundType;

        $investments = $investments->with(['fund'])
            ->where('client_id', '=', $client->id)
            ->whereHas('fund', function ($query) use ($fundType) {
                return $query->where('funds.type', '=', $fundType);
            })
            ->get();

        return [
            'investments' => $investments
        ];
    }

    public function getInvestmentData(Request $request, Client $client, Investment $investments)
    {
        $fundType = $request->fundType;

        $investment = $investments->with(['fund', 'cash_flows' => function ($query) {
            $query->orderBy('date', 'asc');
        }])
            ->where('client_id', '=', $client->id)
            ->whereHas('fund', function ($query) use ($fundType) {
                return $query->where('funds.type', '=', $fundType);
            })
            ->where('investments.id', '=', $request->investment_id)
            ->first();

        return [
            'investment' => $investment
        ];
    }

    public function addCashFlow(Request $request, CashFlow $cashFlow)
    {
        $this->validate($request, [
           'formData.date' => 'required|date',
           'formData.investment_id' => 'required|integer',
           'formData.returnValue' => 'required|numeric',
        ]);

        $cashFlow->investment_id = $request->formData['investment_id'];
        $cashFlow->date = Carbon::createFromFormat('Y-m-d H:i:s', $request->formData['date'] . ' 00:00:00');
        $cashFlow->return = $request->formData['returnValue'];
        $cashFlow->save();
    }
}
