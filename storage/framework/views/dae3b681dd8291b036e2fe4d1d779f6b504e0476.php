<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>新規会員登録</title>

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

    <div class="signup_category">
        <ul>
            <form method="post" action="signup_confirm">
                <?php echo csrf_field(); ?>
                <li>新規会員登録</li><!--2-->
                <li></li><!--3-->
                <li>下記の項目をご記入の上送信ボタンを押してください</li><!--4-->
                <li><span>*</span>は必須項目となります。</li><!--5-->
                <li>氏名<span>*</span>
                    <?php if($errors->has('name')): ?>
                        <br>
                        <p class="error-message"><?php echo e($errors->first('name')); ?></p>
                    <?php endif; ?>
                </li><!--6-->
                <li><input type="text" class="signup_form" name="name" placeholder="（ 10文字以内 ）" value="<?php echo e(old('name')); ?>"></li>
                <!--7-->
                <li>メールアドレス<span>*</span>
                    <?php if($errors->has('email')): ?>
                        <br>
                        <p class="error-message"><?php echo e($errors->first('email')); ?></p>
                    <?php endif; ?>
                </li><!--8-->
                <li><input type="text" class="signup_form" name="email" value="<?php echo e(old('email')); ?>"></li>
                <!--9-->
                <li>電話番号
                    <?php if($errors->has('tel')): ?>
                        <br>
                        <p class="error-message"><?php echo e($errors->first('tel')); ?></p>
                    <?php endif; ?>
                </li><!--10-->
                <li><input type="text" class="signup_form" name="tel" placeholder="（ 例：090-1234-5678 ） " value="<?php echo e(old('tel')); ?>"></li>
                <!--11-->
                <li>住所
                    <?php if($errors->has('address')): ?>
                        <br>
                        <p class="error-message"><?php echo e($errors->first('address')); ?></p>
                    <?php endif; ?>
                </li><!--12-->
                <li><input type="text" class="signup_form" name="address" placeholder="（ 例：愛知県名古屋市中村区名駅1-1-4 ）"  value="<?php echo e(old('address')); ?>"></li>
                <!--13-->
                <li>パスワード<span>*</span>
                    <?php if($errors->has('password1')): ?>
                        <br>
                        <p class="error-message"><?php echo e($errors->first('password1')); ?></p>
                    <?php endif; ?>
                </li><!--14-->
                <li><input type="password" class="signup_form" name="password1" placeholder="（ 6～10桁の英数字 ）"  value="<?php echo e(old('password1')); ?>"></li>
                <!--15-->
                <li>※もう1度入力する<span>*</span>
                    <?php if($errors->has('password2')): ?>
                        <br>
                        <p class="error-message"><?php echo e($errors->first('password2')); ?></p>
                    <?php endif; ?>
                </li><!--16-->
                <li><input type="password" class="signup_form" name="password2" value="<?php echo e(old('password2')); ?>"></li>
                <!--17-->
                <li id="signup_form_button">
                    <button type="button" onclick="history.back()" class="back_button">戻る</button>
                    <button type="submit"  class="submit_signup_button">送信</button>
                </li><!--18-->
            </form>
        </ul>
    </div>

    <?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH /Applications/MAMP/htdocs/Travel/resources/views/login/signup.blade.php ENDPATH**/ ?>