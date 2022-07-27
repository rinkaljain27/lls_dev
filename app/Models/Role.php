<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $fillable = [
        'id', 'name','is_active'
    ];
    public $timestamps = true;
    public function commands() {
        return $this->belongsToMany(Command::class, 'role_command');
    }

    public function getCommandIds() {
        return $this->commands()->pluck('command_id')->toArray();
    }
    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function getPermissionIds() {
        return $this->permissions()->pluck('permission_id')->toArray();
    }
}
