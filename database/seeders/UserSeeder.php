<?php

namespace Database\Seeders;

use App\Models\Tenant\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'Lucas Vieira',
            'email' => 'lucas@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $tenant->users()->create([
            'name' => 'Paulo Lourenço',
            'email' => 'paulo@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
