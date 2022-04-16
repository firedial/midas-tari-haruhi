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
        KindCategory::create([
            'name' => 'Move',
            'description' => '移動',
        ]);
        KindCategory::create([
            'name' => 'Food',
            'description' => '食費',
        ]);
        KindCategory::create([
            'name' => 'Utility',
            'description' => '光熱費',
        ]);
        KindCategory::create([
            'name' => 'Transportation',
            'description' => '交通費',
        ]);

        PurposeCategory::create([
            'name' => 'Move',
            'description' => '移動',
        ]);
        PurposeCategory::create([
            'name' => 'Food',
            'description' => '食費',
        ]);
        PurposeCategory::create([
            'name' => 'Utility',
            'description' => '光熱費',
        ]);
        PurposeCategory::create([
            'name' => 'Travel',
            'description' => '旅行',
        ]);

        PlaceCategory::create([
            'name' => 'Move',
            'description' => '移動',
        ]);
        PlaceCategory::create([
            'name' => 'Main',
            'description' => 'メイン',
        ]);
        PlaceCategory::create([
            'name' => 'Bank',
            'description' => '銀行',
        ]);

    }
}
