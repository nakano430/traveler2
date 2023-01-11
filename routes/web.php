<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [ TravelController::class, 'index'] );
Route::get('/index', [ TravelController::class, 'index'] );
Route::post('/', [ TravelController::class, 'index'] );
Route::post('/index', [ TravelController::class, 'index'] );

Route::get('/login', [ TravelController::class, 'index'] );
Route::post('/login', [ TravelController::class, 'login'] );

Route::get('/mypage', [TravelController::class, 'index']);
Route::post('/mypage', [TravelController::class, 'mypage']);

Route::get('/profile', [TravelController::class, 'index']);
Route::post('/profile', [TravelController::class, 'profile']);

Route::get('/profile_confirm', [TravelController::class, 'index']);
Route::post('/profile_confirm', [TravelController::class, 'profile_confirm']);

Route::get('/profile_complete', [TravelController::class, 'index']);
Route::post('/profile_complete', [TravelController::class, 'profile_complete']);

Route::get('/favorite_itinerary', [TravelController::class, 'index']);
Route::post('/favorite_itinerary', [TravelController::class, 'favorite_itinerary']);

Route::get('/password_reset', [TravelController::class, 'password_reset']);
Route::post('/password_reset', [TravelController::class, 'password_reset']);

Route::get('/password_reset_send', [TravelController::class, 'index']);
Route::post('/password_reset_send', [TravelController::class, 'password_reset_send']);

Route::get('/password_edit', [TravelController::class, 'index']);
Route::post('/password_edit', [TravelController::class, 'password_edit']);

Route::get('/password_edit_input', [TravelController::class, 'index']);
Route::post('/password_edit_input', [TravelController::class, 'password_edit_input']);

Route::get('/signup', [ TravelController::class, 'signup'] );
Route::post('/signup', [ TravelController::class, 'signup'] );

Route::get('/signup_confirm', [ TravelController::class, 'index'] );
Route::post('/signup_confirm', [ TravelController::class, 'signup_confirm'] );

Route::get('/signup_complete', [ TravelController::class, 'index'] );
Route::post('/signup_complete', [ TravelController::class, 'signup_complete'] );

Route::get('/my_itinerary', [ TravelController::class, 'index'] );
Route::post('/my_itinerary', [ TravelController::class, 'my_itinerary'] );

Route::get('/my_itinerary_complete', [ TravelController::class, 'index'] );
Route::post('/my_itinerary_complete', [ TravelController::class, 'my_itinerary_complete'] );

Route::get('/everyone_itinerary', [ TravelController::class, 'index'] );
Route::post('/everyone_itinerary', [ TravelController::class, 'everyone_itinerary'] );

Route::get('/search_hotels', [ TravelController::class, 'index'] );
Route::post('/search_hotels', [ TravelController::class, 'search_hotels'] );

Route::get('/search_areas_hokkaido', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_tohoku', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_koushinetsu', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_kanto', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_hokuriku', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_kansai', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_tokai', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_sanyo', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_sanin', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_shikoku', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_kyushu', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_areas_okinawa', [ TravelController::class, 'search_areas_hokkaido'] );
Route::get('/search_area', [ TravelController::class, 'search_area'] );

Route::get('/hotel_detail', [ TravelController::class, 'index'] );
Route::post('/hotel_detail', [ TravelController::class, 'hotel_detail'] );

Route::get('/area_detail', [ TravelController::class, 'index'] );
Route::post('/area_detail', [ TravelController::class, 'area_detail'] );

Route::get('/user_edit', [TravelController::class, 'index']);
Route::post('/user_edit', [TravelController::class, 'user_edit']);

Route::get('/user_list', [TravelController::class, 'index']);
Route::post('/user_list', [TravelController::class, 'user_list']);

Route::get('/user_edit_confirm', [TravelController::class, 'index']);
Route::post('/user_edit_confirm', [TravelController::class, 'user_edit_confirm']);

Route::get('/user_edit_complete', [TravelController::class, 'index']);
Route::post('/user_edit_complete', [TravelController::class, 'user_edit_complete']);

Route::get('/itinerary_list', [TravelController::class, 'index']);
Route::post('/itinerary_list', [TravelController::class, 'itinerary_list']);

Route::get('/touristarea_list', [TravelController::class, 'index']);
Route::post('/touristarea_list', [TravelController::class, 'touristarea_list']);

Route::get('/touristarea_edit', [TravelController::class, 'touristarea_edit']);
Route::post('/touristarea_edit', [TravelController::class, 'touristarea_edit']);

Route::get('/touristarea_edit_complete', [TravelController::class, 'index']);
Route::post('/touristarea_edit_complete', [TravelController::class, 'touristarea_edit_complete']);

Route::get('/hotel_list', [TravelController::class, 'index']);
Route::post('/hotel_list', [TravelController::class, 'hotel_list']);

Route::get('/hotel_edit', [TravelController::class, 'hotel_edit']);
Route::post('/hotel_edit', [TravelController::class, 'hotel_edit']);

Route::get('/hotel_edit_complete', [TravelController::class, 'index']);
Route::post('/hotel_edit_complete', [TravelController::class, 'hotel_edit_complete']);

Route::get('/user_delete', [ TravelController::class, 'index'] );
Route::post('/user_delete', [ TravelController::class, 'user_delete'] );

Route::get('/itinerary_delete', [ TravelController::class, 'index'] );
Route::post('/itinerary_delete', [ TravelController::class, 'itinerary_delete'] );

Route::get('/touristarea_delete', [ TravelController::class, 'index'] );
Route::post('/touristarea_delete', [ TravelController::class, 'touristarea_delete'] );


