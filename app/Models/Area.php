<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;
    protected $table = "areas";

    protected $fillable = [
        'id', 
        'name', 
    ];
    
    const UPDATE_AT = null;
    public $timestamps = false;
}
