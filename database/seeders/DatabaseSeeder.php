<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlanSeeder::class,
            PlanDetailsSeeder::class,
            TenantSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            ProfileSeeder::class,
            RoleSeeder::class,
            PermissionProfileSeeder::class,
            PermissionRoleSeeder::class,
            PlanProfileSeeder::class,
            RoleUserSeeder::class,
        ]);
    }
}
