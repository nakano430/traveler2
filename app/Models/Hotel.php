<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class hotel extends Model
{
    use HasFactory;
    protected $table = "hotels";

    protected $fillable = [
        'id', 
        'name', 
        'region_id', 
        'area_id', 
        'address', 
        'tel', 
        'detail'
    ];

    public function editHotelInfo($id){
      return DB::table('hotels AS h')
            ->select('h.id AS id', 'r1.name AS region', 'a.name AS area', 'h.name AS name', 'picture_id','address', 'tel', 'detail')
            ->join('regions AS r1', 'h.region_id', '=', 'r1.id')
            ->join('areas AS a', 'h.region_id', '=', 'a.id')
            ->where('h.id', $id)
            ->first();
    }

    public function getHotelList(){
      return DB::table('hotels AS h')
            ->select('h.id AS id', 'r.name AS region', 'a.name AS area', 'h.name AS name', 'address', 'tel')
            ->join('regions AS r', 'h.region_id', '=', 'r.id')
            ->join('areas AS a', 'h.region_id', '=', 'a.id')
            ->get();
    }

    public function getHotelName(){
      return DB::table('hotels AS h')
            ->join('regions AS r', 'h.region_id', '=', 'r.id')
            ->join('areas AS a', 'h.region_id', '=', 'a.id')
            ->get();
    }
    
    public function searchHotels($hotel_name, $area_id, $room_id){
      return DB::table('prices AS p')
            ->select('h.name as name', 'english_name', 'address', 'tel', 'roomtype', 'price')
            ->join('rooms AS r', 'p.room_id', '=', 'r.id')
            ->join('hotels AS h', 'p.hotel_id', '=', 'h.id')
            ->where('name', 'like', "%$hotel_name%")
            ->where('area_id', 'like', "%$area_id%")
            ->where('room_id', 'like', "%$room_id%")
            ->get();
    }

    public function searchHotelsWithoutRoomtype($hotel_name, $area_id){
        return DB::table('prices AS p')
            ->select('h.name as name', 'picture_id', 'address', 'tel')
            ->join('rooms AS r', 'p.room_id', '=', 'r.id')
            ->join('hotels AS h', 'p.hotel_id', '=', 'h.id')
            ->where('name', 'like', "%$hotel_name%")
            ->where('area_id', 'like', "%$area_id%")
            ->get();
    }

    public function searchHotelsWithRegion($region_id){
        return DB::table('prices AS p')
            ->select('h.name', 'picture_id', 'address', 'tel')
            ->join('rooms AS r', 'p.room_id', '=', 'r.id')
            ->join('hotels AS h', 'p.hotel_id', '=', 'h.id')
            ->where('region_id', $region_id)
            ->get();
    }

    public function getHotelInfo($name){
        return DB::table('hotels')
            ->where('name', $name)
            ->first();
    }
    
    const UPDATE_AT = null;
    public $timestamps = false;
}
