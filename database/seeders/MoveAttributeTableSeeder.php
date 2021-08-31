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
        for ($i = 1; $i <= 10; $i++) {
            MovePurpose::create([
                'amount' => $i * $i,
                'item' => 'item' . $i,
                'before_id' => $i,
                'after_id' => $i,
                'date' => '2021/8/24',
            ]);
            MovePlace::create([
                'amount' => $i * $i,
                'item' => 'item' . $i,
                'before_id' => $i,
                'after_id' => $i,
                'date' => '2021/8/24',
            ]);
        }
    }
}
