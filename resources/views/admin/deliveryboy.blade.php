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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Delivery Boy</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">ADD DELIVERY BOY</h3><br>
                    <div class="basic-form">
                    <form method="post" action="{{url('admin')}}/insertdeliveryboy" enctype="multipart/form-data">
                    @csrf
                    <label>DeliveryBoy Name</label>
                    <div class="form-group">
                    <input class="form-control form-control-md" type="text" placeholder="DeliveryBoy Name" name="name" value="{{old('name')}}" id="name">
                    @error('name')<span style="color: red;">{{$message}}</span>@enderror
                    </div>
                        <label>Mobile</label>
                        <div class="form-group">
                            <input class="form-control form-control-md" type="text" placeholder="Mobile" name="mobile" value="{{old('mobile')}}" id="mobile">
                            @error('mobile')<span style="color: red;">{{$message}}</span>@enderror
                        </div>
                        <label>Email</label>
                        <div class="form-group">
                            <input class="form-control form-control-md" type="text" placeholder="Email" name="email" value="{{old('email')}}" id="email">
                            @error('email')<span style="color: red;">{{$message}}</span>@enderror
                        </div>
                        <label>Password</label>
                        <div class="form-group">
                            <input class="form-control form-control-md" type="password" placeholder="Password" name="password" value="{{old('password')}}" id="password">
                            @error('password')<span style="color: red;">{{$message}}</span>@enderror
                        </div>
                        <label>Confrim Password</label>
                        <div class="form-group">
                            <input class="form-control form-control-md" type="password" placeholder="Confrim Password" name="cpassword" value="{{old('cpassword')}}" id="cpassword">
                            @error('cpassword')<span style="color: red;">{{$message}}</span>@enderror
                        </div>
                        <label>DOB</label>
                        <div class="form-group">
                            <input class="form-control form-control-md" type="text" placeholder="DOB" name="dob" value="{{old('dob')}}" id="dob">
                            @error('dob')<span style="color: red;">{{$message}}</span>@enderror
                        </div>
                        <label>Address</label>
                        <div class="form-group">
                            <textarea class="form-control" rows="2" id="address" name="address" placeholder="Address">{{old('address')}}</textarea>
                            @error('address')<span style="color: red;">{{$message}}</span>@enderror
                        </div>
                        <label>Pincode</label>
                        <div class="form-group">
                            <input class="form-control form-control-md" type="text" placeholder="Pincode" name="pincode" value="{{old('pincode')}}" id="pincode">
                            @error('pincode')<span style="color: red;">{{$message}}</span>@enderror
                        </div>
                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Submit</button>
                    <span style="color:red;">{{session()->get('msg')}}</span>
                    </form>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">DeliveryBoy List</h4>
                            <div class="table-responsive">
                                <span style="color:red;">{{session()->get('message')}}</span>
                                <table class="table header-border responsive" id="datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="all">No</th>
                                        <th scope="col" class="all">Name</th>
                                        <th scope="col" class="all">Mobile</th>
                                        <th scope="col" class="all">Email</th>
                                        <th scope="col" class="none">Password</th>
                                        <th scope="col" class="all">DOB</th>
                                        <th scope="col" class="all">Address</th>
                                        <th scope="col" class="none">Pincode</th>
                                        <th scope="col" class="all">Operation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($user as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val['name']}}</td>
                                            <td>{{$val['mobile']}}</td>
                                            <td>{{$val['email']}}</td>
                                            <td>{{$val['password']}}</td>
                                            <td>{{$val['dob']}}</td>
                                            <td>{{$val['address']}}</td>
                                            <td>{{$val['pincode']}}</td>
                                            <td><span><a href="{{url('admin/fetchdeliveryboy')}}/{{$val->uid}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="{{url('admin/deletedeliveryboy/')}}/{{$val->uid}}" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                            </td>
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