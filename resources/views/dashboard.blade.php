<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--jquery-->
    <script src="js/jquery.min.js"></script>
    <!-- The latest version of Bootstrap core CSS file -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- The latest Bootstrap core JavaScript file -->
    <script src="js/bootstrap.min.js"></script>



    <title>Dashboard</title>

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
                    <b>Dashboard</b>
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
                        <a href="#" style="cursor:default">Login user: {{$name}} </a>
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
            <div style="width:100%;" class="center-block">
                <button onclick="location.replace('/dashboard/add_reservation')" class="btn btn-primary">Add New Reservation</button>
            </div>
            <table class="table table-bordered table-hover text-center" style="margin-top:20px;">
                <thead>
                <tr style="font-size: 22px">
                    <th class="text-center">Reservation Date</th>
                    <th class="text-center">Invitation Code</th>
                    <th class="text-center" style="width: 200px;">Invitation Status</th>
                </tr>
                </thead>
                <tbody>
                @if(empty($data_list->toArray()))
                    <tr>
                        <td colspan="3">No Reservation Yet.</td>
                    </tr>
                @else
                    @foreach ($data_list as $data)
                        <tr style="font-size: 20px">
                            <td>@php
                                $days = $data->reserve_date_at - $current_day." day";
                                $date = date("Y-m-d",strtotime($days));
                                echo $date;
                            @endphp
                            </td>
                            <td>{{$data->invitation}}</td>
                            @if($current_day>$data->reserve_date_at)
                                <td class="danger">Passed</td>
                            @elseif($data->checkin==1)
                                <td class="success">Verified</td>
                            @else
                                <td><button class="btn btn-warning" onclick="location.replace('/reservation/cancel?ivtcd={{$data->invitation}}')">Cancel</button></td>
                            @endif
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

