<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;
    protected $table = "wishLists";
    protected $fillable = [
        'id',
        'user_id',
        'prod_id',
        'created_at'
            
    ];
    public function products()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
