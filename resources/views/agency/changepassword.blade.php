@extends('agency.app')
@section('body')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('agency')}}/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Change Password</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Change Password</h4>
                            <div class="basic-form">
                                <form action="{{url('agency')}}/updatepassword" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="password" placeholder="Old Password" name="opassword">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="password" placeholder="New Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="password" placeholder="Confrim New Password" name="cpassword">
                                    </div>
                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Change Password</button>
                                    <span style="color: red;">{{session()->get('msg')}}</span>
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
