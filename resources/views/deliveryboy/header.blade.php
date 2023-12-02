<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Delivery Boy</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/Assets')}}/admin/images/favicon.png">
    <!-- Pignose Calender -->
    <link href="{{asset('public/Assets')}}/admin/./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{asset('public/Assets')}}/admin/./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="{{asset('public/Assets')}}/admin/./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="{{asset('public/Assets')}}/admin/css/style.css" rel="stylesheet">

</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="{{url('deliveryboy/dashboard')}}">
                <b class="logo-abbr"><img src="{{asset('public/Assets')}}/admin/images/logo.png" alt=""> </b>
                <span class="logo-compact"><img src="{{asset('public/Assets')}}/admin/./images/logo-compact.png" alt=""></span>
                <span class="brand-title">
                        <img src="{{asset('public/Assets')}}/admin/images/demo-try.png" alt="">
                    </span>
            </a>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content clearfix">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
            <div class="header-right">
                <ul class="clearfix">
                    @php
                        $data=\DB::table('orders')->where('d_b_id',session()->get('deliveryboy.uid'))->get();
                        $c1=0;
                    @endphp
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="badge badge-pill gradient-2">{{(isset($data)?count($data):'0')}}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">{{(isset($data)?count($data):'0')}} New Orders</span>
                                <a href="javascript:void()" class="d-inline-block">
                                    <span class="badge badge-pill gradient-2">{{(isset($data)?count($data):'0')}}</span>
                                </a>
                            </div>
                            <div class="dropdown-content-body">
                                <ul>
                                    @foreach($data as $key=>$values)
                                            <li class="notification-unread">
                                                <a href="javascript:void()">
                                                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="fa fa-first-order"></i></span>
                                                    {{--<img class="float-left mr-3 avatar-img" src="{{asset('public/Assets')}}/admin/images/avatar/1.jpg" alt="">--}}
                                                    <div class="notification-content">
                                                        <div class="notification-heading">{{$values->o_name}}</div>
                                                        <div class="notification-timestamp">{{$values->o_date}}</div>
                                                        <div class="notification-text">{{$values->amount}}</div><br>
                                                    </div>
                                                </a>
                                                @php
                                                    $c1++;
                                                @endphp
                                            </li>
                                        @if($c1==3)
                                            @break
                                        @endif
                                    @endforeach
                                    <a href="{{url('deliveryboy')}}/orderlist"><button type="button" class="btn btn-primary btn-sm">View All</button></a>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown d-none d-md-flex">
                        <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                            Hi,{{session()->get('deliveryboy.name')}}
                        </a>
                    </li>

                    <li class="icons dropdown">

                        <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                            <span class="activity active"></span>
                            <i class="fa fa-2x fa-user-circle-o" aria-hidden="true" style="padding-top: 5px;"></i>
                            {{--<img src="{{asset('public/Assets')}}/admin/images/user/1.png" height="40" width="40" alt="">--}}
                        </div>

                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="{{url('deliveryboy')}}/profile"><i class="icon-user"></i> <span>Profile</span></a>
                                    </li>
                                    <li>
                                        <a href="{{url('deliveryboy')}}/changepassword"><i class="fa fa-unlock-alt"></i> <span>Change Password</span></a>
                                    </li>


                                    <hr class="my-2">
                                    {{--<li>--}}
                                    {{--<a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>--}}
                                    {{--</li>--}}
                                    <li><a href="{{url('deliveryboy')}}/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li>
                    <a class="has-arrow" href="{{url('deliveryboy')}}/dashboard" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('deliveryboy')}}/orderlist" aria-expanded="false">
                        <i class="fa fa-first-order"></i><span class="nav-text">OrderList</span>
                    </a>
                </li>



                <!-- </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-layers menu-icon"></i><span class="nav-text">Components</span>
                </a>
                <ul aria-expanded="false"> -->

            </ul>
        </div>
    </div>