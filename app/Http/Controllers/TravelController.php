<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Hotel;
use App\Models\Itinerary;
use App\Models\Price;
use App\Models\Region;
use App\Models\Room;
use App\Models\Touristarea;
use App\Models\User;
use App\Http\Requests\TravelRequest;

class TravelController extends Controller
{
    public function index(Request $request){
        $user_id = $request->session()->get('user_id');
        $request->session()->forget('pw_chk');
        
        if(isset($user_id)){

            $logout = htmlspecialchars($request->input('logout'), ENT_QUOTES, "UTF-8");

            if($logout){
                $request->session()->forget('user_id');
                $request->session()->forget('error');

                $user_id = $request->session()->get('user_id');
            }
        }

        return view('index', compact('user_id'));
    }

    //-------------------------------------------------------
    //  ログイン
    //-------------------------------------------------------

    public function login(Request $request){

        $pw_chk = $request->session()->get('pw_chk');

        return view('login.login', compact('pw_chk'));
    }

    //-------------------------------------------------------
    //  サインアップ
    //-------------------------------------------------------

    public function signup(){
        return view('login.signup');
    }

    public function signup_confirm(Request $request){
        
        $this->validate($request, [
            'name'  => 'required | max:10',
            'email'  => 'required | email:strict',
            'tel'  => 'nullable | regex:/^[0-9-]+$/ | between:11,13',
            'address'  => 'nullable',
            'password1'  => 'required | between:6,10 | regex:/^[a-zA-Z0-9]+$/',
            'password2'  => 'required | between:6,10 | regex:/^[a-zA-Z0-9]+$/ | same:password1',

        ],[
            'name.required' => ':attributeは必ずご入力ください。',
            'name.max' => ':attributeは10文字以内でご入力ください。',

            'email.required' => ':attributeは必ずご入力ください。',
            'email.email' => ':attributeを正しくご入力ください。',

            'tel.regex' => ':attributeは数字とハイフンのみでご入力ください。',
            'tel.between' => ':attributeを正しくご入力ください。',

            'password1.required' => ':attributeは必ずご入力ください。',
            'password1.between' => ':attributeは6～10文字の半角英数でご入力ください。',
            'password1.regex' => ':attributeは半角英数字のみでご入力ください。',

            'password2.required' => ':attributeは必ずご入力ください。',
            'password2.between' => ':attributeは6～10文字の半角英数でご入力ください。',
            'password2.regex' => ':attributeは半角英数字のみでご入力ください。',
            'password2.same' => ':attributeが一致しません。',

        ],[
            'name' => '氏名',
            'email' => 'メールアドレス',
            'tel' => '電話番号',
            'password1' => 'パスワード',
            'password2' => 'パスワード'
        ]);

        // $action = $request->post('action', 'back');
        // $input = $request->except('action');
 
        // if($request->input('back') == 'back'){
        //     return redirect()->action('TravelController@signup')
        //     ->withInput();
        // } 

        $name = htmlspecialchars($request->input('name'), ENT_QUOTES, "UTF-8");
        $email = htmlspecialchars($request->input('email'), ENT_QUOTES, "UTF-8");
        $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES, "UTF-8");
        $address = htmlspecialchars($request->input('address'), ENT_QUOTES, "UTF-8");
        $password = htmlspecialchars($request->input('password1'), ENT_QUOTES, "UTF-8");
        
        $params = [
            'name' => $name,
            'email' => $email,
            'tel' => $tel,
            'address' => $address,
            'password' => $password
        ];

        return view('login.signup_confirm', compact('params'));
    }

    public function signup_complete(Request $request){

        $params = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'address' => $request->input('address'),
            'password' => $request->input('password'),
        ]);

        return view('login.signup_complete', compact('params'));
    }

    //-------------------------------------------------------
    //  マイページ
    //-------------------------------------------------------

    public function mypage(Request $request){
        $user_id = $request->session()->get('user_id');

        $request->session()->forget('error_msg');
        $error = $request->session()->get('error_msg');

        $request->session()->forget('pw_chk');
        $pw_chk = $request->session()->get('pw_chk');
        

        if(isset($user_id)){

            $user = User::where("id", $user_id)
                ->first();

            $itineraries = new Itinerary();
            $has_itinerary = $itineraries->getMyItinerary($user_id);
        } 
        else{
            $email = htmlspecialchars($request->input('email'), ENT_QUOTES, "UTF-8");
            $password = htmlspecialchars($request->input('password'), ENT_QUOTES, "UTF-8");
            
            $user = User::where("email", $email)
                ->where("password", $password)
                ->first();

            if(!empty($user)){
                $request->session()->put('user_id', $user['id']);
                $user_id = $request->session()->get('user_id');

                $itineraries = new Itinerary();
                $has_itinerary = $itineraries->getMyItinerary($user['id']);
            }
            else{
                $request->session()->put('pw_chk', 'no_user');
                $pw_chk = $request->session()->get('pw_chk');

                return view('login.login', compact('pw_chk'));
            }  
        }

        if($user_id == 1){
            return view('administrator.administrator', compact('user'));
        }
        else{
            if (isset($has_itinerary[0]->id)) {
                return view('mypage.mypage', compact('user', 'has_itinerary'));
            } else {
                $result = false;
                return view('mypage.mypage', compact('user', 'result'));
            }
        }
    }

    //-------------------------------------------------------
    //  プロフィール
    //-------------------------------------------------------

    public function profile(Request $request){

        $user_id = $request->session()->get('user_id');

        $user = User::where("id", $user_id)
                    ->first();
        
        return view('mypage.profile', compact('user'));
    }

    public function profile_confirm(Request $request){
        $this->validate($request, [
            'name'  => 'required | max:10',
            'email'  => 'required | email:strict',
            'tel'  => 'nullable | regex:/^[0-9-]+$/ | between:11,13',
            'address'  => 'nullable'
        ],[
            'name.required' => ':attributeは必ずご入力ください。',
            'name.max' => ':attributeは10文字以内でご入力ください。',

            'email.required' => ':attributeは必ずご入力ください。',
            'email.email' => ':attributeを正しくご入力ください。',

            'tel.regex' => ':attributeは数字とハイフンのみでご入力ください。',
            'tel.between' => ':attributeを正しくご入力ください。'
        ],[
            'name' => '氏名',
            'email' => 'メールアドレス',
            'tel' => '電話番号'
        ]);

        $name = htmlspecialchars($request->input('name'), ENT_QUOTES, "UTF-8");
        $email = htmlspecialchars($request->input('email'), ENT_QUOTES, "UTF-8");
        $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES, "UTF-8");
        $address = htmlspecialchars($request->input('address'), ENT_QUOTES, "UTF-8");
        
        $params = [
            'name' => $name,
            'email' => $email,
            'tel' => $tel,
            'address' => $address,
        ];

        return view('mypage.profile_confirm', compact('params'));
    }

    public function profile_complete(Request $request){

        $user_id = $request->session()->get('user_id');
        $name = htmlspecialchars($request->input('name'), ENT_QUOTES, "UTF-8");
        $email = htmlspecialchars($request->input('email'), ENT_QUOTES, "UTF-8");
        $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES, "UTF-8");
        $address = htmlspecialchars($request->input('address'), ENT_QUOTES, "UTF-8");

        $user_info = User::find($user_id);
        $user_info->name = $name;
        $user_info->email = $email;
        $user_info->tel = $tel;
        $user_info->address = $address;

        $user_info->save();

        return view('mypage.profile_complete', compact('user_info'));
    }

    //-------------------------------------------------------
    //  お気に入りの旅程表
    //-------------------------------------------------------

    public function favorite_itinerary(){
        return view('mypage.favorite_itinerary');
    }

     //-------------------------------------------------------
    //  パスワードリセット
    //-------------------------------------------------------

    public function password_edit(Request $request){

        $request->session()->put('pw_chk', 'on_user');
        $pw_chk = $request->session()->get('pw_chk');
        $error = $request->session()->get('user_id');
        
        
        
        return view('login.password_edit', compact('error', 'pw_chk'));
    }

    public function password_edit_input(Request $request){
        
        $name = htmlspecialchars($request->input('name'), ENT_QUOTES, "UTF-8");
        $email = htmlspecialchars($request->input('email'), ENT_QUOTES, "UTF-8");
        $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES, "UTF-8");

        
        $user = User::where("name", $name)
                    ->where('email', $email)
                    ->where('tel', $tel)
                    ->first();

        dump($user);
        if (!isset($user)){
            $request->session()->put('error', "ユーザーが存在しません");
            $error = $request->session()->get('error');
            return view('login.password_edit', compact('error'));
        }    
        else{
            $error = $request->session()->forget('error');

            return view('mypage.password_reset');
        }
    

        

        // if ($user_pw == $now_pw) {
        //     $user->password = $new_pw;
        //     $user->save();
        // }
        
    }

    //-------------------------------------------------------
    //  パスワード変更
    //-------------------------------------------------------

    public function password_reset(Request $request){
        
        $user_id = $request->session()->get('user_id');
        if (empty($user_id)) {
            return view('index', compact('user_id'));
        } 

        
        $error = $request->session()->get('error_msg');

        return view('mypage.password_reset', compact('error'));
    }

    public function password_reset_send(Request $request){

        $user_id = $request->session()->get('user_id');
        $error = $request->session()->get('error_msg');


        $now_pw = htmlspecialchars($request->input('now_password'), ENT_QUOTES, "UTF-8");
        $new_pw = htmlspecialchars($request->input('new_password1'), ENT_QUOTES, "UTF-8");
        
        $user = User::where("id", $user_id)
                    ->where("password", $now_pw)
                    ->first();
        

        if (empty($user)) {
            $request->session()->put('error_msg', "empty");
            $error = $request->session()->get('error_msg');


            return view('mypage.password_reset', compact('error'));
        }
        else{

            $request->session()->forget('error_msg');

            $this->validate($request, [
                'now_password'  => 'required',
                'new_password1'  => 'required | between:6,10 | regex:/^[a-zA-Z0-9]+$/',
                'new_password2'  => 'required | same:new_password1',
            ], [
                'now_password.required' => ':attributeは必ずご入力ください。',
    
                'new_password1.required' => ':attributeは必ずご入力ください。',
                'new_password1.between' => ':attributeは6～10文字の半角英数でご入力ください。',
                'new_password1.regex' => ':attributeは半角英数字のみでご入力ください。',
    
                'new_password2.required' => ':attributeは必ずご入力ください。',
                'new_password2.same' => ':attributeが一致しません。',
    
            ], [
                'now_password' => '現在のパスワード',
                'new_password1' => '新しいパスワード',
                'new_password2' => 'パスワード'
            ]);

            $user_pw = $user->password;
            if ($user_pw == $now_pw) {
                $user->password = $new_pw;
                $user->save();
            }
        }  
        
        return view('mypage.password_reset_send');
    }
    //-------------------------------------------------------
    //  旅程表作成
    //-------------------------------------------------------
    
    public function my_itinerary(TravelRequest $request){

        $user_id = $request->session()->get('user_id');

        $travel_day = htmlspecialchars($request->input('travel_day'), ENT_QUOTES, "UTF-8");
        $region = htmlspecialchars($request->input('region'), ENT_QUOTES, "UTF-8");
        $prefecture = htmlspecialchars($request->input('prefecture'), ENT_QUOTES, "UTF-8");

        $prefecture_id = Area::where("name", $prefecture)->first();
        $touristarea = Touristarea::where("area_id", $prefecture_id['id'])
                        ->get();
        $hotels = Hotel::where("area_id", $prefecture_id["id"])
                        ->get();

        $params = [
                'travel_day' => $travel_day,
                'region' => $region,
                'prefecture' => $prefecture
        ];


        return view('itinerary.my_itinerary', compact('params', 'touristarea', 'hotels', 'user_id'));
    }
    
    public function my_itinerary_complete(Request $request){

        $user_id = $request->session()->get('user_id');

        $travel_day = htmlspecialchars($request->input('travel_day'), ENT_QUOTES, "UTF-8");
        $region = htmlspecialchars($request->input('region'), ENT_QUOTES, "UTF-8");
        $prefecture = htmlspecialchars($request->input('prefecture'), ENT_QUOTES, "UTF-8");
        $hotel = htmlspecialchars($request->input('selected_hotel'), ENT_QUOTES, "UTF-8");


        $region_id = Region::where('name', $region)
        ->first();
        $area_id = Area::where('name', $prefecture)
        ->first();

        $departure_day1 = htmlspecialchars($request->input('departure_day1'), ENT_QUOTES, "UTF-8");
        $tourist_area_id1 = htmlspecialchars($request->input('tourist_area_id1'), ENT_QUOTES, "UTF-8");
        $tourist_area_id2 = htmlspecialchars($request->input('tourist_area_id2'), ENT_QUOTES, "UTF-8");
        $selected_hotel = htmlspecialchars($request->input('selected_hotel'), ENT_QUOTES, "UTF-8");
        $departure_day2 = htmlspecialchars($request->input('departure_day2'), ENT_QUOTES, "UTF-8");
        $tourist_area_id3 = htmlspecialchars($request->input('tourist_area_id3'), ENT_QUOTES, "UTF-8");
        $tourist_area_id4 = htmlspecialchars($request->input('tourist_area_id4'), ENT_QUOTES, "UTF-8");
        $arrival = htmlspecialchars($request->input('arrival'), ENT_QUOTES, "UTF-8");
        
        $hotel_id = Hotel::where('name', $selected_hotel)
                        ->first();

        $params = Itinerary::create([
            'user_id' => $user_id,
            'tour_date' => $travel_day,
            'region_id' => $region_id['id'],
            'area_id' => $area_id['id'],
            'departure_day1' => $departure_day1,
            'touristarea_num1' => $tourist_area_id1,
            'touristarea_num2' => $tourist_area_id2,
            'hotel_id' => $hotel_id['id'],
            'departure_day2' => $departure_day2,
            'touristarea_num3' => $tourist_area_id3,
            'touristarea_num4' => $tourist_area_id4,
            'arrival' => $arrival
        ]);

        return view('itinerary.my_itinerary_complete', compact('user_id'));
    }

    //-------------------------------------------------------
    //  他の人の旅程表
    //-------------------------------------------------------

    public function everyone_itinerary(Request $request){

        $user_id = $request->session()->get('user_id');

        $itineraries = new Itinerary();
        $results = $itineraries->getItineraryList();
        
        dump($results);
        return view('itinerary.everyone_itinerary', compact('results', 'user_id'));
    }

    //----------------------------s---------------------------
    //  条件から検索
    //-------------------------------------------------------

    public function search_hotels(Request $request){

        $user_id = $request->session()->get('user_id');

        $lodging_area = htmlspecialchars($request->input('lodging_area'), ENT_QUOTES, "UTF-8");
        $input_name = htmlspecialchars($request->input('hotel_name'), ENT_QUOTES, "UTF-8");
        $input_room = htmlspecialchars($request->input('room_type'), ENT_QUOTES, "UTF-8");
       
        
        
        //-------------------------------------------------------
        // 宿泊エリアの設定
        //-------------------------------------------------------
        if($lodging_area == ""){
            $area_id = "%";            
        }
        else{
            $area_id = Area::where('name', 'like', $lodging_area) -> first();
            $area_id = $area_id['id'];
        }

        //-------------------------------------------------------
        // ホテル名の設定の設定
        //-------------------------------------------------------
        if(empty($input_name)){
            $hotel_name = "%";
        }
        else{
            $hotel_name = $input_name;
        }

        //-------------------------------------------------------
        // 部屋タイプの設定の設定
        //-------------------------------------------------------
        if(!empty($input_room)){
            $room_type = Room::where('roomtype', 'like', $input_room) -> first();
            $room_id = $room_type['id'];
        }
        
        //-------------------------------------------------------
        // 条件設定完了
        //-------------------------------------------------------


        if(empty($room_id)){
            $hotels = new Hotel();
            $results = $hotels->searchHotelsWithoutRoomtype($hotel_name, $area_id);
            $with_room = false;
        }
        else{
            $hotels = new Hotel();
            $results = $hotels->searchHotels($hotel_name, $area_id, $room_id);
            $with_room = true;
        }

        
        $tmp = array();
        $hotel_info = array();

        foreach($results as $key => $value){
            if(!in_array($value->name, $tmp)){
                $tmp[] =  $value->name;
                $hotel_info[] = $value;
            }
        }

        $params = [
            'lodging_area' => $lodging_area,
            'hotel_name' => $input_name,
            'room_type' => $input_room,
        ];

        return view('hotels.search_hotels', compact('params', 'area_id', 'hotel_info', 'with_room', 'user_id'));
    }

    //-------------------------------------------------------
    //  エリアから検索
    //-------------------------------------------------------

    public function search_areas_hokkaido(Request $request){

        $user_id = $request->session()->get('user_id');
        
        $region_id = 1;
        $region_name = "北海道";
        $region_english_name = "hokkaido";

        //-------------------------------------------------------
        // 観光地情報
        //-------------------------------------------------------
        $areas = new Touristarea();
        $area = $areas->searchAreaInfo($region_id);

        //-------------------------------------------------------
        // ホテル情報
        //-------------------------------------------------------
        $hotels = new Hotel();
        $hotel = $hotels->searchHotelsWithRegion($region_id);

        $tmp = array();
        $hotel_info = array();

        foreach($hotel as $key => $value){
            if(!in_array($value->name, $tmp)){
                $tmp[] =  $value->name;
                $hotel_info[] = $value;
            }
        }
        
        $params = [
            'region_id' => $region_id,
            'region_name' => $region_name,
            'region_english_name' => $region_english_name
        ];

        return view('areas.search_areas_hokkaido', compact('user_id', 'params', 'area', 'hotel_info'));
    }

    public function search_areas_tohoku(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_tohoku', compact('user_name'));
    }
    public function search_areas_koushinetsu(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_kanto', compact('user_name'));
    }public function search_areas_kanto(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_koshinestu', compact('user_name'));
    }
    public function search_areas_hokuriku(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_hokuriku', compact('user_name'));
    }
    public function search_areas_kansai(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_tokai', compact('user_name'));
    }
    public function search_areas_tokai(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_kansai', compact('user_name'));
    }
    public function search_areas_sanyo(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_hokkaido', compact('user_name'));
    }
    public function search_areas_sanin(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_hokkaido', compact('user_name'));
    }
    public function search_areas_shikoku(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_hokkaido', compact('user_name'));
    }
    public function search_areas_kyushu(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_hokkaido', compact('user_name'));
    }
    public function search_areas_okinawa(Request $request){

        $user_name = $request->session()->get('user_name');


        return view('areas.search_areas_hokkaido', compact('user_name'));
    }
    
    //-------------------------------------------------------
    //  ホテル詳細
    //-------------------------------------------------------

    public function hotel_detail(Request $request){

        $user_id = $request->session()->get('user_id');

        $hotel_name = htmlspecialchars($request->input('hotel_name'), ENT_QUOTES, "UTF-8");

        $hotels = new Hotel();
        $hotel_info = $hotels->getHotelInfo($hotel_name);
        
        $prices = new Price();
        $room_price = $prices->getPrice($hotel_info->id);

        $hotel_address = $hotel_info->address;
        
        return view('hotels.hotel_detail', compact('user_id', 'hotel_info', 'room_price', 'hotel_address'));
    }

    //-------------------------------------------------------
    //  観光地詳細
    //-------------------------------------------------------

    public function area_detail(Request $request)
    {

        $user_id = $request->session()->get('user_id');
        $area_name = htmlspecialchars($request->input('area_name'), ENT_QUOTES, "UTF-8");
        $areas = new Touristarea();
        $area_info = $areas->getAreaInfo($area_name);

        $area_address = $area_info->address;

        return view('areas.area_detail', compact('user_id', 'area_info', 'area_address'));
    }

    //-------------------------------------------------------
    //  ユーザー一覧ページ
    //-------------------------------------------------------

    public function administrator(Request $request)
    {
        $user_id = $request->session()->get('user_id');

        if (isset($user_id)) {

            $user = User::where("id", $user_id)
                ->first();

            $itineraries = new Itinerary();
            $has_itinerary = $itineraries->getMyItinerary($user_id);
        } 
        else {
            $email = htmlspecialchars($request->input('email'), ENT_QUOTES, "UTF-8");
            $password = htmlspecialchars($request->input('password'), ENT_QUOTES, "UTF-8");

            $user = User::where("email", $email)
                ->where("password", $password)
                ->first();

            if (isset($user)) {
                $user_id = $request->session()->put('user_id', $user['id']);

                
            } else {
                $no_user = true;
                return view('login.login', compact('no_user'));
            }
        }


        return view('administrator.administrator', compact('user'));

    }

    public function user_list(Request $request){
        $user_id = $request->session()->get('user_id');

        $users = User::all();

        return view('administrator.user_list', compact('user_id', 'users'));
    }
    //-------------------------------------------------------
    //  ユーザー情報編集
    //-------------------------------------------------------

    public function user_edit(Request $request){

        $user_id = $request->session()->get('user_id');

        $member_id = htmlspecialchars($request->input('user_id'), ENT_QUOTES, "UTF-8");
        $user = User::where("id", $member_id)
                    ->first();
        return view('administrator.user_edit', compact('user'));
    }

    public function user_edit_confirm(Request $request){
        $this->validate($request, [
            'name'  => 'required | max:10',
            'email'  => 'required | email:strict',
            'tel'  => 'nullable | regex:/^[0-9-]+$/ | between:11,13',
            'address'  => 'nullable'
        ],[
            'name.required' => ':attributeは必ずご入力ください。',
            'name.max' => ':attributeは10文字以内でご入力ください。',

            'email.required' => ':attributeは必ずご入力ください。',
            'email.email' => ':attributeを正しくご入力ください。',

            'tel.regex' => ':attributeは数字とハイフンのみでご入力ください。',
            'tel.between' => ':attributeを正しくご入力ください。'
        ],[
            'name' => '氏名',
            'email' => 'メールアドレス',
            'tel' => '電話番号'
        ]);

        $name = htmlspecialchars($request->input('name'), ENT_QUOTES, "UTF-8");
        $email = htmlspecialchars($request->input('email'), ENT_QUOTES, "UTF-8");
        $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES, "UTF-8");
        $address = htmlspecialchars($request->input('address'), ENT_QUOTES, "UTF-8");
        
        $params = [
            'name' => $name,
            'email' => $email,
            'tel' => $tel,
            'address' => $address,
        ];

        return view('administrator.user_edit_confirm', compact('params'));
    }

    public function user_edit_complete(Request $request){

        $user_id = $request->session()->get('user_id');
        $name = htmlspecialchars($request->input('name'), ENT_QUOTES, "UTF-8");
        $email = htmlspecialchars($request->input('email'), ENT_QUOTES, "UTF-8");
        $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES, "UTF-8");
        $address = htmlspecialchars($request->input('address'), ENT_QUOTES, "UTF-8");


        $user_info = User::where('email', $email)
                        ->first();
                        
        if(!empty($name)){
            $user_info->name = $name;
        }
        $user_info->email = $email;
        if(!empty($tel)){
            $user_info->tel = $tel;
        }
        if(!empty($address)){
            $user_info->address = $address;
        }

        $user_info->save();

        return view('administrator.user_edit_complete', compact('user_info'));
    }
    
    //-------------------------------------------------------
    //  旅程表一覧ページ
    //-------------------------------------------------------

    public function itinerary_list(Request $request){

        $user_id = $request->session()->get('user_id');

        $itineraries = new Itinerary();
        $results = $itineraries->getItineraryList();
        
        return view('administrator.itinerary_list', compact('results', 'user_id'));
    }

    
    //-------------------------------------------------------
    //  観光地一覧ページ
    //-------------------------------------------------------

    public function touristarea_list(Request $request){
        $user_id = $request->session()->get('user_id');

        $touristareas = new Touristarea();

        $area_info = $touristareas->searchTouristareaInfo();
    
    

        return view('administrator.touristarea_list', compact('user_id', 'area_info'));
    }

    //-------------------------------------------------------
    //  観光地情報編集
    //-------------------------------------------------------

    public function touristarea_edit(Request $request){

        $area_id = htmlspecialchars($request->input('area_id'), ENT_QUOTES, "UTF-8");
        
        $touristareas = new Touristarea();
        $results = $touristareas->editTouristareaInfo($area_id);

        $area_address = $results->address;

       
        return view('administrator.touristarea_edit', compact('results', 'area_address'));
    }

    public function touristarea_edit_complete(Request $request){

        $this->validate($request, [
            'name'  => 'required',
            'address'  => 'required',
            'genre'  => 'required',
            'detail'  => 'required'
        ],[
            'name.required' => ':attributeは必ずご入力ください。',
            'address.require' => ':attributeは必ずご入力ください。',
            'genre.require' => ':attributeは必ずご入力ください。',
            'detail.require' => ':attributeは必ずご入力ください。'
        ],[
            'name' => '観光地名',
            'address' => '住所',
            'genre' => 'ジャンル',
            'detail' => '観光地情報'
        ]);

        $id = htmlspecialchars($request->input('id'), ENT_QUOTES, "UTF-8");
        $name = htmlspecialchars($request->input('name'), ENT_QUOTES, "UTF-8");
        $address = htmlspecialchars($request->input('address'), ENT_QUOTES, "UTF-8");
        $genre = htmlspecialchars($request->input('genre'), ENT_QUOTES, "UTF-8");
        $detail = htmlspecialchars($request->input('detail'), ENT_QUOTES, "UTF-8");

        $touristarea_info = Touristarea::where('id', $id)
                        ->first();


        $touristarea_info->name = $name;
        $touristarea_info->address = $address;
        $touristarea_info->genre = $genre;
        $touristarea_info->detail = $detail;

        $touristarea_info->save();

        return view('administrator.touristarea_edit_complete');
    }

    //-------------------------------------------------------
    //  ホテル一覧ページ
    //-------------------------------------------------------

    public function hotel_list(Request $request){
        $user_id = $request->session()->get('user_id');

        $hotels = new Hotel();

        $hotel_info = $hotels->getHotelList();
    
    

        return view('administrator.hotel_list', compact('user_id', 'hotel_info'));
    }

    //-------------------------------------------------------
    //  ホテル情報編集
    //-------------------------------------------------------

    public function hotel_edit(Request $request){

        $hotel_id = htmlspecialchars($request->input('hotel_id'), ENT_QUOTES, "UTF-8");
        
        $hotels = new Hotel();
        $results = $hotels->editHotelInfo($hotel_id);

        $prices = new Price();
        $room_price = $prices->getPrice($hotel_id);

        $hotel_address = $results->address;

       
        return view('administrator.hotel_edit', compact('results', 'room_price', 'hotel_address'));
    }

    public function hotel_edit_complete(Request $request){

        // $this->validate($request, [
        //     'name'  => 'required',
        //     'address'  => 'required',
        //     'tel'  => 'required',
        //     'room'  => 'required',
        //     'price'  => 'required',
        //     'detail'  => 'required'
        // ],[
        //     'name.required' => ':attributeは必ずご入力ください。',
        //     'address.require' => ':attributeは必ずご入力ください。',
        //     'tel.require' => ':attributeは必ずご入力ください。',
        //     'room.require' => ':attributeは必ずご入力ください。',
        //     'price.require' => ':attributeは必ずご入力ください。',
        //     'detail.require' => ':attributeは必ずご入力ください。'
        // ],[
        //     'name' => 'ホテル名',
        //     'address' => '住所',
        //     'tel' => '電話番号',
        //     'room' => '部屋タイプ',
        //     'price' => '金額',
        //     'detail' => 'ホテル情報'
        // ]);

        $id = htmlspecialchars($request->input('id'), ENT_QUOTES, "UTF-8");
        $name = htmlspecialchars($request->input('name'), ENT_QUOTES, "UTF-8");
        $address = htmlspecialchars($request->input('address'), ENT_QUOTES, "UTF-8");
        $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES, "UTF-8");
        
        // $price = htmlspecialchars($request->input('price'), ENT_QUOTES, "UTF-8");
        $detail = htmlspecialchars($request->input('detail'), ENT_QUOTES, "UTF-8");

        $count = htmlspecialchars($request->input('count'), ENT_QUOTES, "UTF-8");
        $i = 1;
        $price = htmlspecialchars($request->input("price$i"), ENT_QUOTES, "UTF-8");
        // dump("price$i");
        // dump($price);

        $roomtype = array();
        $price = array();

        // $roomtype1 = htmlspecialchars($request->input("roomtype$i"), ENT_QUOTES, "UTF-8");
        // dump($roomtype1);
        // dump("roomtype'$i'");
        // $i++;
        // $roomtype2 = htmlspecialchars($request->input("roomtype.'$i'"), ENT_QUOTES, "UTF-8");
        // dump($roomtype2);

        // dump($count);
        // $price;
        for($i = 1; $i < $count; $i++){
            $roomtype[] = htmlspecialchars($request->input("roomtype$i"), ENT_QUOTES, "UTF-8");
            $price[] = htmlspecialchars($request->input("price$i"), ENT_QUOTES, "UTF-8");
        }
        

        $hotel_info = Hotel::where('id', $id)
                        ->first();

        
        $prices = new Price();
        $room_price = $prices->getPrice($id);
      
        $hotel_info->name = $name;
        $hotel_info->address = $address;
        $hotel_info->tel = $tel;
        $hotel_info->detail = $detail;
        $hotel_info->save();

        
        // $room_count_stop = 1;
        // $room_count_up = 0;
        // $ok = 1;
        $count = 0;
        foreach($room_price as $room){
            dump($room);

            $room->roomtype = $roomtype[$count];
            $room->price = $price[$count];    

            $room->save();

            $count++;
        }        

        return view('administrator.hotel_edit_complete');
    }
    //-------------------------------------------------------
    //  削除
    //-------------------------------------------------------

    public function user_delete(Request $request){

        $user_id = htmlspecialchars($request->input('user_id'), ENT_QUOTES, "UTF-8");
        
        User::find($user_id)->delete();
       
        return view('delete.user_delete');
    }
    
    public function itinerary_delete(Request $request){

        $itinerary_id = htmlspecialchars($request->input('itinerary_id'), ENT_QUOTES, "UTF-8");

        Itinerary::find($itinerary_id)->delete();
       
        return view('delete.itinerary_delete');
    }
    
    public function touristarea_delete(Request $request){

        $touristarea_id = htmlspecialchars($request->input('touristarea_id'), ENT_QUOTES, "UTF-8");

        Touristarea::find($touristarea_id)->delete();
       
        return view('delete.touristarea_delete');
    }
    


}

