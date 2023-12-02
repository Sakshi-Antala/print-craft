@extends('agency.app')
@section('body')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('agency')}}/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-4">
                                {{--<img class="mr-3" src="#" width="80" height="80" alt="">--}}
                                <div class="media-body">
                                    <h3 class="mb-0">{{$agency->name}}</h3>
                                    <p class="text-muted mb-0">Agency</p>
                                </div>
                            </div>

                            <h4>About Me</h4>
                            <p class="text-muted"><strong class="text-dark mr-1">Address</strong>{{$agency->address}}</p>
                            <ul class="card-profile__info">
                                <li class="mb-1"><strong class="text-dark mr-1">Mobile</strong> <span>{{$agency->mobile}}</span></li>
                                <li><strong class="text-dark mr-1">Email</strong> <span>{{$agency->email}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Profile</h4>
                            <form action="{{url('agency/changeagencyprofile')}}" class="form-profile" method="post">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control form-control-md" type="text" placeholder="Name" name="name" value="{{$agency->name}}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-md" type="text" placeholder="Mobile" name="mobile" value="{{$agency->mobile}}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-md" type="text" placeholder="Email" name="email" value="{{$agency->email}}">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="address" id="textarea" cols="30" rows="2" placeholder="Address">{{$agency->address}}</textarea>
                                </div>
                                {{--<img src="{{asset('public/Assets')}}/admin/admin_image/{{$admin->url}}" height="80" width="80"><br><br>--}}
                                <button class="btn btn-primary px-3" type="submit">Update</button>
                                <span style="color:red;">{{session()->get('message')}}</span>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
@endsection