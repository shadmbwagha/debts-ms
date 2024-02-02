<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;

class DebtController extends Controller
{
    public function index()
    {
        $debts = Debt::with('customer')->get();

        $debtsWithCustomerInfo = $debts->groupBy('customer_id')->map(function ($debtsForCustomer) {
            $totalAmount = $debtsForCustomer->sum('amount');

            return [
                'customer_id' => $debtsForCustomer->first()->customer->id,
                'customer_name' => $debtsForCustomer->first()->customer->name,
                'total_amount' => $totalAmount,
                'debts' => $debtsForCustomer->map(function ($debt) {
                    return [
                        'debt_id' => $debt->id,
                        'amount' => $debt->amount,
                        // Add other debt attributes as needed
                    ];
                }),
            ];
        });

        return response()->json($debtsWithCustomerInfo);
    }

    public function show(Debt $debt)
    {
        return $debt;
    }

    public function store()
    {
        $data = request()->all();
        $debt = Debt::create($data);
        return $debt;
    }

    public function update(Request $request, Debt $debt)
    {
        $data = request()->all();
        $debt->update($date);
        return $debt;
    }

    public function destroy(Debt $debt)
    {
        $debt->delete();
        return response()->noContent();
    }
    public function Customer($customerId)
    {
        $customer = Debt::findOrFail($customerId);
        $debts = $customer->debt;

        return response()->json(['debts' => $debts], 200);
    }
}
