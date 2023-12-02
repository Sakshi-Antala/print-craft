<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Agency</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/Assets')}}/admin/images/favicon.png">
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
            <a href="{{url('agency/dashboard')}}">
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
                    $data=\DB::table('products')->join('order_details','order_details.pid','=','products.pid')
                    ->join('orders','orders.o_id','order_details.o_id')->select('orders.*',\DB::raw('count(products.pid)'))
                    ->groupBy('orders.o_id')
                    ->where('products.uid',session()->get('agency.uid'))->get();
                    $count=0;
                    $c1=0;
                    foreach ($data as $value){
                       if ($value->status==0){
                         $count++;
                       }
                    }
                    @endphp
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="badge badge-pill gradient-2">{{$count}}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">{{$count}} New Orders</span>
                                <a href="javascript:void()" class="d-inline-block">
                                    <span class="badge badge-pill gradient-2">{{$count}}</span>
                                </a>
                            </div>
                            <div class="dropdown-content-body">
                                <ul>
                                    @foreach($data as $key=>$values)
                                        @if($values->status==0)
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
                                        @endif
                                        @if($c1==3)
                                            @break
                                        @endif
                                    @endforeach
                                    <a href="{{url('agency')}}/orderlist"><button type="button" class="btn btn-primary btn-sm">View All</button></a>

                                </ul>

                            </div>
                        </div>
                    </li>

                    <li class="icons dropdown d-none d-md-flex">
                        <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                            Hi,{{session()->get('agency.name')}}
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
                                        <a href="{{url('agency')}}/profile"><i class="icon-user"></i> <span>Profile</span></a>
                                    </li>
                                    <li>
                                        <a href="{{url('agency')}}/changepassword"><i class="fa fa-unlock-alt"></i> <span>Change Password</span></a>
                                    </li>
                                    {{--<li>--}}
                                        {{--<a href="javascript:void()">--}}
                                            {{--<i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill gradient-1">3</div>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}

                                    <hr class="my-2">
                                    {{--<li>--}}
                                        {{--<a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>--}}
                                    {{--</li>--}}
                                    <li><a href="{{url('agency')}}/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
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
                    <a class="has-arrow" href="{{url('agency')}}/dashboard" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('agency')}}/product" aria-expanded="false">
                        <i class="fa fa-product-hunt"></i><span class="nav-text">Product</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('agency')}}/color" aria-expanded="false">
                        <i class="fa fa-snowflake-o"></i><span class="nav-text">Product Color</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('agency')}}/size" aria-expanded="false">
                        <i class="fa fa-bar-chart"></i><span class="nav-text">Product Size</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('agency')}}/paperstock" aria-expanded="false">
                        <i class="fa fa-window-maximize"></i><span class="nav-text">Paper Stock</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('agency')}}/orderlist" aria-expanded="false">
                        <i class="fa fa-first-order"></i><span class="nav-text">OrderList</span>
                    </a>
                </li>


            </ul>
        </div>
    </div>