<?php

namespace App\Service;

use App\Models\KindElement;
use App\Models\Dao\AnalyzeDao;

/**
 * balance テーブルの解析用の Dao
 */
class AnalyzeService
{
    public static function getBalanceJsonData(array $params)
    {
        $data = AnalyzeDao::getBalanceData($params);
        return $data;
    }

}
