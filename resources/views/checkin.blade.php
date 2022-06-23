<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--jquery-->
    <script src="../js/jquery.min.js"></script>
    <!-- The latest version of Bootstrap core CSS file -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- The latest Bootstrap core JavaScript file -->
    <script src="../js/bootstrap.min.js"></script>


    <title>Check in</title>

</head>
<body class="antialiased">
{{--    top navbar--}}
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/dashboard">
                <b>Dashboard</b>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="nav">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/dashboard">Reservation</a>
                </li>
                <li  class="active">
                    <a href="/dashboard/check_in">Check in</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li> <a href="#" style="cursor:default">The Carnival lasts for {{ $carnival_days }} days</a> </li>
                <li> <a href="#"  style="cursor:default"> Today is The {{ $current_day }} day</a> </li>
                <li>
                    <a href="JavaScript:void(0)" style="cursor:default">Login user: {{ $name }} </a>
                </li>
                <li>
                    <a href="/logout">Log out</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
{{--    reservation info--}}
<div class="container">
    <div class="container-fluid">
        <div class="back-box">
                <form method="POST" class="form-horizontal" action="/reservation/checkin">
                    @csrf
                    <div class="form-group">
                        <label for="ivtcd">Invitation Code</label>
                        <input type="text" id="ivtcd" class="form-control" name="ivtcd" placeholder="please enter your invitation code" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your Invitation Code with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="please enter your password">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="reserve" value="Check In" class="btn btn-primary">
                    </div>
                </form>
        </div>
    </div>
</div>
</body>

</html>

