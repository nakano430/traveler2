<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>パスワードリセット</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mypage.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/cdebf06d40.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
</head>

<body>
    <div class="header">
        <a href="/index"><img src="./img/logo.png" class="logo"></a>
    </div>

    <div class="password_reset_category">
        <ul>
            <form method="post" action="/password_edit_input">
                @CSRF
                <li>
                    <h2>パスワードリセット</h2>
                </li>
                <!--2-->
                <li><h3>※新しいパスワードをご入力ください※</h3></li>
                <!--3-->
                <li>
                    <h3>● お名前をご入力ください</h3>
                   
                </li>
                <!--4-->
                <li><input type="text" class="password_reset_form" name="name"></li>
                <!--5-->
                <li>
                    <h3>● メールアドレスをご入力ください</h3>
                   
                </li>
                <!--6-->
                <li><input type="text" class="password_reset_form" name="email"></li>
                <!--7-->
                <li>
                    <h3>● 電話番号をご入力ください</h3>
            
                </li>
                <!--8-->
                <li><input type="text" class="password_reset_form" name="tel"></li>
                <!--9-->
                <li class="password_reset_button_form" id="top_delimiter">
                    <button type="submit" class="password_reset_button">送信する</button>
                </li>
                <!--10-->
            </form>
            <form method="POST" action="/mypage">
                @CSRF
                <!--11-->
                <li>
                    <button type="submit" class="password_reset_button" id="bottom_delimiter" name="back">マイページへ戻る</button>
                </li>
                <!--12-->
            </form>
        </ul>
    </div>

    @include("include.footer")

</body>

</html>