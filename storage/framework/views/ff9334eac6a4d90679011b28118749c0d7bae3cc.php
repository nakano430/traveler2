<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>旅程表を作成</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/itinerary.css">

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
    <div>
        <h1 class="my_itinerary_title">旅程表を作成する</h1>
        <div class="my_itinerary_category">
            <form method="POST" action="/my_itinerary_complete">
                <?php echo csrf_field(); ?>
                <table class="my_itinerary_search">
                    <tr>
                        <td>
                            <h3>
                                ご旅行日&emsp;<?php echo e($params['travel_day']); ?>

                                <input type="hidden" name="travel_day" value="<?php echo e($params['travel_day']); ?>">
                            </h3>
                        </td>
                        <td class="my_itinerary_delimiter"></td>
                        <td>
                            <h3>
                                ご旅行方面&emsp;<?php echo e($params['region']); ?>

                                <input type="hidden" name="region" value="<?php echo e($params['region']); ?>">
                            </h3>
                        </td>
                        <td class="my_itinerary_delimiter"></td>
                        <td>
                            <h3>
                                都道府県&emsp;<?php echo e($params['prefecture']); ?>

                                <input type="hidden" name="prefecture" value="<?php echo e($params['prefecture']); ?>">
                            </h3>
                        </td>
                    </tr>
                </table>

                <table class="my_itinerary_content">
                    <tr>
                        <th>１日目：</th>
                        <th><input type="text" name="departure_day1" placeholder="入力してください"></th>
                        <th>========</th>
                        <th>
                            <select name="tourist_area_id1">
                                <option value="null">選択してください</option>
                                <?php $__currentLoopData = $touristarea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($area->name); ?>"><?php echo e($area->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                        <th>========</th>
                        <th>
                            <select name="tourist_area_id2" value="<?php echo e(old('tourist_area_id2')); ?>">>
                                <option value="">選択してください</option>
                                <?php $__currentLoopData = $touristarea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($area->name); ?>"><?php echo e($area->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                        <th>========</th>
                        <th>
                            <select name="selected_hotel" value="<?php echo e(old('selected_hotel')); ?>">>
                                <option value="">選択してください</option>
                                <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option><?php echo e($hotel["name"]); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                    </tr>

                    <tr class="my_itinerary_content_delimiter"></tr>
                    <tr>
                        <td></td>
                        <td>出発地</td>
                        <td></td>
                        <td>観光地１</td>
                        <td></td>
                        <td>観光地２</td>
                        <td></td>
                        <td>宿泊場所</td>
                    </tr>
                    <tr class="my_itinerary_content_delimiter"></tr>
                    <tr>
                        <th>２日目：</th>
                        <th><input type="text" name="departure_day2" placeholder="入力してください"></th>
                        <th>========</th>
                        <th>
                            <select name="tourist_area_id3">
                                <option value="">選択してください</option>
                                <?php $__currentLoopData = $touristarea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($area->name); ?>"><?php echo e($area->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                        <th>========</th>
                        <th>
                            <select name="tourist_area_id4">
                                <option value="">選択してください</option>
                                <?php $__currentLoopData = $touristarea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($area->name); ?>"><?php echo e($area->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                        <th>========</th>
                        <th><input type="text" name="arrival" placeholder="入力してください"></th>
                    </tr>
                    <tr class="my_itinerary_content_delimiter"></tr>
                    <tr>
                        <td></td>
                        <td>出発地</td>
                        <td></td>
                        <td>観光地３</td>
                        <td></td>
                        <td>観光地４</td>
                        <td></td>
                        <td>到着地</td>
                    </tr>
                </table>
                <?php if(isset($user_id)): ?>
                <div class="my_itinerary_submit_back">
                    <a href="/index" id="back_button" class="my_itinerary_submit first_button"><button type="button" class="my_itinerary_submit first_button">戻る</button></a>
                    <button type="submit" class="my_itinerary_submit" id="save_itinerary">この内容で保存する</button>
                </div>
                <?php else: ?>
                <div class="my_itinerary_submit_back">
                    <a href="/index" id="back_button" class="my_itinerary_submit first_button"><button type="button" class="my_itinerary_submit first_button">戻る</button></a>
                </div>
                <?php endif; ?>

            </form>
        </div>

        <div class="hotels_category">
            <h1 class="my_itinerary_title">観光地</h1>
            <div class="my_itinerary_hotel">
                <?php $__currentLoopData = $touristarea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <table>
                    <tr>
                        <td class="tourist_picture"><img src="img/touristarea/<?php echo e($area['english_name']); ?>.jpg"></td>
                        <td class="hotel_detail">
                            <h4><?php echo e($area['name']); ?></h4>
                            <h5><?php echo e($area['address']); ?></h5>
                            <form method="POST" action="/area_detail">
                                <?php echo csrf_field(); ?>
                                <button type="submit" name="area_name" value="<?php echo e($area['name']); ?>">観光地の詳細を見る</button>
                            </form>
                        </td>
                    </tr>
                </table>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="hotels_category">
            <h1 class="my_itinerary_title">ホテル</h1>
            <div class="my_itinerary_hotel">
                <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <table>
                    <tr>
                        <td class="hotel_picture"><img src="img/hotel/<?php echo e($hotel['english_name']); ?>.jpg"></td>
                        <td class="hotel_detail">
                            <h4><?php echo e($hotel['name']); ?></h4>
                            <h5><?php echo e($hotel['address']); ?></h5>
                            <h5><?php echo e($hotel['tel']); ?></h5>
                            <form method="POST" action="/hotel_detail">
                                <?php echo csrf_field(); ?>
                                <button type="submit" name="hotel_name" value="<?php echo e($hotel['name']); ?>">ホテルの詳細を見る</button>
                            </form>
                        </td>
                    </tr>
                </table>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="my_itinerary_submit_back">
            <a href="/index"><button type="button" class="my_itinerary_submit second_button">戻る</button></a>
        </div>
    </div>
    <?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
    </script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
</body>

</html><?php /**PATH /Applications/MAMP/htdocs/Travel/resources/views/itinerary/my_itinerary.blade.php ENDPATH**/ ?>