<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/cdebf06d40.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
</head>
<header>
    <div class="header">
        <?php if($user_name == false): ?>
        <form method="post" action="/login" class="login">
            <?php echo csrf_field(); ?>
            <button type="submit">
                <p><i class="fa-solid fa-user">&emsp;ログイン</i></p>
            </button>
        </form>
        <?php else: ?>
        <form method="post" action="/mypage" class="login">
            <?php echo csrf_field(); ?>
            <button type="submit">
                <p><i class="fa-solid fa-user">&emsp;マイページ</i></p>
            </button>
        </form>
        <?php endif; ?>
    </div>
    <div class="delimiter"></div>
</header><?php /**PATH /Applications/MAMP/htdocs/Travel/resources/views/include/header.blade.php ENDPATH**/ ?>