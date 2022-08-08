<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiLogs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id', 'api_type','api_name','request_data','response_data'
    ];
    public $timestamps = true;
    // public function userName() {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}
