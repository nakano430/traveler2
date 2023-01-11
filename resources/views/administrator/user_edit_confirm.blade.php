<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>変更内容の確認</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/administrator.css">

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

    <div class="administrator_user_confirm_category">
        <ul>
            <form method="post" action="/user_edit_complete">
                @CSRF
                <li>※変更内容をご確認ください※</li>
                <!--2-->
                <li></li>
                <!--3-->
                <li>以下の内容でご変更を致します</li>
                <!--4-->
                <li>お間違いなければ送信ボタンを押してください、修正をする場合は戻るボタンを押してください。
                </li>
                <!--5-->
                <li>
                    氏名 : <br>{{ $params['name'] }}
                    <input type="hidden" name="name" value="{{ $params['name'] }}">
                </li>
                <!--6-->
                <li>
                    メールアドレス : <br>{{ $params['email'] }}
                    <input type="hidden" name="email" value="{{ $params['email'] }}">
                </li>
                <!--7-->
                <li>
                    電話番号 : <br>{{ $params['tel'] }}
                    <input type="hidden" name="tel" value="{{ $params['tel'] }}">
                </li>
                <!--8-->
                <li>
                    住所 : <br>{{ $params['address'] }}
                    <input type="hidden" name="address" value="{{ $params['address'] }}">
                </li>
                <!--9-->
                <li class="button_form">
                    <button type="button" onclick="history.back()" class="back_button">戻る</button>
                    <button type="submit" class="submit_administrator_button">送信</button>
                </li>
                <!--10-->
            </form>
        </ul>
    </div>

    @include("include.footer")

</body>

</html>