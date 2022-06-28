<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddtoCart extends Model
{
    use HasFactory;
    protected $table = "addtoCarts";
    protected $fillable = [
        'id',
        'user_id',
        'prod_id',
        'count',
        'created_at'
            
    ];
    public function products()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }

}
