<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>観光地一覧</title>

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
        <h1 class="administrator_title">観光地情報一覧</h1>


        <div class="administrator_user_category">

            <div class="administrator_user_content">
                <table>
                    <tr>
                        <th></th>
                        <th>
                            <h3>・地方</h3>
                        </th>
                        <th>
                            <h3>・地域</h3>
                        </th>
                        <th>
                            <h3>・観光地名</h3>
                        </th>
                        <th>
                            <h3>・ジャンル</h3>
                        </th>
                        <th>
                            <h3>・住所</h3>
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php $__currentLoopData = $area_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <h3><?php echo e($area->id); ?></h3>
                        </td>
                        <td class="region_area">
                            <h3>&ensp;<?php echo e($area->region); ?></h3>
                        </td>
                        <td class="region_area">
                            <h3>&ensp;<?php echo e($area->area); ?></h3>
                        </td>
                        <td>
                            <h3>&ensp;<?php echo e($area->name); ?></h3>
                        </td>
                        <td>
                            <h3>&ensp;<?php echo e($area->genre); ?></h3>
                        </td>
                        <td>
                            <h3>&ensp;<?php echo e($area->address); ?></h3>
                        </td>
                        <td></td>
                        <td>
                            <form method="POST" action="/touristarea_edit">
                                <?php echo csrf_field(); ?>
                                <button name="area_id" value="<?php echo e($area->id); ?>">
                                    <h3>編集</h3>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="/touristarea_delete">
                                <?php echo csrf_field(); ?>
                                <button id="delete_button" name="touristarea_id" value="<?php echo e($area->id); ?>" onclick="return confirm('本当に削除しますか？')">
                                    <h3>削除</h3>
                                </button>                            
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>

            <div class="administrator_user_back">
                <form method="POST" action="/mypage">
                    <?php echo csrf_field(); ?>
                    <button>
                        <h3>戻る</h3>
                    </button>
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

</html><?php /**PATH C:\xampp\htdocs\traveler\resources\views/administrator/touristarea_list.blade.php ENDPATH**/ ?>