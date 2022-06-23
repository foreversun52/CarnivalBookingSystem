<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--jquery-->
    <script src="js/jquery.min.js"></script>
    <!-- The latest version of Bootstrap core CSS file -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <!-- The latest Bootstrap core JavaScript file -->
    <script src="js/bootstrap.min.js"></script>

    <style>

    </style>
    <title>Carnival Booking System</title>
</head>
<body class="antialiased">
    <div class="container text-center">
        <!-- 如果存在登录路由 -->
        <!-- If a login route exists -->
        @if (Route::has('login'))
            <div class="back-box">
                <!-- 判断当前是否已经登录 -->
                <!-- Judge whether you have logged in -->
                @auth
                    <!-- 如果已经登录显示的是去往dashboard的按钮 -->
                    <!-- If you have logged in, the button to dashboard is displayed -->
                    <h3 style="color: green">Login in!</h3>
                    <h3>Click to enter Dashboard!</h3>
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                @else
                    <!-- 如果没有登录显示的是去往登录界面的按钮 -->
                    <!-- If there is no login, the button to the login interface is displayed -->
                    <h3 style="color: red">Not Login in!</h3>
                    <h3>Click to enter Login!</h3>
                    <a href="{{ route('login') }}" class="btn btn-primary" style="width: 70%;margin-top: 30px;margin-left: 0">Login</a>
                @endauth
            </div>
        @endif
    </div>

</body>

</html>

