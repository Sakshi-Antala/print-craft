@extends('deliveryboy.app')
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
                    <li class="breadcrumb-item"><a href="{{url('admin')}}/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">OrderList</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
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
                                        <th scope="col" class="all">Order Date</th>
                                        <th scope="col" class="all">Address</th>
                                        <th scope="col" class="all">City</th>
                                        <th scope="col" class="all">Pincode</th>
                                        <th scope="col" class="all">Mobile</th>
                                        <th scope="col" class="all">Email</th>
                                        <th scope="col" class="all">Amount</th>
                                        <th scope="col" class="all">Order Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @if(count($order)>0 && isset($order))
                                    @foreach($order as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->o_name}}</td>
                                            <td>{{$val->o_date}}</td>
                                            <td>{{$val->address}}</td>
                                            <td>{{$val->city}}</td>
                                            <td>{{$val->pincode}}</td>
                                            <td>{{$val->mobile}}</td>
                                            <td>{{$val->email}}</td>
                                            <td>{{$val->amount}}</td>
                                            <td class="text-center"><a href="{{url('deliveryboy')}}/orderdetail/{{$val->o_id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                            {{--<td><a href="{{url('deliveryboy')}}/orderdetail/{{$val->o_id}}"><button type="button" class="btn btn-success btn-sm">Order Detail</button>--}}
                                                {{--</a></td>--}}
                                        </tr>
                                    @endforeach
                                    @endif
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
