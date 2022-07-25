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
            ['id'=>1, 'name' => 'Admin'],
            ['id'=>2, 'name' => 'Service Enginner'],
            ['id'=>3, 'name' => 'Client'],
        ];
        foreach ($role as $roles) {
            Role::create([
             'id' => $roles['id'],
             'name' => $roles['name'],
           ]);
        }
    }
}
