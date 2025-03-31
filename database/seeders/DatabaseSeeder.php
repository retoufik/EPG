<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TypeStageSeeder::class,
            StagiaireSeeder::class,
            TypeDocumentSeeder::class,
        ]);
    }
}
