<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dao\AnalyzeDao;
use App\Service\AnalyzeService;

class AnalyzeController extends Controller
{
    public function table(Request $request)
    {
        return AnalyzeService::getBalanceJsonData(self::getQueries($request));
    }

    static private function getQueries(Request $request)
    {
        $params = array();

        // attribute elements のフィルター
        $params['filterKindElements'] = $request->input('kind') ?: array();
        $params['filterPurposeElements'] = $request->input('purpose') ?: array();
        $params['filterPlaceElements'] = $request->input('place') ?: array();

        // 移動処理を無視するかどうか
        $params['isMoveIgnore'] = $request->input('move_ignore') === 'true';

        // 日付のフィルター
        $params['startDate'] = $request->input('start_date') ?: '';
        $params['endDate'] = $request->input('end_date') ?: '';

        // 集約
        $params['label'] = $request->input('label');
        $params['dataset'] = $request->input('dataset');

        $groupByValue = array(null, 'all', 'kind', 'purpose', 'place', 'day');
        // @todo 日付の集約期間は後で実装する
        // $groupByValue = array(null, 'all', 'kind', 'purpose', 'place', 'day', 'week', 'month', 'year', 'fiscal_year');
        if (!in_array($params['label'], $groupByValue, true)) {
            // @todo 例外処理を投げる
            return array();
        }

        if (!in_array($params['dataset'], $groupByValue, true)) {
            // @todo 例外処理を投げる
            return array();
        }

        // 集約使うとき dataset が null なら all を入れておく
        if (!is_null($params['label']) && is_null($params['dataset'])) {
            $params['dataset'] = 'all';
        }

        return $params;
    }
}
