<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'uuid' => Str::uuid(),
            'document' => '31226405000176',
            'name' => 'CRP Tecnologia',
            'fantasy' => 'Venda Mais',
            'url' => 'crp-tecnologia',
            'email' => 'crp@tecnologia.com.br',
            'phone' => '7532467788',
            'mobile' => '75988774455',
            'logo' => 'default.png',
        ]);

        DB::table('tenants_addresses')->insert([
            'tenant_id' => 1,
            'zipcode' => '77001-032',
            'street' => 'QUADRA 103 NORTE RUA NO 7,',
            'city' => 'Palmas',
            'uf' => 'TO',
            'neighborhood' => 'PLANO DIRETOR NORTE -',
            'number' => '103',
            'complement' => 'SALA 504 E 506',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
