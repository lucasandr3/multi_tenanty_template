<?php

namespace Database\Seeders;

use App\Models\PlanDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlanDetails::create([
            'plan_id' => 1,
            'description' => 'Acesso ilimitado'
        ]);

        PlanDetails::create([
            'plan_id' => 1,
            'description' => 'Sem limite de usuários'
        ]);

        PlanDetails::create([
            'plan_id' => 1,
            'description' => 'Atualizações futuras gratuitas'
        ]);

        PlanDetails::create([
            'plan_id' => 2,
            'description' => 'Acesso ilimitado'
        ]);

        PlanDetails::create([
            'plan_id' => 2,
            'description' => 'Sem limite de usuários'
        ]);

        PlanDetails::create([
            'plan_id' => 2,
            'description' => 'Atualizações futuras gratuitas'
        ]);


        PlanDetails::create([
            'plan_id' => 3,
            'description' => 'Acesso ilimitado'
        ]);

        PlanDetails::create([
            'plan_id' => 3,
            'description' => 'Sem limite de usuários'
        ]);

        PlanDetails::create([
            'plan_id' => 3,
            'description' => 'Atualizações futuras gratuitas'
        ]);
    }
}
