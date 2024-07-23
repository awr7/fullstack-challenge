<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'country' => $this->faker->randomElement(['US', 'MX', 'CA']),
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'created_at' => $this->faker->dateTimeThisYear(),
            'updated_at' => now(),
        ];
    }
}