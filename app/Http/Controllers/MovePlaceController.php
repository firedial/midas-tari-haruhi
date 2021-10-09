<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MovePlace;
use App\Models\KindElement;
use App\Models\PurposeElement;
use App\Models\Dao\MoveDao;

class MovePlaceController extends Controller
{
    public function index()
    {
        return MoveDao::getAllMoves('place');
    }

    public function show(Int $id)
    {
        return MoveDao::getMoveById('place', $id);
    }

    public function store(Request $request)
    {
        return MoveDao::insertMove('place', $request);
    }

    public function update(Request $request, Int $id)
    {
        return MoveDao::updateMove('place', $request, $id);
    }

    public function destroy(Int $id)
    {
        return MoveDao::deleteMove($id);
    }
}
