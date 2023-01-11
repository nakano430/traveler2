<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>管理者画面</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/administrator.css">

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

        <form method="post" action="/index" class="login">
            <?php echo csrf_field(); ?>
            <button type="submit">
                <p><i class="fa-solid fa-user">&emsp;ログアウト</i></p>
            </button>
            <input type="hidden" name="logout" value="true">
        </form>
    </div>
    <div class="administrator_category">
        <h1 class="administrator_title">管理者ページ</h1>
        <div class="administrator_content">
            <form method="POST" action="/user_list">
                <?php echo csrf_field(); ?>
                <button type="submit"><h2>ユーザー情報一覧へ</h2></button>
            </form>
        </div>
        <div class="administrator_content">
            <form method="POST" action="/itinerary_list">
                <?php echo csrf_field(); ?>
                <button type="submit"><h2>旅程表情報一覧へ</h2></button>
            </form>
        </div>
        <div class="administrator_content">
            <form method="POST" action="/touristarea_list">
                <?php echo csrf_field(); ?>
                <button type="submit"><h2>観光地情報一覧へ</h2></button>
            </form>
        </div>
        <div class="administrator_content last_of_list">
            <form method="POST" action="/hotel_list">
                <?php echo csrf_field(); ?>
                <button type="submit"><h2>ホテル情報一覧へ</h2></button>
            </form>
        </div>

    </div>


    </div>
    <?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
    </script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
</body>

</html><?php /**PATH /Applications/MAMP/htdocs/Travel/resources/views/administrator/administrator.blade.php ENDPATH**/ ?>