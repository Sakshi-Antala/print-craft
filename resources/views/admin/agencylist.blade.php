@extends('admin.app')
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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Agency List</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Agency List</h4>
                            <div class="table-responsive">
                                <span style="color:red">{{session()->get('msg')}}</span>
                                <table class="table header-border responsive" id="datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="all">No</th>
                                        <th scope="col" class="all">Agency Name</th>
                                        <th scope="col" class="all">GST</th>
                                        <th scope="col" class="all">UserId</th>
                                        <th scope="col" class="all">Status</th>
                                        <th scope="col" class="all">Operation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($agency as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->a_name}}</td>
                                            <td>{{$val->gst}}</td>
                                            <td>{{$val->uid}}</td>
                                            <td>{{($val->status==0?'Not Approved':'Approved')}}</td>
                                            @if($val->status==1)
                                                <td><a href="#"><button type="button" class="btn btn-success btn-sm">Approved</button>
                                                    </a></td>
                                            @else
                                                <td><a href="{{url('admin')}}/agencyapproval/{{$val->aid}}"><button type="button" class="btn btn-danger btn-sm">Approve</button>
                                                    </a></td>
                                            @endif
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Membership Purchase List</h4>
                            <div class="table-responsive">
                                <span style="color:red">{{session()->get('msg')}}</span>
                                <table class="table header-border responsive" id="datatables" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="all">No</th>
                                        <th scope="col" class="all">User Name</th>
                                        <th scope="col" class="all">Purchase Date</th>
                                        <th scope="col" class="all">End date</th>
                                        <th scope="col" class="all">Transaction Id</th>
                                        <th scope="col" class="all">Amount</th>
                                        <th scope="col" class="all">UserId</th>
                                        <th scope="col" class="all">MembershipId</th>
                                        <th scope="col" class="all">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($mspurchase as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->name}}</td>
                                            <td>{{$val->p_date}}</td>
                                            <td>{{$val->e_date}}</td>
                                            <td>{{$val->transaction_id}}</td>
                                            <td>{{$val->p_amount}}</td>
                                            <td>{{$val->uid}}</td>
                                            <td>{{$val->mid}}</td>
                                            <td>{{($val->type==0?'Active':'Deactive')}}</td>
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
                $(document).ready( function () {
                    $('#datatables').DataTable();
                });
            </script>
        @endsection