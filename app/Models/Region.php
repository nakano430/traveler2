<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class region extends Model
{
    use HasFactory;
    protected $table = "regions";

    protected $fillable = [
        'id ', 
        'name', 
    ];
    
    const UPDATE_AT = null;
    public $timestamps = false;
}
