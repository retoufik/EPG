<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StagiaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'prenom' => $this->faker->firstName(),
           'nom' => $this->faker->lastName(),
           'CIN' => $this->faker->unique()->word(),
           'genre' => $this->faker->inRandomOrder(['homme','femme']),
           'email' => $this->faker->unique()->safeEmail(),
           'tel' => $this->faker->phoneNumber(),
           'debut' => $this->faker->date(),
           'fin' => $this->faker->date(),
           'details' => $this->faker->text(),
           'path' => $this->faker->word(),
        ];
    }
}
