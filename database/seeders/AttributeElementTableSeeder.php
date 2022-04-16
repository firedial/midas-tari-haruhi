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
        KindElement::create([
            'name' => 'move',
            'description' => '移動',
            'category_id' => 1,
        ]);
        KindElement::create([
            'name' => 'breakfast',
            'description' => '朝食',
            'category_id' => 2,
        ]);
        KindElement::create([
            'name' => 'lunch',
            'description' => '昼食',
            'category_id' => 2,
        ]);
        KindElement::create([
            'name' => 'dinner',
            'description' => '夕食',
            'category_id' => 2,
        ]);
        KindElement::create([
            'name' => 'elect',
            'description' => '電気代',
            'category_id' => 3,
        ]);
        KindElement::create([
            'name' => 'water',
            'description' => '水道代',
            'category_id' => 3,
        ]);
        KindElement::create([
            'name' => 'gas',
            'description' => 'ガス代',
            'category_id' => 3,
        ]);
        KindElement::create([
            'name' => 'transportation',
            'description' => '交通費',
            'category_id' => 4,
        ]);

        PurposeElement::create([
            'name' => 'move',
            'description' => '移動',
            'category_id' => 1,
        ]);
        PurposeElement::create([
            'name' => 'food',
            'description' => '食費',
            'category_id' => 2,
        ]);
        PurposeElement::create([
            'name' => 'utility',
            'description' => '光熱費',
            'category_id' => 3,
        ]);
        PurposeElement::create([
            'name' => 'travel_20210511',
            'description' => '2021年北海道旅行',
            'category_id' => 4,
        ]);
        PurposeElement::create([
            'name' => 'travel_20220211',
            'description' => '2022年九州旅行',
            'category_id' => 4,
        ]);

        PlaceElement::create([
            'name' => 'move',
            'description' => '移動',
            'category_id' => 1,
        ]);
        PlaceElement::create([
            'name' => 'wallet',
            'description' => '財布',
            'category_id' => 2,
        ]);
        PlaceElement::create([
            'name' => 'suica',
            'description' => 'Suica',
            'category_id' => 2,
        ]);
        PlaceElement::create([
            'name' => 'bank',
            'description' => '銀行',
            'category_id' => 3,
        ]);

    }
}
