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

    <title>Add New Reservation</title>

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
            <a class="navbar-brand" href="JavaScript:void(0)">
                <b>New Reservation</b>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="nav">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/dashboard">Reservation</a>
                </li>
                <li>
                    <a href="/dashboard/check_in">Check in</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li> <a href="#" style="cursor:default">The Carnival lasts for {{$carnival_days}} days</a> </li>
                <li> <a href="#"  style="cursor:default"> Today is The {{$current_day}} day</a> </li>
                <li>
                    <a href="JavaScript:void(0)" style="cursor:default">Login user: {{$name}} </a>
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
            @if($count>=3)
                <h3>You have had 3 reservations, to reserve another day, you need to cancel an old one.</h3>
            @elseif($carnival_days==$current_day)
                <h3>Today is the last day of the festival, please pay attention to the next event.</h3>
            @else
                <form method="POST" class="form-horizontal" action="/reservation/add">
                @csrf
                    <div class="form-group">
                        <select name="rsv_day_at"  class="form-control" style="height: 45px;font-size: 20px">
                            @php
                                for($i=$current_day+1;$i<=$carnival_days;$i++){
                                $days = $i-$current_day." day";
                                $date = date("Y-m-d",strtotime($days));
                                 echo '<option value="'.$i.'" >'.$date.'</option>';
                                }
                            @endphp
                        </select>
                    </div>
                    <div class="form-group" style="margin-top: 40px;">
                        <input type="submit" id="reserve" value="Reserve" class="btn btn-lg btn-primary">
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
</body>

</html>

