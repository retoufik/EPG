<?php

namespace Database\Seeders;

use App\Models\TypeStage;
use Illuminate\Database\Seeder;

class TypeStageSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Stage d\'observation',
            'Stage d\'initiation',
            'Stage de perfectionnement',
            'Stage de fin d\'études',
            'Stage professionnel',
            'Stage de recherche',
            'Stage d\'été',
            'Stage de formation',
            'Stage d\'intégration',
            'Stage de découverte'
        ];

        foreach ($types as $type) {
            TypeStage::create([
                'type' => $type
            ]);
        }
    }
} 