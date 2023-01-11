<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>旅程表を作成</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/search_hotels.css">

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
    </div>
    <div>
        <h1 class="search_title">条件からホテルを探す</h1>
        <div class="search_category">
            <h2>●　検索条件</h2>
        </div>
        <div class="search_category conditions_background">
            <table class="search_hotel_conditions">
                <tr>
                    <td>
                        <?php if($params['lodging_area'] != ""): ?>
                        <h3>宿泊地&emsp;<?php echo e($params['lodging_area']); ?></h3>
                        <?php else: ?>
                        <h3>宿泊地&emsp; －</h3>
                        <?php endif; ?>
                    </td>
                    <td class="search_delimiter">/</td>

                    <td>
                        <?php if($params['hotel_name'] != ""): ?>
                        <h3>ホテル名&emsp;<?php echo e($params['hotel_name']); ?></h3>
                        <?php else: ?>
                        <h3>ホテル名&emsp; －</h3>
                        <?php endif; ?>
                    </td>
                    <td class="search_delimiter">/</td>
                    <td>
                        <?php if($params['room_type'] != ""): ?>
                        <h3>部屋タイプ&emsp;<?php echo e($params['room_type']); ?></h3>
                        <?php else: ?>
                        <h3>部屋タイプ&emsp; －</h3>
                        <?php endif; ?>
                    </td>
                    <td class="search_delimiter">/</td>

                </tr>
            </table>
        </div>


        <?php if(empty($hotel_info)): ?>
        <div class="search_hotel_content">
            <h3>ホテル情報がありません</h3>
        </div>
        <?php else: ?>
        <?php $__currentLoopData = $hotel_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="search_hotel_content">
            <table class="search_hotel_detail">
                <tr>
                    <td><img src="img/hotel/<?php echo e($hotel->english_name); ?>.jpg" id="hotel_picture"></td>
                    <td>
                        <div class="search_hotel_info">
                            <h3>・<?php echo e($hotel->name); ?></h3>
                            <?php if($with_room): ?>
                            <h3>・<?php echo e($hotel->roomtype); ?> / <?php echo e($hotel->price); ?>円（一人当たり）</h3>
                            <?php endif; ?>
                            <h3>・<?php echo e($hotel->address); ?></h3>
                        </div>
                    </td>
                    <td>
                        <form method="POST" action="/hotel_detail">
                            <?php echo csrf_field(); ?>
                            <button type="submit">
                                <h3>詳細を見る</h3>
                            </button>
                            <input type="hidden" name="hotel_name" value="<?php echo e($hotel->name); ?>">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div class="search_hotels_back">
            <button type="button" onclick="history.back()" class="back_button">トップに戻る</button>
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

</html><?php /**PATH /Applications/MAMP/htdocs/Travel/resources/views/hotels/search_hotels.blade.php ENDPATH**/ ?>