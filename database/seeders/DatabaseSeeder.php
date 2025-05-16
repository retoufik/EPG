<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TypeStageSeeder::class,
            StagiaireSeeder::class,
            TypeDocumentSeeder::class,
            UserSeeder::class,
        ]);
    }
}
