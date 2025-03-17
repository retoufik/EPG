<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use GuzzleHttp\Promise\Each;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        $stagiaires = \App\Models\Stagiaire::factory(10)->create();
        $stagiaires->each(function ($stagiaire) {
            \App\Models\Document::factory(5)->create([
                'stagiaire_id' => $stagiaire->id,
            ]);
        });
    }
}
