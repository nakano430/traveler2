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

        <form method="post" action="/index" class="login">
            <?php echo csrf_field(); ?>
            <button type="submit">
                <p><i class="fa-solid fa-user">&emsp;ログアウト</i></p>
            </button>
            <input type="hidden" name="logout" value="true">
        </form>
    </div>

    <div class="password_reset_category">
        <ul>
            <form method="POST" action="/password_reset_send">
                <?php echo csrf_field(); ?>
                <li>
                    <h2>パスワードの変更</h2>
                </li>
                <!--2-->
                <li></li>
                <!--3-->
                <li>
                    
                    <h3>● 現在のパスワードをご入力ください</h3>
                    <?php if($errors->has('now_password')): ?>
                    <p class="error-message">&ensp;<?php echo e($errors->first('now_password')); ?></p>
                    <?php endif; ?>
                    <?php if($error == false): ?>
                    <p class="error-message">&ensp;パスワードが違います</h3>
                    <?php endif; ?>

                </li>
                <!--4-->
                <li><input type="password" class="password_reset_form" name="now_password"></li>
                <!--5-->
                <li>
                    <h3>● 新しいパスワードをご入力ください</h3>
                    <?php if($errors->has('new_password1')): ?>
                    <p class="error-message">&ensp;<?php echo e($errors->first('new_password1')); ?></p>
                    <?php endif; ?>
                </li>
                <!--6-->
                <li><input type="password" class="password_reset_form" name="new_password1"></li>
                <!--7-->
                <li>
                    <h3>● もう一度ご入力ください</h3>
                    <?php if($errors->has('new_password2')): ?>
                    <p class="error-message">&ensp;<?php echo e($errors->first('new_password2')); ?></p>
                    <?php endif; ?>
                </li>
                <!--8-->
                <li><input type="password" class="password_reset_form" name="new_password2"></li>
                <!--9-->
                <li class="password_reset_button_form" id="top_delimiter">
                    <button class="password_reset_button">送信する</button>
                </li>
                <!--10-->
            </form>
            <form method="POST" action="/mypage">
                <?php echo csrf_field(); ?>
                <!--11-->
                <li>
                    <button type="submit" class="password_reset_button" id="bottom_delimiter" name="back">マイページへ戻る</button>
                </li>
                <!--12-->
            </form>
        </ul>
    </div>

    <?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\Travel\resources\views/mypage/password_reset.blade.php ENDPATH**/ ?>