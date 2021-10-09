<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MovePlace;
use App\Models\KindElement;
use App\Models\PurposeElement;

class MovePlaceController extends Controller
{
    public function index()
    {
        return DB::table('m_balance as before')
            ->select(
                'before.id AS id',
                'before.amount AS amount',
                'before.item AS item',
                'before.place_element_id AS before_id',
                'after.place_element_id AS after_id',
                'before.date AS date',
                'before_place.description AS before_description',
                'after_place.description AS after_description'
            )
            ->join('m_balance as after', 'after.id', '=', DB::raw('before.id + 1'))
            ->join('m_place_element as before_place', 'before_place.id', '=', 'before.place_element_id')
            ->join('m_place_element as after_place', 'after_place.id', '=', 'after.place_element_id')
            ->where('before.kind_element_id', KindElement::MOVE_ID)
            ->get();
    }

    public function show(Int $id)
    {
        $list = DB::table('m_balance as before')
            ->select(
                'before.id AS id',
                'before.amount AS amount',
                'before.item AS item',
                'before.place_element_id AS before_id',
                'after.place_element_id AS after_id',
                'before.date AS date',
                'before_place.description AS before_description',
                'after_place.description AS after_description'
            )
            ->join('m_balance as after', 'after.id', '=', DB::raw('before.id + 1'))
            ->join('m_place_element as before_place', 'before_place.id', '=', 'before.place_element_id')
            ->join('m_place_element as after_place', 'after_place.id', '=', 'after.place_element_id')
            // ->where('before.kind_element_id', KindElement::MOVE_ID)
            ->where('before.id', $id)
            ->get();
        return $list[0];
    }

    public function store(Request $request)
    {
        $before = array(
            'item' => $request['item'],
            'amount' => $request['amount'],
            'kind_element_id' => KindElement::MOVE_ID,
            'purpose_element_id' => PurposeElement::MOVE_ID,
            'place_element_id' => $request['before_id'],
            'date' => $request['date']
        );

        $after = array(
            'item' => $request['item'],
            'amount' => (-1) * $request['amount'],
            'kind_element_id' => KindElement::MOVE_ID,
            'purpose_element_id' => PurposeElement::MOVE_ID,
            'place_element_id' => $request['after_id'],
            'date' => $request['date']
        );

        return DB::table('m_balance')->insert([$before, $after]);
    }

    public function update(Request $request, Int $id)
    {
        $before = array(
            'item' => $request['item'],
            'amount' => $request['amount'],
            'kind_element_id' => KindElement::MOVE_ID,
            'purpose_element_id' => PurposeElement::MOVE_ID,
            'place_element_id' => $request['before_id'],
            'date' => $request['date']
        );

        $after = array(
            'item' => $request['item'],
            'amount' => (-1) * $request['amount'],
            'kind_element_id' => KindElement::MOVE_ID,
            'purpose_element_id' => PurposeElement::MOVE_ID,
            'place_element_id' => $request['after_id'],
            'date' => $request['date']
        );

        // 本当に移動処理かどうかのチェックをしたほうがいい
        return DB::transaction(function () use ($id, $before, $after) {
            DB::table('m_balance')->where('id', '=', $id)->update($before);
            DB::table('m_balance')->where('id', '=', $id + 1)->update($after);
        });
    }

    public function destroy(Int $id)
    {
        return DB::table('m_balance')
        ->where('id', '=', $id)
        ->orWhere('id', '=', $id + 1)
        ->delete();
    }
}
