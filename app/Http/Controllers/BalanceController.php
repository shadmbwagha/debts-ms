<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;
use App\Models\Credit;
Use App\Models\Customer;

class BalanceController extends Controller
{
    public function index()
    {
        $debts = Debt::all();
        $credits = Credit::all();

        $balances = collect();

        foreach ($debts as $debt) {
            $customer_id = $debt->customer_id;

            $balance = $balances->where('customer_id', $customer_id)->first();

            if (!$balance) {
                $balance = [
                    'customer_id' => $customer_id,
                    'customer_name' => $debt->customer->name,
                    'total_debt' => 0,
                    'total_credit' => 0,
                ];
                $balances->push($balance);
            }

            $balance['total_debt'] += $debt->total_amount;
        }

        foreach ($credits as $credit) {
            $customer_id = $credit->customer_id;

            $balance = $balances->where('customer_id', $customer_id)->first();

            if (!$balance) {
                $balance = [
                    'customer_id' => $customer_id,
                    'customer_name' => $credit->customer->name,
                    'total_debt' => 0,
                    'total_credit' => 0,
                ];
                $balances->push($balance);
            }

            $balance['total_credit'] += $credit->total_amount;
        }

        $balances = $balances->map(function ($balance) {
            $balance['balance'] = $balance['total_credit'] - $balance['total_debt'];
            return $balance;
        });

        return response()->json($balances);
    
    }
}
