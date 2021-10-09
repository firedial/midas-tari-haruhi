<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dao\MoveDao;

class MovePurposeController extends Controller
{
    public function index()
    {
        return MoveDao::getAllMoves('purpose');
    }

    public function show(Int $id)
    {
        return MoveDao::getMoveById('purpose', $id);
    }

    public function store(Request $request)
    {
        return MoveDao::insertMove('purpose', $request);
    }

    public function update(Request $request, Int $id)
    {
        return MoveDao::updateMove('purpose', $request, $id);
    }

    public function destroy(Int $id)
    {
        return MoveDao::deleteMove($id);
    }

}
