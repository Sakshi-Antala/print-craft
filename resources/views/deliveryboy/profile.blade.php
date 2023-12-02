@extends('deliveryboy.app')
@section('body')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('deliveryboy')}}/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-4">
                                {{--<img class="mr-3" src="#" width="80" height="80" alt="">--}}
                                <div class="media-body">
                                    <h3 class="mb-0">{{$agency->name}}</h3>
                                    <p class="text-muted mb-0">Delivery Boy</p>
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
            </div>
        </div>
        <!-- #/ container -->
    </div>
@endsection