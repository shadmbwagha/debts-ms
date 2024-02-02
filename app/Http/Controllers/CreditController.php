<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;


class CreditController extends Controller
{
    public function index()
    {
        return Credit::all();
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
