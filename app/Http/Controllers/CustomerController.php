<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function store()
    {
        $data = request()->all();
        $customer = Customer::create($data);
        return $customer;
    }

    public function update(Request $request, Customer $customer)
    {
        $data = request()->all();
        $customer->update($date);
        return $customer;
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->noContent();
    }
    public function debt($debtId)
    {
        $customer = Customer::findOrFail($debtId);
        $debts = $customer->debt;

        return response()->json(['debts' => $debts], 200);
    }
}
