<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dao\MoveDao;

class MovePlaceController extends Controller
{
    public function index()
    {
        return MoveDao::getMoves('place');
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
