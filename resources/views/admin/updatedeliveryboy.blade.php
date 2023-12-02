@extends('admin.app')
@section('body')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Update DeliveryBoy</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">DELIVERY BOY</h3><br>
                            <div class="basic-form">
                                <form method="post" action="{{url('admin')}}/updatedeliveryboy/{{$user->uid}}" enctype="multipart/form-data">
                                    @csrf
                                    <label>DeliveryBoy Name</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="DeliveryBoy Name" name="name" value="{{$user->name}}" id="name">
                                    </div>
                                    <label>Mobile</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Mobile" name="mobile" value="{{$user->mobile}}" id="mobile">
                                    </div>
                                    <label>Email</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Email" name="email" value="{{$user->email}}" id="email">
                                    </div>
                                    <label>Password</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="password" placeholder="Password" name="password" value="{{$user->password}}" id="password">
                                    </div>
                                    {{--<label>Confrim Password</label>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<input class="form-control form-control-md" type="password" placeholder="Confrim Password" name="cpassword" value="{{$user->cpassword}}" id="cpassword">--}}
                                    {{--</div>--}}
                                    <label>DOB</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="DOB" name="dob" value="{{$user->dob}}" id="dob">
                                    </div>
                                    <label>Address</label>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="2" id="address" name="address" placeholder="Address">{{$user->address}}</textarea>
                                    </div>
                                    <label>Pincode</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Pincode" name="pincode" value="{{$user->pincode}}" id="pincode">
                                    </div>
                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">update</button>
                                    <span style="color:red;">{{session()->get('msg')}}</span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->

        </div>

    </div>

@endsection
