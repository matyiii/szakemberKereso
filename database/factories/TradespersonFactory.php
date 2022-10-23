<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tradesperson>
 */
class TradespersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstname,
            'lastname' => $this->faker->lastname,
            'introduction' => $this->faker->realText(20),
            'highlighted' => $this->faker->numberBetween(0,1),
            'created_at' => $this->faker->time('H:i:s'),
            'updated_at' => $this->faker->time('H:i:s'),
        ];
    }
}
