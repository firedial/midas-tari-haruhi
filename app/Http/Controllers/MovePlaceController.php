<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovePlace;

class MovePlaceController extends Controller
{
    public function index()
    {
        return MovePlace::all();
    }

    public function show(MovePlace $MovePlace)
    {
        return $MovePlace;
    }

    public function store(Request $request)
    {
        return MovePlace::create($request->all());
    }

    public function update(Request $request, MovePlace $MovePlace)
    {
        $MovePlace->update($request->all());
        return $MovePlace;
    }

    public function destroy(MovePlace $MovePlace)
    {
        $MovePlace->delete();

        return $MovePlace;
    }
}
