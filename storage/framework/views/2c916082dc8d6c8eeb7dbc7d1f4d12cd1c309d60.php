<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>旅程表一覧</title>

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
    <div>
        <h1 class="administrator_title">旅程表情報一覧</h1>
        <div class="everyone_itinerary_category">
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h3>● <?php echo e($user->user_name); ?>さんの旅程表</h3>
                <div class="everyone_head">
                        <h3>ご旅行日&emsp;<?php echo e($user->tour_date); ?>&emsp;/&emsp;</h3>
                        <h3>ご旅行方面&emsp;<?php echo e($user->region_name); ?>&emsp;/&emsp;</h3>
                        <h3>都道府県&emsp;<?php echo e($user->area_name); ?></h3>
                    </div>
                <div>
                    
                    <table class="everyone_itinerary">
                        <tr>
                            <td>１日目：</td>
                            <td class="everyone_itinerary_item">【<?php echo e($user->departure_day1); ?>】</td>
                            <td>========</td>
                            <td class="everyone_itinerary_item">【<?php echo e($user->touristarea_num1); ?>】</td>
                            <td>========</td>
                            <td class="everyone_itinerary_item">【<?php echo e($user->touristarea_num2); ?>】</td>
                            <td>========</td>
                            <td class="everyone_itinerary_item">【<?php echo e($user->hotel_name); ?>】</td>
                        </tr>
                        <tr class="my_itinerary_content_delimiter"></tr>
                        <tr>
                            <td></td>
                            <td class="everyone_itinerary_headline">&nbsp;出発地</td>
                            <td></td>
                            <td class="everyone_itinerary_headline">&nbsp;観光地１</td>
                            <td></td>
                            <td class="everyone_itinerary_headline">&nbsp;観光地２</td>
                            <td></td>
                            <td class="everyone_itinerary_headline">&nbsp;宿泊場所</td>
                            <td></td>
                        </tr>
                        <tr class="my_itinerary_content_delimiter"></tr>
                        <tr>
                            <td>２日目：</td>
                            <td class="everyone_itinerary_item">【<?php echo e($user->departure_day2); ?>】</td>
                            <td>========</td>
                            <td class="everyone_itinerary_item">【<?php echo e($user->touristarea_num3); ?>】</td>
                            <td>========</td>
                            <td class="everyone_itinerary_item">【<?php echo e($user->touristarea_num4); ?>】</td>
                            <td>========</td>
                            <td class="everyone_itinerary_item">【<?php echo e($user->arrival); ?>】</td>
                        </tr>
                        <tr class="my_itinerary_content_delimiter"></tr>
                        <tr>
                            <td></td>
                            <td class="everyone_itinerary_headline">出発地</td>
                            <td></td>
                            <td class="everyone_itinerary_headline">観光地３</td>
                            <td></td>
                            <td class="everyone_itinerary_headline">観光地４</td>
                            <td></td>
                            <td class="everyone_itinerary_headline">到着地</td>
                        </tr>  
                    </table>
                    <div class="administrator_itinerary_back">
                        <form method="POST" action="/itinerary_delete">
                                <?php echo csrf_field(); ?>
                                <button id="delete_button" name="itinerary_id" value="<?php echo e($user->itinerary_id); ?>" onclick="return confirm('本当に削除しますか？')"><h3>削除</h3></button>
                            </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="administrator_itinerary_back back">
                <form method="POST" action="/mypage">
                    <?php echo csrf_field(); ?>
                    <button><h3>戻る</h3></button>
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

</html><?php /**PATH C:\xampp\htdocs\Travel\resources\views/administrator/itinerary_list.blade.php ENDPATH**/ ?>