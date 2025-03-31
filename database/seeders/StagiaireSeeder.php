<?php

namespace Database\Seeders;

use App\Models\Stagiaire;
use Illuminate\Database\Seeder;

class StagiaireSeeder extends Seeder
{
    public function run(): void
    {
        Stagiaire::factory(50)->create();
    }
} 