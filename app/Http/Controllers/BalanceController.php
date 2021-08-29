<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;

class BalanceController extends Controller
{
    public function index()
    {
        return Balance::all();
    }

    public function show(Balance $balance)
    {
        return $balance;
    }

    public function store(Request $request)
    {
        return Balance::create($request->all());
    }

    public function update(Request $request, Balance $balance)
    {
        $balance->update($request->all());
        return $balance;
    }

    public function destroy(Balance $balance)
    {
        $balance->delete();

        return $balance;
    }
}
