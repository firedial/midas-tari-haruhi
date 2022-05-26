<?php

namespace Database\Factories;

use App\Models\PlaceElement;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceElementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlaceElement::class;

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
            'category_id' => 2,
        ];
    }
}
