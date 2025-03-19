<?php

namespace Database\Seeders;

use App\Models\typeDocument;
use App\Models\User;
use Illuminate\Database\Seeder;

class TypeDocumentSeeder extends Seeder
{
    public function run(): void
    {
        typeDocument::factory(10)->create();
    }
}
