<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'ver_dashboard',
            'description' => 'Ver Dashboard'
        ]);

        Permission::create([
            'name' => 'ver_pedidos',
            'description' => 'Ver Pedidos'
        ]);

        Permission::create([
            'name' => 'ver_categorias',
            'description' => 'Ver Categorias'
        ]);

        Permission::create([
            'name' => 'ver_produtos',
            'description' => 'Ver Produtos'
        ]);

        Permission::create([
            'name' => 'ver_mesas',
            'description' => 'Ver Mesas'
        ]);

        Permission::create([
            'name' => 'ver_planos',
            'description' => 'Ver Planos'
        ]);

        Permission::create([
            'name' => 'ver_perfis',
            'description' => 'Ver Perfis'
        ]);

        Permission::create([
            'name' => 'ver_cargos',
            'description' => 'Ver Cargos'
        ]);

        Permission::create([
            'name' => 'ver_permissoes',
            'description' => 'Ver Permissões'
        ]);

        Permission::create([
            'name' => 'ver_usuarios',
            'description' => 'Ver Usuários'
        ]);

        Permission::create([
            'name' => 'ver_empresas',
            'description' => 'Ver Empresas'
        ]);

        Permission::create([
            'name' => 'ver_clientes',
            'description' => 'Ver Clientes'
        ]);

        Permission::create([
            'name' => 'ver_avaliacoes',
            'description' => 'Ver Avaliações'
        ]);
    }
}
