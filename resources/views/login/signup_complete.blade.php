<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>登録完了</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/login.css">

	<link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  	<link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/cdebf06d40.js" crossorigin="anonymous"></script>
    
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
</head>

<body>

    <div class="header">
        <a href="/index"><img src="./img/logo.png" class="logo"></a>
    </div>

    <div class="signup_complete_category">
        <form method="POST" action="/login">
            <ul>
                @CSRF
                <li><h2>登録完了</h2></li>
                <li></li>
                <li>
                    ユーザーの登録が完了致しました。<br>
                    "ログインへ戻る"ボタンにてログイン画面にお戻り頂きログインをお願い致します。
                </li>
                <li><button type="submit" class="back_login_button">ログインへ戻る</button></li>
            </ul>
    </form>
</div>

@include("include.footer")

</body>
</html>