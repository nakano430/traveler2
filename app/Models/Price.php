<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class price extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 
        'hotel_id',
        'room_id',
        'price'
    ];

    public function editPrice($hotel_id){
        return DB::table('prices AS p')
            ->select('roomtype', 'price')
            ->join('rooms AS r', 'p.room_id', '=', 'r.id')
            ->join('hotels AS h', 'p.hotel_id', '=', 'h.id')
            ->where('hotel_id', $hotel_id)
            ->first();
    }

    public function getPrice($hotel_id){
        return DB::table('prices AS p')
            ->select('roomtype', 'price')
            ->join('rooms AS r', 'p.room_id', '=', 'r.id')
            ->join('hotels AS h', 'p.hotel_id', '=', 'h.id')
            ->where('hotel_id', $hotel_id)
            ->get();
    }
    
    const UPDATE_AT = null;
    public $timestamps = false;
}
