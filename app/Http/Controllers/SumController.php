<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dao\AnalyzeDao;

class SumController extends Controller
{
    public function index(Request $request)
    {
        return AnalyzeDao::getBalanceData($request);
    }
}
