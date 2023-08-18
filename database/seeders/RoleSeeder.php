<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Administrador',
            'description' => 'Administra a empresa'
        ]);

        Role::create([
            'name' => 'Pregoeiro',
            'description' => 'Pregoeiro'
        ]);

        Role::create([
            'name' => 'Agente de Contratação',
            'description' => 'Agente de contratação'
        ]);

        Role::create([
            'name' => 'Homologador',
            'description' => 'Responsável por homologar os processos'
        ]);

        Role::create([
            'name' => 'Equipe de Apoio',
            'description' => 'Equipe de apoio'
        ]);
    }
}
