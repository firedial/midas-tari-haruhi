<?php

namespace Database\Factories;

use App\Models\KindCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class KindCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KindCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 2,
            'name' => 'test',
            'description' => 'test_test',
        ];
    }
}
