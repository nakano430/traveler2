<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 
        'roomtype'
    ];
    
    const UPDATE_AT = null;
    public $timestamps = false;
}
