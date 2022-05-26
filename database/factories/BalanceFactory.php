<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Balance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(1, 10000),
            'item' => $this->faker->word(),
            'kind_element_id' => 2,
            'purpose_element_id' => 2,
            'place_element_id' => 2,
            'date' => $this->faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null),
        ];
    }
}
