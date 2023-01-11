<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>旅程表の登録完了</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/itinerary.css">

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
        <?php if($user_id == null): ?>
            <form method="post" action="/login" class="login">
                <?php echo csrf_field(); ?>
                <button type="submit"><p><i class="fa-solid fa-user">&emsp;ログイン</i></p></button>
            </form>
        <?php elseif($user_id == 1): ?>
            <form method="post" action="/mypage" class="login">
                <?php echo csrf_field(); ?>
                <button type="submit"><p><i class="fa-solid fa-user">&emsp;管理者ページ</i></p></button>
            </form>
        <?php else: ?>
            <form method="post" action="/mypage" class="login">
                <?php echo csrf_field(); ?>
                <button type="submit"><p><i class="fa-solid fa-user">&emsp;マイページ</i></p></button>
            </form>
        <?php endif; ?>
    </div>
    <div class="my_itinerary_complete_category">
        <ul>
            <li><h2>登録完了</h2></li>
            <li></li>
            <li>
                旅程表の登録が完了致しました。<br>
                下記ボタンにてトップページへ移動をお願い致します。
            </li>
            <li class="my_itinerary_button">
                <form method="POST" action="/index">
                    <?php echo csrf_field(); ?>   
                    <li><button type="submit" class="back_my_itinerary_button my_itinerary_button_right">トップへ戻る</button></li>
                </form>
            </li>
        </ul>
    </div>
    <?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
    </script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
</body>

</html><?php /**PATH /Applications/MAMP/htdocs/Travel/resources/views/itinerary/my_itinerary_complete.blade.php ENDPATH**/ ?>