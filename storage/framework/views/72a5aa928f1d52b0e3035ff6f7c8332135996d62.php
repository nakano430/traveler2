<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>観光地詳細</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/detail.css">

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
        <h1 class="detail_title"><?php echo e($area_info->name); ?></h1>
        <table class="detail_category">
            <tr>
                <td><img class="hotel_picture" src="img/touristarea/<?php echo e($area_info->english_name); ?>.jpg"></td>
                <td class="detail_delimiter"></td>
                <td class="area_detail">
                    <h2>● 観光地詳細</h2>
                    <h3><i class="fa-solid fa-location-dot">&emsp;<?php echo e($area_info->address); ?></i></h3>
                    <h3><i class="fa-solid fa-phone">&emsp;<?php echo e($area_info->genre); ?></i></h3>
                    <h3><i class="fa-solid fa-money-check-dollar">&emsp;<?php echo e($area_info->detail); ?></i></h3>
                    

                </td>
            </tr>
        </table>

        <div id="map" class="map"></div>


        <div class="search_hotels_back">
            <button type="button" onclick="history.back()" class="back_button">戻る</button>
        </div>
    </div>
    </div>
    <?php echo $__env->make("include.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <script type="text/javascript" src="./js/script.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWK8nttzmmyqp95LfzcGc0A4bBXJ-cz0Q&callback=initMap"></script>

    <script type="text/javascript">
        var address = '<?php echo e($area_address); ?>';
        // Google Mapを表示する関数
        function initMap() {
            const geocoder = new google.maps.Geocoder();
            // ここでaddressのvalueに住所のテキストを指定する
            console.log(address);
            geocoder.geocode({
                address: address
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const latlng = {
                        lat: results[0].geometry.location.lat(),
                        lng: results[0].geometry.location.lng()
                    }
                    const opts = {
                        zoom: 15,
                        center: new google.maps.LatLng(latlng)
                    }
                    const map = new google.maps.Map(document.getElementById('map'), opts)
                    new google.maps.Marker({
                        position: latlng,
                        map: map
                    })
                } else {
                    console.error('Geocode was not successful for the following reason: ' + status)
                }
            })
        }
    </script>

</body>

</html><?php /**PATH C:\xampp\htdocs\traveler\resources\views/areas/area_detail.blade.php ENDPATH**/ ?>