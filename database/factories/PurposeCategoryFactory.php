<?php

namespace Database\Factories;

use App\Models\PurposeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurposeCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurposeCategory::class;

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
