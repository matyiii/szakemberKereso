<?php

namespace Database\Factories;

use App\Models\Tradesperson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PictureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'file' => $this->faker->image(null,200,200,null,false),
            'isItProfilePicture' => $this->faker->numberBetween(0,1),
            'tradesperson_id' => $this->faker->unique()->numberBetween(1,Tradesperson::count())
        ];
    }
}
