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
    public function definition()
    {
        return [
            'name' => $this->faker->streetName,
            'isbn' => $this->faker->isbn10(),
            'authors' => [$this->faker->firstName . ' ' . $this->faker->lastName],
            'publisher' => $this->faker->company,
            'release_date' => $this->faker->date('Y-m-d'),
            'number_of_pages' => $this->faker->numberBetween(200, 1000),
            'country' => $this->faker->country,
        ];
    }
}
