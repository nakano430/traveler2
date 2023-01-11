<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/cdebf06d40.js" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
</head>
<header>
    <div class="header">
        <a href="/index"><img src="./img/logo.png" class="logo"></a>

        @if(request()->is('profile*') || )

        @else
            <form method="post" action="/index" class="login">
                @csrf
                <button type="submit"><p><i class="fa-solid fa-user">&emsp;ログアウト</i></p></button>
                <input type="hidden" name="logout" value="true">
            </form>
        @endif

    </div>
    <div class="delimiter"></div>
</header>
