<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovePurpose;

class MovePurposeController extends Controller
{
    public function index()
    {
        return MovePurpose::all();
    }

    public function show(MovePurpose $movePurpose)
    {
        return $movePurpose;
    }

    public function store(Request $request)
    {
        return MovePurpose::create($request->all());
    }

    public function update(Request $request, MovePurpose $movePurpose)
    {
        $movePurpose->update($request->all());
        return $movePurpose;
    }

    public function destroy(MovePurpose $movePurpose)
    {
        $movePurpose->delete();

        return $movePurpose;
    }
}
