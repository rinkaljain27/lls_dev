<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permission = [
            ['id'=>1, 'permission_name' => 'Roles - Create', 'permission_slug' => 'roles-create'],
            ['id'=>2, 'permission_name' => 'Roles - Edit', 'permission_slug' => 'roles-edit'],
            ['id'=>3, 'permission_name' => 'Roles - View', 'permission_slug' => 'roles-view'],
            ['id'=>4, 'permission_name' => 'Roles - Delete', 'permission_slug' => 'roles-delete'],
            ['id'=>5, 'permission_name' => 'Roles - Export', 'permission_slug' => 'roles-export'],

            ['id'=>6, 'permission_name' => 'Users - Create', 'permission_slug' => 'users-create'],
            ['id'=>7, 'permission_name' => 'Users - Edit', 'permission_slug' => 'users-edit'],
            ['id'=>8, 'permission_name' => 'Users - View', 'permission_slug' => 'users-view'],
            ['id'=>9, 'permission_name' => 'Users - Delete', 'permission_slug' => 'users-delete'],
            ['id'=>10, 'permission_name' => 'Users - Export', 'permission_slug' => 'users-export'],

            ['id'=>11, 'permission_name' => 'Permission - Create', 'permission_slug' => 'permissions-create'],
            ['id'=>12, 'permission_name' => 'Permission - Edit', 'permission_slug' => 'permissions-edit'],
            ['id'=>13, 'permission_name' => 'Permission - View', 'permission_slug' => 'permissions-view'],
            ['id'=>14, 'permission_name' => 'Permission - Delete', 'permission_slug' => 'permissions-delete'],
            ['id'=>15, 'permission_name' => 'Permission - Export', 'permission_slug' => 'permissions-export'],

            ['id'=>16, 'permission_name' => 'Product - Create', 'permission_slug' => 'product-create'],
            ['id'=>17, 'permission_name' => 'Product - Edit', 'permission_slug' => 'product-edit'],
            ['id'=>18, 'permission_name' => 'Product - View', 'permission_slug' => 'product-view'],
            ['id'=>19, 'permission_name' => 'Product - Delete', 'permission_slug' => 'product-delete'],
            ['id'=>20, 'permission_name' => 'Product - Export', 'permission_slug' => 'product-export'],

            ['id'=>21, 'permission_name' => 'Product Type - Create', 'permission_slug' => 'product_type-create'],
            ['id'=>22, 'permission_name' => 'Product Type - Edit', 'permission_slug' => 'product_type-edit'],
            ['id'=>23, 'permission_name' => 'Product Type - View', 'permission_slug' => 'product_type-view'],
            ['id'=>24, 'permission_name' => 'Product Type - Delete', 'permission_slug' => 'product_type-delete'],
            ['id'=>25, 'permission_name' => 'Product Type - Export', 'permission_slug' => 'product_type-export'],

            ['id'=>26, 'permission_name' => 'Commands - Create', 'permission_slug' => 'commands-create'],
            ['id'=>27, 'permission_name' => 'Commands - Edit', 'permission_slug' => 'commands-edit'],
            ['id'=>28, 'permission_name' => 'Commands - View', 'permission_slug' => 'commands-view'],
            ['id'=>29, 'permission_name' => 'Commands - Delete', 'permission_slug' => 'commands-delete'],
            ['id'=>30, 'permission_name' => 'Commands - Export', 'permission_slug' => 'commands-export'],
            
        ];
        foreach ($permission as $permissions) {
            Permission::create([
             'id' => $permissions['id'],
             'permission_name' => $permissions['permission_name'],
             'permission_slug' => $permissions['permission_slug'],
           ]);
        }
    }
}
