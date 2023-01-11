<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>マイページ</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mypage.css">

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
    <div class="mypage">
        <div class="user">
            <h2 id="login_title"><i class="fa-solid fa-circle-user mypage_icon">&ensp;プロフィール</i></h2>
            <table class="user_profile">
                <tr>
                    <th class="user_profile_item">
                        <h3>● 氏名</h3>
                        <h3>● 電話番号</h3>
                        <h3>● 住所</h3>
                        <h3>● メールアドレス</h3>
                    </th>
                    <td id="user_profile_item">
                        <h3>&ensp;{{ $user['name'] }}</h3>
                        <h3>&ensp;{{ $user['tel'] }}</h3>
                        <h3>&ensp;{{ $user['address'] }}</h3>
                        <h3>&ensp;{{ $user['email'] }}</h3>
                    </td>

                </tr>
            </table>
        </div>
        <div class="mypage_button">
            <form action="/profile" method="POST">
                @CSRF
                <button>
                    <h3><i class="fa-solid fa-briefcase">&ensp;プロフィールを編集</i></h3>
                </button>
            </form>

            <form action="/password_reset" method="POST">
                @CSRF
                <button>
                    <h3><i class="fa-solid fa-key">&ensp;パスワード変更</i></h3>
                </button>
            </form>
        </div>
        <div class="mypage_itinerary_list">
            <h2><i class="fa-solid fa-list mypage_icon">&ensp;作成した旅程表一覧</i></h2>
            <div class="everyone_itinerary_category">
                @if(isset($result))
                <h2 id="itinerary_is_none">作成した旅程表がありません</h2>
                @else
                @foreach($has_itinerary as $item)
                <div class="my_itinerary_list_head">
                    <h3>● ご旅行日：{{ $item->tour_date }}&emsp;/&emsp;</h3>
                    <h3>ご旅行方面：{{ $item->region_name }}&emsp;/&emsp;</h3>
                </div>
                <table class="my_itinerary_list_content">
                    <tr>
                        <td>１日目：</td>
                        <td class="my_itinerary_list_item">【{{ $item->departure_day1 }}】</td>
                        <td>========</td>
                        <td class="my_itinerary_list_item">【{{ $item->touristarea_num1 }}】</td>
                        <td>========</td>
                        <td class="my_itinerary_list_item">【{{ $item->touristarea_num2 }}】</td>
                        <td>========</td>
                        <td class="my_itinerary_list_item">【{{ $item->hotel_name }}】</td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td></td>
                        <td class="my_itinerary_list_headline">出発地</td>
                        <td></td>
                        <td class="my_itinerary_list_headline">観光地１</td>
                        <td></td>
                        <td class="my_itinerary_list_headline">観光地２</td>
                        <td></td>
                        <td class="my_itinerary_list_headline">宿泊場所</td>
                        <td></td>
                    </tr>
                    <tr class="my_itinerary_list_delimiter"></tr>
                    <tr>
                        <td>２日目：</td>
                        <td class="my_itinerary_list_item">【{{ $item->departure_day2 }}】</td>
                        <td>========</td>
                        <td class="my_itinerary_list_item">【{{ $item->touristarea_num3 }}】</td>
                        <td>========</td>
                        <td class="my_itinerary_list_item">【{{ $item->touristarea_num4 }}】</td>
                        <td>========</td>
                        <td class="my_itinerary_list_item">【{{ $item->arrival }}】</td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td></td>
                        <td class="my_itinerary_list_headline">出発地</td>
                        <td></td>
                        <td class="my_itinerary_list_headline">観光地３</td>
                        <td></td>
                        <td class="my_itinerary_list_headline">観光地４</td>
                        <td></td>
                        <td class="my_itinerary_list_headline">到着地</td>
                    </tr>
                </table>
                <br>
                @endforeach
                @endif
                </br>
            </div>
        </div>
        @include("include.footer")
</body>

</html>