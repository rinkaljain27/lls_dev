<?php

namespace App\Permissions;

use App\Models\Role; 
use App\Models\Permission;

trait HasPermissionsTrait {

  
    public function hasRole(... $roles) {
        foreach ($roles as $role) {
            if ($this->permissions->contains('permission_slug', $role)) {
                return true;
            }
        }
        return false;
    }  
    public function permissions() {

        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

}
