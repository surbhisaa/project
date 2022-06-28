<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $table = "templates";
    protected $fillable = [
        'id',
        'type',
        'heading',
        'content',
        'image_name',
        'image_discription'
            
    ];

}
