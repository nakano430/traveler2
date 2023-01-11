<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class itinerary extends Model
{
    use HasFactory;
    protected $table = "itineraries";


    protected $fillable = [
        'id', 
        'user_id',
        'region_id',
        'area_id', 
        'tour_date', 
        'departure_day1', 
        'touristarea_num1',
        'touristarea_num2', 
        'hotel_id',
        'departure_day2',
        'touristarea_num3',
        'touristarea_num4',
        'arrival',
    ];

    public function getItineraryList(){
        return DB::table('itineraries AS i')
            ->select(
                'i.id AS itinerary_id',
                'u.name AS user_name',
                'h.name AS hotel_name',
                'r.name AS region_name',
                'a.name AS area_name',
                'tour_date',
                'departure_day1',
                'touristarea_num1',
                'touristarea_num2',
                'hotel_id',
                'departure_day2',
                'touristarea_num3',
                'touristarea_num4',
                'arrival')
            ->leftJoin('users AS u', 'i.user_id', '=', 'u.id')
            ->leftJoin('regions AS r', 'i.region_id', '=', 'r.id')
            ->leftJoin('areas AS a', 'i.area_id', '=', 'a.id')
            ->leftJoin('hotels AS h', 'i.hotel_id', '=', 'h.id')
            ->orderBy('i.id')
            ->get();
        }

    public function getMyItinerary($user_id){
        return DB::table('itineraries AS i')
        ->select(
            'i.id AS id',
            'tour_date',
            'r.name AS region_name',
            'a.name AS area_name',
            'departure_day1',
            'touristarea_num1',
            'touristarea_num2',
            'h.name AS hotel_name',
            'departure_day2',
            'touristarea_num3',
            'touristarea_num4',
            'arrival'
        )
        ->leftJoin('regions AS r', 'i.region_id', '=', 'r.id')
        ->leftJoin('areas AS a', 'i.area_id', '=', 'a.id')
        ->leftJoin('hotels AS h', 'i.hotel_id', '=', 'h.id')
        ->where('user_id', $user_id)
        ->orderBy('i.id')
        ->get();
    }
    
    const UPDATE_AT = null;
    public $timestamps = false;
}

