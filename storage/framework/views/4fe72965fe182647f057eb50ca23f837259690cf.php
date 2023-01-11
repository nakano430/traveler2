<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ログイン ・ 会員登録</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">

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
    <div id="login">
        <h1 id="login_title">ログイン</h1>
        <div id="login_category">
            <table>
                <tr>
                    <th class="login_category">
                        <h2>会員登録がお済みの方</h2>
                    </th>
                    <th></th>
                    <th class="login_category">
                        <h2>会員登録がお済み出ない方</h2>
                    </th>
                </tr>
                <tr>
                    <td class="login_form">
                        <form action="/mypage" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="login_detail">
                                <?php if($pw_chk == "no_user"): ?>
                                <h3 class="error-message">＊ユーザーが存在しません＊</h3>
                                <?php endif; ?>
                                <h3><span>■</span>メールアドレス</h3>
                                <input type="text" name="email" class="login_form" placeholder="exsample@gmail.com" value="<?php echo e(old('email')); ?>">
                                <h3><span>■</span>パスワード</h3>
                                <input type="password" name="password" class="login_form" placeholder="PASSWORD">
                            </div>
                            <div class="login_button">
                                <button type="submit">ログイン&emsp;&emsp;<i class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </form>
                        <form method="POST" action="/password_edit" class="password_button">
                            <?php echo csrf_field(); ?>
                            <button id="password_button"><h4>&emsp;パスワードを忘れた方はこちら&emsp;</h4></button>
                        </form>
                    </td>
                    <td class="login_form_delimiter"></td>
                    <td class="login_form login_signup">
                        <h3>ご予約の際には会員登録が必要になります</h3>
                        <h3>新規会員登録ボタンから会員登録にお進みください</h3>
                        <form action="/signup" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="signup_button"><button type="submit" onclick="sendPost(event)">新規会員登録&emsp;&emsp;<i class="fa-solid fa-chevron-right"></i></button></div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\traveler\traveler\resources\views/login/login.blade.php ENDPATH**/ ?>