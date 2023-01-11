<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>登録情報の確認</title>

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

    <div class="signup_confirm_category">
        <ul>
            <form method="post" action="/signup_complete">
            <?php echo csrf_field(); ?>
                <li>※登録内容をご確認ください※</li><!--2-->
                <li></li><!--3-->
                <li>以下の内容でご登録を致します</li><!--4-->
                <li>お間違いなければ送信ボタンを押してください、修正をする場合は戻るボタンを押してください。
                </li><!--5-->
                <li>
                    氏名 : <br><?php echo e($params['name']); ?>

                    <input type="hidden" class="signup_confirm_form" name="name" value="<?php echo e($params['name']); ?>">
                </li><!--6-->
                <li>
                    メールアドレス : <br><?php echo e($params['email']); ?>

                    <input type="hidden" class="signup_confirm_form" name="email" value="<?php echo e($params['email']); ?>">
                </li><!--7-->
                <li>
                    電話番号 : <br><?php echo e($params['tel']); ?>

                    <input type="hidden" class="signup_confirm_form" name="tel" value="<?php echo e($params['tel']); ?>">
                </li><!--8-->
                <li>
                    住所 : <br><?php echo e($params['address']); ?>

                    <input type="hidden" class="signup_confirm_form" name="address" value="<?php echo e($params['address']); ?>">
                </li><!--9-->
                <li>
                    パスワード : <br>
                    <?php for($i = 0; $i < mb_strlen($params['password']); $i++): ?>
                        ●
                        <input type="hidden" class="signup_confirm_form" name="password" value="<?php echo e($params['password']); ?>">
                    <?php endfor; ?>
                </li><!--10-->
                <li id="signup_confirm_form_button">
                    <button type="button" onclick="history.back()" class="back_button" name="back">戻る</button>
                    <button type="submit"  class="submit_signup_button">送信</button>
                </li><!--11-->
            </form>
        </ul>
    </div>

    <?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\Travel\resources\views/login/signup_confirm.blade.php ENDPATH**/ ?>