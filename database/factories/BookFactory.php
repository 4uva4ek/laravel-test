<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male','female']);
        return [
            'title'=>fake()->jobTitle(),
            'publisher'=>fake()->name(),
            'author'=>(fake()->firstName($gender).' '.fake()->lastName($gender)),
            'genre'=>fake()->randomElement(['Action','Classic','Comic','Detective']),
            'publication'=>fake()->date(),
            'words'=>fake()->randomNumber(3),
            'price'=>fake()->randomFloat(1,20,200)
        ];
    }
}
