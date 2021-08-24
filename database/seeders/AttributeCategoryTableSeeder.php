<?php

namespace Database\Seeders;

use App\Models\KindCategory;
use App\Models\PurposeCategory;
use App\Models\PlaceCategory;
use Illuminate\Database\Seeder;

class AttributeCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            KindCategory::create([
                'name' => 'kind_c_name' . $i,
                'description' => 'kind_c_description' . $i,
            ]);
            PurposeCategory::create([
                'name' => 'purpose_c_name' . $i,
                'description' => 'purpose_c_description' . $i,
            ]);
            PlaceCategory::create([
                'name' => 'place_c_name' . $i,
                'description' => 'place_c_description' . $i,
            ]);
        }
    }
}
