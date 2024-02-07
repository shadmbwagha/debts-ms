<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;


class CreditController extends Controller
{
    public function index()
    {
        $credits = Credit::with('customer')->get();

        $creditsWithCustomerInfo = $credits->groupBy('customer_id')->map(function ($creditsForCustomer) {
            $totalAmount = $creditsForCustomer->sum('amount');

            return [
                'customer_id' => $creditsForCustomer->first()->customer->id,
                'customer_name' => $creditsForCustomer->first()->customer->name,
                'total_amount' => $totalAmount,
                'debts' => $creditsForCustomer->map(function ($credit) {
                    return [
                        'credit_id' => $credit->id,
                        'amount' => $credit->amount,
                        // Add other debt attributes as needed
                    ];
                }),
            ];
        });

        return response()->json($creditsWithCustomerInfo);
    }
    

    public function show(Credit $credit)
    {
        return $credit;
    }
    public function store()
    {
        $data = request()->all();
        $credit = Credit::create($data);
        return $credit;
    }

    public function update(Request $request, Credit $credit)
    {
        $data = request()->all();
        $credit->update($date);
        return $credit;
    }

    public function destroy(Credit $credit)
    {
        $credit->delete();
        return response()->noContent();
    }
}
