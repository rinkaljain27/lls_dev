<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'product';
    protected $fillable = [
        'id', 'product_name','product_type_id','is_active'
    ];
    public $timestamps = true;
    public function productType() {

        return $this->belongsTo(ProductType::class, 'product_type_id', 'id');
    }

}
