<?php

namespace Database\Seeders;

use App\Models\Balance;
use Illuminate\Database\Seeder;

class BalanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 12; $i++) {
            $elect = array(5453, 4925, 4742, 3424, 2813, 2455, 2342, 2355, 3214, 4221, 3923, 4922);

            Balance::create([
                'amount' => -1 * $elect[$i],
                'item' => '電気代',
                'kind_element_id' => 5,
                'purpose_element_id' => 3, 
                'place_element_id' => 4,
                'date' => '2021-' . ($i + 1) . '-25',
            ]);
        }

        for ($i = 0; $i < 12; $i++) {
            $water = array(1363, 1522, 1432, 1511, 1624, 1222, 1734, 1624, 1522, 1412, 1241, 1624);

            Balance::create([
                'amount' => -1 * $water[$i],
                'item' => '水道代',
                'kind_element_id' => 6,
                'purpose_element_id' => 3, 
                'place_element_id' => 4,
                'date' => '2021-' . ($i + 1) . '-14',
            ]);
        }

        for ($i = 0; $i < 12; $i++) {
            $gas = array(3221, 3221, 3003, 2843, 2736, 2645, 2743, 2965, 3131, 3231, 3543, 3433);

            Balance::create([
                'amount' => -1 * $gas[$i],
                'item' => 'ガス代',
                'kind_element_id' => 7,
                'purpose_element_id' => 3, 
                'place_element_id' => 4,
                'date' => '2021-' . ($i + 1) . '-3',
            ]);
        }

        Balance::create([
            'amount' => -12411,
            'item' => '新幹線',
            'kind_element_id' => 8,
            'purpose_element_id' => 4, 
            'place_element_id' => 2,
            'date' => '2021-02-11',
        ]);
        Balance::create([
            'amount' => -3421,
            'item' => '豪華な夕食',
            'kind_element_id' => 8,
            'purpose_element_id' => 4, 
            'place_element_id' => 2,
            'date' => '2021-02-11',
        ]);

    }
}
