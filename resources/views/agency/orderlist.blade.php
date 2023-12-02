@extends('agency.app')
@section('body')
    <link rel="stylesheet" type="text/css" href="{{asset('public/Assets')}}/admin/DataTables/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/Assets')}}/admin/DataTables/responsive.dataTables.min.css"/>
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('agency')}}/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Orderlist</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order List</h4>
                            <div class="table-responsive">
                                <span style="color:red">{{session()->get('msg')}}</span>
                                <table class="table header-border responsive" id="datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="all">No</th>
                                        <th scope="col" class="all">Name</th>
                                        <th scope="col" class="all">OrderId</th>
                                        <th scope="col" class="none">Order Date</th>
                                        <th scope="col" class="all">Amount</th>
                                        <th scope="col" class="all">Address</th>
                                        <th scope="col" class="all">Mobile</th>
                                        <th scope="col" class="all">Email</th>
                                        <th scope="col" class="none">City</th>
                                        <th scope="col" class="none">Transaction Id</th>
                                        <th scope="col" class="none">Coupon Code</th>
                                        <th scope="col" class="none">Pincode</th>
                                        <th scope="col" class="none">Uid</th>
                                        <th scope="col" class="all">Order Status</th>
                                        <th scope="col" class="all">Order Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($order as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->o_name}}</td>
                                            <td>{{$val->o_id}}</td>
                                            <td>{{$val->o_date}}</td>
                                            <td>{{$val->amount}}</td>
                                            <td>{{$val->address}}</td>
                                            <td>{{$val->mobile}}</td>
                                            <td>{{$val->email}}</td>
                                            <td>{{$val->city}}</td>
                                            <td>{{$val->transaction_id}}</td>
                                            <td>{{$val->coupon_code}}</td>
                                            <td>{{$val->pincode}}</td>
                                            <td>{{$val->uid}}</td>
                                            <td>
                                                @if($val->status==0)
                                                    <span class="badge badge-pill badge-info">Placed</span>
                                                @elseif($val->status==1)
                                                    <span class="badge badge-pill badge-warning">Printing</span>
                                                @elseif($val->status==2)
                                                    <span class="badge badge-pill badge-danger">Printed</span>
                                                @elseif($val->status==3)
                                                    <span class="badge badge-pill badge-success">Delivered</span>
                                                @endif
                                            </td>
                                            {{--<td>--}}
                                                {{--@if($val->status==0)--}}
                                                    {{--<a href="{{url('admin')}}/orderstatus/{{$val->o_id}}/1"> <button type="button" class="btn btn-outline-dark btn-sm">Printing</button></a>--}}
                                                {{--@elseif($val->status==1)--}}
                                                    {{--<a href="#"><button type="button" data="{{$val->o_id}}" value="{{$val->o_id}}" class="btn btn-outline-dark btn-sm order_id" data-toggle="modal" data-target="#exampleModalCenter">Printed</button></a>--}}
                                                {{--@elseif($val->status==2)--}}
                                                    {{--<a href="{{url('admin')}}/orderstatus/{{$val->o_id}}/3"><button type="button" value="{{$val->o_id}}" class="btn btn-outline-dark btn-sm">Delivered</button></a>--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                            <td class="text-center"><a href="{{url('agency')}}/orderdetail/{{$val->o_id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('public/Assets')}}/admin/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="{{asset('public/Assets')}}/admin/DataTables/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });

    </script>
@endsection