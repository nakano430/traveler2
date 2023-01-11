<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ホテル詳細</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/administrator.css">
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

        <form method="post" action="/index" class="login">
            @csrf
            <button type="submit">
                <p><i class="fa-solid fa-user">&emsp;ログアウト</i></p>
            </button>
            <input type="hidden" name="logout" value="true">
        </form>
    </div>
    <div>
        <form method="POST" action="hotel_edit_complete">
            @CSRF
            <h1 class="detail_title">
                <input type="text" name="name" class="name_box" value="{{ $results->name }}">
            </h1>
            <table class="detail_category">
                <tr>
                    <td><img class="hotel_picture" src="img/hotel/{{ $results->english_name }}.jpg"></td>
                    <td class="detail_delimiter"></td>
                    <td class="area_detail">
                        <h2>● ホテル詳細</h2>
                        <h3><i class="fa-solid fa-location-dot">&emsp;
                                <input type="text" name="address" class="input_box" value="{{ $results->address }}">
                            </i></h3>
                        <h3><i class="fa-solid fa-phone">&emsp;
                                <input type="text" name="tel" class="input_box" value="{{ $results->tel }}">
                            </i></h3>
                        <h3><i class="fa-solid fa-money-check-dollar">&emsp;部屋タイプと料金（一人当たり）</i></h3>
                        @php
                        $count = 1;
                        $roomtype = "roomtype";
                        $price = "price";
                        @endphp
                        @foreach($room_price as $room)
                        <p>&emsp;・
                            <input type="text" name="{{$roomtype.$count}}" class="input_box_roomtype" value="{{ $room->roomtype }}">
                            &emsp;/&emsp;<input type="text" name="{{$price.$count}}" class="input_box_roomtype" value="{{ $room->price }}">
                            円
                        </p>
                        @php
                        $count++;
                        @endphp

                        @endforeach
                        <input type="hidden" name="count" value="{{$count}}">
                    </td>
                </tr>
                <input type="hidden" name="id" value="{{ $results->id }}">
            </table>

            <h3 class="hotel_detail_title"><i class="fa-solid fa-star">&emsp;ポイント</i></h3>
            <div class="hotel_detail_box">
                <h3><textarea name="detail" class="hotel_detail">{!! nl2br(e($results->detail)) !!}</textarea></h3>
            </div>

            <div id="map" class="map"></div>

            <div class="administrator_touristarea_back">
                <button type="button" onclick="history.back()" class="back_button">
                    <h3>戻る</h3>
                </button>
                <button id="second_button">
                    <h3>編集完了</h3>
                </button>
            </div>
        </form>
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