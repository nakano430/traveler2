<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>観光地情報編集</title>

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
        <h1 class="administrator_title">観光地情報編集</h1>

        <form method="POST" action="/touristarea_edit_complete">
            @CSRF
            <h1 class="detail_title">
                <input type="text" name="touristarea_name" class="name_box" value="{{ $results->name }}">
            </h1>
            @if ($errors->has('name'))
            <br>
            <p class="error-message">{{ $errors->first('name') }}</p>
            @endif<table class="detail_category">
                <tr>
                    <td><img class="hotel_picture" src="img/touristarea/{{ $results->english_name }}.jpg"></td>
                    <td class="detail_delimiter"></td>
                    <td class="area_detail">
                        <h2>● 観光地詳細</h2>

                        <h3><i class="fa-solid fa-location-dot">&emsp;<input type="text" name="address" class="input_box" value="{{ $results->address }}"></i></h3>
                        @if ($errors->has('address'))
                        <br>
                        <p class="error-message">{{ $errors->first('address') }}</p>
                        @endif

                        <h3><i class="fa-solid fa-cable-car"></i>&emsp;<input type="text" name="genre" class="input_box" value="{{ $results->genre }}"></i></h3>
                        @if ($errors->has('genre'))
                        <br>
                        <p class="error-message">{{ $errors->first('genre') }}</p>
                        @endif

                        <h3><textarea name="detail">{!! nl2br(e($results->detail)) !!}</textarea></h3>
                        @if ($errors->has('detail'))
                        <br>
                        <p class="error-message">{{ $errors->first('detail') }}</p>
                        @endif
                        <input type="hidden" name="id" value="{{ $results->id }}">
                    </td>
                </tr>
            </table>
        
            <div id="map" class="map"></div>

            <div class="administrator_touristarea_back">
                <button type="button" onclick="history.back()" class="back_button"><h3>戻る</h3></button>
                <button id="second_button"><h3>編集完了</h3></button>
            </div>
        </form>
    </div>
    @include("include.footer")

    </div>
    </div>
    @include("include.footer")


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <script type="text/javascript" src="./js/script.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWK8nttzmmyqp95LfzcGc0A4bBXJ-cz0Q&callback=initMap"></script>

    <script type="text/javascript">
        var address = '{{$area_address}}';
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