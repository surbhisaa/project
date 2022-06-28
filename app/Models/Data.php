<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $table = "datas";
     public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'message',
        'reply'
            
    ];
}
