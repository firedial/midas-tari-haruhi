<?php

namespace Database\Factories;

use App\Models\PlaceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlaceCategory::class;

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
