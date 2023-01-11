<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ホテル詳細</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/detail.css">

    <script type="text/javascript" src="./js/script.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/cdebf06d40.js" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
</head>

<body>
    <div class="header">
        <a href="/index"><img src="./img/logo.png" class="logo"></a>
        @if($user_id == null)
            <form method="post" action="/login" class="login">
                @csrf
                <button type="submit"><p><i class="fa-solid fa-user">&emsp;ログイン</i></p></button>
            </form>
        @elseif($user_id == 1)
            <form method="post" action="/mypage" class="login">
                @csrf
                <button type="submit"><p><i class="fa-solid fa-user">&emsp;管理者ページ</i></p></button>
            </form>
        @else
            <form method="post" action="/mypage" class="login">
                @csrf
                <button type="submit"><p><i class="fa-solid fa-user">&emsp;マイページ</i></p></button>
            </form>
        @endif
    </div>
    <div>
        <h1 class="detail_title">{{ $hotel_info->name }}</h1>
        <table class="detail_category">
            <tr>
                <td><img class="hotel_picture" src="img/hotel/{{ $hotel_info->english_name }}.jpg"></td>
                <td class="detail_delimiter"></td>
                <td class="area_detail">
                    <h2>● ホテル詳細</h2>
                    <h3><i class="fa-solid fa-location-dot">&emsp;{{ $hotel_info->address }}</i></h3>
                    <h3><i class="fa-solid fa-phone">&emsp;{{ $hotel_info->tel }}</i></h3>
                    <h3><i class="fa-solid fa-money-check-dollar">&emsp;部屋タイプと料金（一人当たり）</i></h3>
                    @foreach($room_price as $room)
                    <p>&emsp;・{{ $room->roomtype }} / {{ $room->price }}円</p>
                    @endforeach

                </td>
            </tr>
        </table>

        <h3 class="hotel_detail_title"><i class="fa-solid fa-star">&emsp;ポイント</i></h3>
        <div class="hotel_detail"><h3>{{ $hotel_info->detail }}</h3></div>
        <div id="map" class="map"></div>


        <div class="search_hotels_back">
            <button type="button" onclick="history.back()" class="back_button">戻る</button>
        </div>
    </div>

    @include("include.footer")


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <script type="text/javascript" src="./js/script.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWK8nttzmmyqp95LfzcGc0A4bBXJ-cz0Q&callback=initMap"></script>

    <script type="text/javascript">
        var address = '{{$hotel_address}}';
        // Google Mapを表示する関数
        function initMap() {
            const geocoder = new google.maps.Geocoder();
            // ここでaddressのvalueに住所のテキストを指定する
            console.log(address);
            geocoder.geocode({
                address: address
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const latlng = {
                        lat: results[0].geometry.location.lat(),
                        lng: results[0].geometry.location.lng()
                    }
                    const opts = {
                        zoom: 15,
                        center: new google.maps.LatLng(latlng)
                    }
                    const map = new google.maps.Map(document.getElementById('map'), opts)
                    new google.maps.Marker({
                        position: latlng,
                        map: map
                    })
                } else {
                    console.error('Geocode was not successful for the following reason: ' + status)
                }
            })
        }
    </script>

</body>

</html>