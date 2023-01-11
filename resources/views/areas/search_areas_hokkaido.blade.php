<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>旅程表を作成</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/search_areas.css">

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
        <h1 class="search_title">地域からホテルを探す</h1>
        <table class="search_category">
            <tr>
                <td><img class="region_picture" src="img/area/{{ $params['region_english_name'] }}.jpg"></td>
                <td class="search_delimiter"></td>
                <td class="area_detail">
                    <h2>● {{ $params['region_name'] }}のおすすめ観光地</h2>
                    @php
                    $count_up = 1;
                    @endphp
                    @foreach($area as $area_info)
                    <form method="POST" action="/area_detail">
                        @CSRF
                        <table>
                            <tr>
                                <td>
                                    <h3><img class="area_picture" src="img/touristarea/{{ $area_info->english_name }}.jpg"></h3>
                                </td>
                                <td>
                                    <p>{{ $area_info->area_name }}</p>
                                    <button type="submit" name="area_name" value="{{ $area_info->area_name }}">詳細</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    @php
                    $count_up++;
                    if($count_up == 5){
                    break;
                    }
                    @endphp
                    @endforeach

                </td>
            </tr>
        </table>

        @foreach($hotel_info as $hotel)
        <div class="search_hotel_content">
            <table class="search_hotel_detail">
                <tr>
                    <td><img src="img/hotel/{{ $hotel->english_name }}.jpg" id="hotel_picture"></td>
                    <td>
                        <div class="search_hotel_info">
                            <h3>・{{ $hotel->name }}</h3>
                            <h3>
                                ・{{ $hotel->address }}
                                <input type="hidden" id="addressInput" value="{{ $hotel->address }}">
                            </h3>
                        </div>
                    </td>
                    <td>
                        <form method="POST" action="/hotel_detail">
                            @CSRF
                            <button type="submit">
                                <h3>詳細を見る</h3>
                            </button>
                            <input type="hidden" name="hotel_name" value="{{ $hotel->name }}">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        @endforeach

        <div class="search_hotels_back">
            <button type="button" onclick="history.back()" class="back_button">トップに戻る</button>
        </div>
    </div>
    </div>
    @include("include.footer")


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
    </script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
</body>

</html>