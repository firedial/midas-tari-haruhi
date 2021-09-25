<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SumController extends Controller
{
    public function index(Request $request)
    {
        // 移動処理を無視するかどうか
        $isMoveIngnore = false;
        if ($request->input('move_ignore') === 'true') {
            $isMoveIngnore = true;
        }

        $filterKindElements = $request->input('kind') ?: array();
        $filterPurposeElements = $request->input('purpose') ?: array();
        $filterPlaceElements = $request->input('place') ?: array();

        $startDate = $request->input('start_date') ?: '';
        $endDate = $request->input('end_date') ?: '';

        $query =
            DB::table('m_balance')
            ->select(
                'm_balance.id AS id',
                'm_balance.amount AS amount',
                'm_balance.item AS item',
                'm_balance.kind_element_id AS kind_element_id',
                'm_balance.purpose_element_id AS purpose_element_id',
                'm_balance.place_element_id AS place_element_id',
                'm_balance.date AS date',
                'm_kind_element.description AS kind_description',
                'm_purpose_element.description AS purpose_description',
                'm_place_element.description AS place_description'
            )
            ->join('m_kind_element', 'm_kind_element.id', '=', 'm_balance.kind_element_id')
            ->join('m_purpose_element', 'm_purpose_element.id', '=', 'm_balance.purpose_element_id')
            ->join('m_place_element', 'm_place_element.id', '=', 'm_balance.place_element_id');

        if (!$isMoveIngnore) {
            $purposeMoveOutQuery =
                DB::table('m_move_purpose')
                ->select(
                    'm_move_purpose.id AS id',
                    DB::raw('m_move_purpose.amount * (-1) AS amount'),
                    '予算移送元 AS item',
                    '0 AS kind_element_id',
                    'm_move_purpose.before_id AS purpose_element_id',
                    '0 AS place_element_id',
                    'm_move_purpose.date AS date',
                    '- AS kind_description',
                    'm_purpose_element.description AS purpose_description',
                    '- AS place_description'
                )
                ->join('m_purpose_element', 'm_purpose_element.id', '=', 'm_move_purpose.before_id');
            $purposeMoveInQuery =
                DB::table('m_move_purpose')
                ->select(
                    'm_move_purpose.id AS id',
                    'm_move_purpose.amount AS amount',
                    '予算移送先 AS item',
                    '0 AS kind_element_id',
                    'm_move_purpose.after_id AS purpose_element_id',
                    '0 AS place_element_id',
                    'm_move_purpose.date AS date',
                    '- AS kind_description',
                    'm_purpose_element.description AS purpose_description',
                    '- AS place_description'
                )
                ->join('m_purpose_element', 'm_purpose_element.id', '=', 'm_move_purpose.after_id');
            $query->unionAll($purposeMoveOutQuery);
            $query->unionAll($purposeMoveInQuery);

            $placeMoveOutQuery =
                DB::table('m_move_place')
                ->select(
                    'm_move_place.id AS id',
                    DB::raw('m_move_place.amount * (-1) AS amount'),
                    '場所移送元 AS item',
                    '0 AS kind_element_id',
                    '0 AS purpose_element_id',
                    'm_move_place.before_id AS place_element_id',
                    'm_move_place.date AS date',
                    '- AS kind_description',
                    '- AS purpose_description',
                    'm_place_element.description AS place_description'
                )
                ->join('m_place_element', 'm_place_element.id', '=', 'm_move_place.before_id');
            $placeMoveInQuery =
                DB::table('m_move_place')
                ->select(
                    'm_move_place.id AS id',
                    'm_move_place.amount AS amount',
                    '場所移送先 AS item',
                    '0 AS kind_element_id',
                    '0 AS purpose_element_id',
                    'm_move_place.after_id AS place_element_id',
                    'm_move_place.date AS date',
                    '- AS kind_description',
                    '- AS purpose_description',
                    'm_place_element.description AS place_description'
                )
                ->join('m_place_element', 'm_place_element.id', '=', 'm_move_place.after_id');
            $query->unionAll($placeMoveOutQuery);
            $query->unionAll($placeMoveInQuery);

        }
        
        if ($filterKindElements !== array()) {
            $query->whereIn('kind_element_id', $filterKindElements);
        }
        if ($filterPurposeElements !== array()) {
            $query->whereIn('purpose_element_id', $filterPurposeElements);
        }
        if ($filterPlaceElements !== array()) {
            $query->whereIn('place_element_id', $filterPlaceElements);
        }

        if ($startDate !== '') {
            $query->whereDate('m_balance.date', '>=', $startDate);
        }
        if ($endDate !== '') {
            $query->whereDate('m_balance.date', '<=', $endDate);
        }

        // return $query->toSql();
        return $query->get();
    }

}
