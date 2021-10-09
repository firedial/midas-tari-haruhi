<?php

namespace App\Models\Dao;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\KindElement;

/**
 * balance テーブルの解析用の Dao
 */
class AnalyzeDao
{
    public static function getBalanceData(Request $request)
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

        $query = DB::table('m_balance');

        $groupByPlace = false;
        if ($request->input('group_by_place') === 'true') {
            $groupByPlace = true;
        }

        $groupByPurpose = false;
        if ($request->input('group_by_purpose') === 'true') {
            $groupByPurpose = true;
        }

        $groupByDate = $request->input('group_by_date');
        $groupByDateValue = array(null, 'day', 'week', 'month', 'year', 'fiscal_year');
        if (!in_array($groupByDate, $groupByDateValue, true)) {
            // 例外処理を投げる
            return array();
        }

        if ($groupByDate || $groupByPurpose || $groupByPlace) { 
            $query->select(
                DB::raw('SUM(m_balance.amount) as sum')
            );
        } else {
            $query->select(
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
            );
        }

        if ($groupByPurpose) {
            $query->addSelect(
                'm_balance.purpose_element_id',
                'm_purpose_element.description AS purpose_description'
            );
            $query->groupBy('m_balance.purpose_element_id');
        }
        if ($groupByPlace) {
            $query->addSelect(
                'm_balance.place_element_id',
                'm_place_element.description AS place_description'
            );
            $query->groupBy('m_balance.place_element_id');
        }
        if ($groupByDate) {
            // グループ化の条件を後で書く
            $query->addSelect('m_balance.date');
            $query->groupBy('m_balance.date');
        }

        $query
            ->join('m_kind_element', 'm_kind_element.id', '=', 'm_balance.kind_element_id')
            ->join('m_purpose_element', 'm_purpose_element.id', '=', 'm_balance.purpose_element_id')
            ->join('m_place_element', 'm_place_element.id', '=', 'm_balance.place_element_id');

        if ($isMoveIngnore) {
            $query->where('kind_element_id', '<>', KindElement::MOVE_ID);
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

        return $query->get();
    }

}
