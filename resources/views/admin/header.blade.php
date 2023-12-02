<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/Assets')}}/admin/images/favicon.png">
    <!-- Chartist -->
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
    <div class="nav-header noprint">
        <div class="brand-logo">
            <a href="{{url('admin/dashboard')}}">
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
    <div class="header noprint">
        <div class="header-content clearfix">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
            @php
               $order=\DB::table('orders')->get();
               $count=0;
               $c1=0;
               foreach ($order as $value){
               if ($value->status==0){
                    $count++;
                }
               }
            @endphp
            <div class="header-right">
                <ul class="clearfix">
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="badge badge-pill gradient-1">{{($count!=''?$count:'0')}}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">{{($count!=''?$count:'0')}} New Order</span>
                                <a href="javascript:void()" class="d-inline-block">
                                    <span class="badge badge-pill gradient-1">{{($count!=''?$count:'0')}}</span>
                                </a>
                            </div>
                            <div class="dropdown-content-body">
                                <ul>
                                    @foreach($order as $key=>$values)
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
                                        <a href="{{url('admin')}}/orderlist"><button type="button" class="btn btn-primary btn-sm">View All</button></a>
                                </ul>

                            </div>
                        </div>
                    </li>
                    @php
                        $data=\DB::table('agencies')->get();
                        $c=0;
                        $c2=0;
                        foreach ($data as $val){
                          if($val->status==0){
                            $c++;
                          }
                        }
                    @endphp
                    <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="badge badge-pill gradient-2">{{($c!=''?$c:'0')}}</span>
                        </a>
                        <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                            <div class="dropdown-content-heading d-flex justify-content-between">
                                <span class="">New Agency Request</span>
                                <a href="javascript:void()" class="d-inline-block">
                                    <span class="badge badge-pill gradient-2">{{($c!=''?$c:'0')}}</span>
                                </a>
                            </div>

                            <div class="dropdown-content-body">
                                <ul>
                                    @foreach($data as $value)
                                        @if($value->status==0)
                                            <li>
                                                <a href="javascript:void()">
                                                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="fa fa-address-card"></i></span>
                                                    <div class="notification-content">
                                                        <h6 class="notification-heading">{{$value->a_name}}</h6>
                                                        <span class="notification-text">{{$value->gst}}</span><br><br>
                                                        <a href="{{url('admin')}}/agencyapproval/{{$value->aid}}"><button type="button" class="btn btn-success btn-sm">Approve</button>
                                                </a>
                                                    </div>
                                                </a>
                                            </li>
                                            @if($c2==3)
                                                @break
                                            @endif
                                        @endif
                                    @endforeach
                                        <a href="{{url('admin')}}/agencylist"><button type="button" class="btn btn-info btn-sm">View All</button></a>

                                </ul>

                            </div>
                        </div>
                    </li>
                    <li class="icons dropdown d-none d-md-flex">
                        <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                        Hi,{{session()->get('admin.name')}}
                        </a>
                    </li>

                    <li class="icons dropdown">

                        <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="{{asset('public/Assets')}}/admin/admin_image/{{session()->get('admin.url')}}" height="40" width="40" alt="">
                        </div>

                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="{{url('admin')}}/profile"><i class="icon-user"></i> <span>Profile</span></a>
                                    </li>
                                    <li>
                                        <a href="{{url('admin')}}/changepassword"><i class="fa fa-unlock-alt"></i> <span>Change Password</span></a>
                                    </li>
                                    {{--<li>--}}
                                        {{--<a href="javascript:void()">--}}
                                            {{--<i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill gradient-1">3</div>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}

                                    <hr class="my-2">
                                    <li><a href="{{url('admin')}}/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
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
    <div class="nk-sidebar noprint">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/dashboard" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/category" aria-expanded="false">
                        <i class="fa fa-bars"></i><span class="nav-text">Category</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/subcategory" aria-expanded="false">
                        <i class="fa fa-th"></i><span class="nav-text">Sub Category</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/product" aria-expanded="false">
                        <i class="fa fa-product-hunt"></i><span class="nav-text">Product</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/userlist" aria-expanded="false">
                        <i class="fa fa-user-circle-o"></i><span class="nav-text">Userlist</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/agencylist" aria-expanded="false">
                        <i class="fa fa-address-card"></i><span class="nav-text">Agency List</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/orderlist" aria-expanded="false">
                        <i class="fa fa-first-order"></i><span class="nav-text">Order List</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/coupon" aria-expanded="false">
                        <i class="fa fa-cc"></i><span class="nav-text">Coupon</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/deliveryboy" aria-expanded="false">
                        <i class="fa fa-motorcycle"></i><span class="nav-text">Delivery Boy</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/addmembership" aria-expanded="false">
                        <i class="fa fa-money"></i><span class="nav-text">Membership</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="{{url('admin')}}/review" aria-expanded="false">
                        <i class="fa fa-commenting-o"></i><span class="nav-text">Reviews</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>