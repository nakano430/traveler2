<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>削除完了</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/mypage.css">

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

        <form method="post" action="/index" class="login">
            <?php echo csrf_field(); ?>
            <button type="submit">
                <p><i class="fa-solid fa-user">&emsp;ログアウト</i></p>
            </button>
            <input type="hidden" name="logout" value="true">
        </form>
    </div>

<div class="profile_complete_category">
    <form method="POST" action="/touristarea_list">
        <ul>
        <?php echo csrf_field(); ?>
            <li><h2>削除完了</h2></li>
            <li></li>
            <li>
                観光地情報の削除が完了致しました。<br>
                "観光地情報一覧へ戻る"ボタンにてお戻りください。
            </li>
            <li><button type="submit" class="back_login_button">観光地情報一覧へ戻る</button></li>

        </ul>
    </form>
</div>

<?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\Travel\resources\views/delete/touristarea_delete.blade.php ENDPATH**/ ?>