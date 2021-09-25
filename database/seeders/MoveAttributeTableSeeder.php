<?php

namespace Database\Seeders;

use App\Models\MovePurpose;
use App\Models\MovePlace;
use Illuminate\Database\Seeder;

class MoveAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 9; $i++) {
            MovePurpose::create([
                'amount' => $i * $i,
                'item' => 'item' . $i,
                'before_id' => $i,
                'after_id' => $i + 1,
                'date' => '2021-08-' . (10 + $i),
            ]);
            MovePlace::create([
                'amount' => $i * $i,
                'item' => 'item' . $i,
                'before_id' => $i,
                'after_id' => $i + 1,
                'date' => '2021-08-' . (10 + $i),
            ]);
        }
    }
}
