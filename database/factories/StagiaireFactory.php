<?php

namespace Database\Factories;

use App\Models\TypeStage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stagiaire>
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
        $debut = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $fin = $this->faker->dateTimeBetween($debut, $debut->format('Y-m-d') . ' +6 months');

        return [
            'prenom' => $this->faker->firstName(),
            'nom' => $this->faker->lastName(),
            'CIN' => $this->faker->unique()->numerify('CIN####'),
            'genre' => $this->faker->randomElement(['homme', 'femme']),
            'email' => $this->faker->unique()->safeEmail(),
            'tel' => $this->faker->numerify('06########'),
            'debut' => $debut,
            'fin' => $fin,
            'details' => $this->faker->paragraph(),
            'path' => null,
            'date_naissance' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'type_stage_id' => TypeStage::inRandomOrder()->first()->id ?? TypeStage::factory()->create()->id,
        ];
    }
}
