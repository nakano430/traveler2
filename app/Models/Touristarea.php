<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Touristarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 
        'region_id',
        'area_id',
        'name',
        'genre',
        'detail', 
    ];

    public function editTouristareaInfo($area_id){
        return DB::table('touristareas AS t')
            ->select('t.id AS id', 'r.name AS region', 'a.name AS area', 't.name AS name', 'genre', 'address', 'english_name', 'detail')
            ->join('regions AS r', 't.region_id', '=', 'r.id')
            ->join('areas AS a', 't.area_id', '=', 'a.id')
            ->where('t.id', $area_id)
            ->first();
    }

    public function searchTouristareaInfo(){
        return DB::table('touristareas AS t')
            ->select('t.id', 'r.name AS region', 'a.name AS area', 't.name AS name', 'genre', 'address', 'english_name')
            ->join('regions AS r', 't.region_id', '=', 'r.id')
            ->join('areas AS a', 't.area_id', '=', 'a.id')
            ->get();
    }

    public function searchAreaInfo($region_id){
        return DB::table('touristareas AS t')
            ->select('t.name AS area_name', 'english_name', 'r.name AS region_name')
            ->join('regions AS r', 't.region_id', '=', 'r.id')
            ->where('region_id', $region_id)
            ->get();
    }

    public function getAreaInfo($area_name){
        return DB::table('touristareas')
            ->where('name', $area_name)
            ->first();
    }

    const UPDATE_AT = null;
    public $timestamps = false;
}
