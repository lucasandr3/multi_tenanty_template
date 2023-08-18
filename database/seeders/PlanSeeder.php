<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Plano Básico',
            'url' => 'basic',
            'price' => 150,
            'description' => 'Plano para você que quer conhecer nosso serviço',
            'recomended' => false,
        ]);

        Plan::create([
            'name' => 'Plano Standard',
            'url' => 'standard',
            'price' => 220,
            'description' => 'Plano para você que quer conhecer nosso serviço',
            'recomended' => true,
        ]);

        Plan::create([
            'name' => 'Plano Premiun',
            'url' => 'premiun',
            'price' => 300,
            'description' => 'Plano para você que quer conhecer nosso serviço',
            'recomended' => false,
        ]);
    }
}
