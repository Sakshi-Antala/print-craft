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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Color</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{url('agency')}}/updatecolor/{{$color->color_id}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Color" name="color" value="{{$color->name}}">
                                    </div>
                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Submit</button>
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
