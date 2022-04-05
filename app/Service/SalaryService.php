<?php

namespace App\Service;

use App\Models\Balance;
use App\Util\Date;
use App\Exceptions\InvalidParameterException;
use App\Models\Dao\MoveDao;
use App\Models\Dao\BalanceDao;

/**
 * 給与操作のサービスクラス
 */
class SalaryService
{
    const SALARY_KIND_ELEMENT_ID = 14;
    const TRANSPORTATION_KIND_ELEMENT_ID = 17;
    const HOLDING_KIND_ELEMENT_ID = 18;
    const INCOME_PURPOSE_ELEMENT_ID = 3;
    const SKY_PURPOSE_ELEMENT_ID = 4;

    public static function registerSalary(array $salary): Bool
    {
        $baseSalary = [
            'amount' => (int)$salary['baseSalary'],
            'item' => '基本給',
            'kind_element_id' => self::SALARY_KIND_ELEMENT_ID,
            'purpose_element_id' => self::INCOME_PURPOSE_ELEMENT_ID,
            'place_element_id' => self::SKY_PURPOSE_ELEMENT_ID,
            'date' => (string)$salary['date']
        ];
        BalanceDao::insertBalance($baseSalary);

        $adjustmentSalary = [
            'amount' => (int)$salary['adjustmentSalary'],
            'item' => '職務調整給',
            'kind_element_id' => self::SALARY_KIND_ELEMENT_ID,
            'purpose_element_id' => self::INCOME_PURPOSE_ELEMENT_ID,
            'place_element_id' => self::SKY_PURPOSE_ELEMENT_ID,
            'date' => (string)$salary['date']
        ];
        BalanceDao::insertBalance($adjustmentSalary);

        $transportation = [
            'amount' => (int)$salary['transportation'],
            'item' => '非課税通勤費',
            'kind_element_id' => self::TRANSPORTATION_KIND_ELEMENT_ID,
            'purpose_element_id' => self::INCOME_PURPOSE_ELEMENT_ID,
            'place_element_id' => self::SKY_PURPOSE_ELEMENT_ID,
            'date' => (string)$salary['date']
        ];
        BalanceDao::insertBalance($transportation);

        $holdingIncentives = [
            'amount' => (int)$salary['holdingIncentives'],
            'item' => '持株奨励金',
            'kind_element_id' => self::HOLDING_KIND_ELEMENT_ID,
            'purpose_element_id' => self::INCOME_PURPOSE_ELEMENT_ID,
            'place_element_id' => self::SKY_PURPOSE_ELEMENT_ID,
            'date' => (string)$salary['date']
        ];
        BalanceDao::insertBalance($holdingIncentives);

        return true;
    }

}
