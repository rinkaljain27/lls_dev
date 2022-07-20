<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = [
            'name' => 'Admin',
            'name' => 'Service Enginner',
            'name' => 'Client'
        ];
        Role::create($role);
    }
}
