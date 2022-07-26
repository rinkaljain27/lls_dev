<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdminUserSeeder::class);
        // $this->call(AdminRoleSeeder::class);
        $this->call(AdminPermissionSeeder::class);
    }
}
