<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'full_name' => 'admin',
            'mobile' => '8777788888',
            'address' => '101,shivalik',
            'role_id'=> 1,
            
        ]);
    }
}
