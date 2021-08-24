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
        for ($i = 1; $i <= 10; $i++) {
            Balance::create([
                'amount' => $i * $i,
                'item' => 'item' . $i,
                'kind_element_id' => $i,
                'purpose_element_id' => $i,
                'place_element_id' => $i,
                'date' => '2021/8/24',
            ]);
        }
    }
}
