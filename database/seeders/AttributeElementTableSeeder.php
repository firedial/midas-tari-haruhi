<?php

namespace Database\Seeders;

use App\Models\KindElement;
use App\Models\PurposeElement;
use App\Models\PlaceElement;
use Illuminate\Database\Seeder;

class AttributeElementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            KindElement::create([
                'name' => 'kind_e_name' . $i,
                'description' => 'kind_e_description' . $i,
                'category_id' => $i,
            ]);
            PurposeElement::create([
                'name' => 'purpose_e_name' . $i,
                'description' => 'purpose_e_description' . $i,
                'category_id' => $i,
            ]);
            PlaceElement::create([
                'name' => 'place_e_name' . $i,
                'description' => 'place_e_description' . $i,
                'category_id' => $i,
            ]);
        }
    }
}
