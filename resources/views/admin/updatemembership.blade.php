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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">update Membership</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Membership Plan</h3><br>
                            <div class="basic-form">
                                <form method="post" action="{{url('admin')}}/updatemembership/{{$member->mid}}" enctype="multipart/form-data">
                                    @csrf
                                    <label>Membership Name</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Membership Name" name="membershipname" value="{{$member->m_title}}">
                                    </div>
                                    <label>Membership Benefits</label>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="desc" name="desc" placeholder="Product Description">{{$member->m_desc}}</textarea>
                                    </div>
                                    <label>Price</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Price" name="price" value="{{$member->price}}">
                                    </div>
                                    <label>Duration</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Duration" name="duration" value="{{$member->duration}}">
                                    </div>
                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Update</button>
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
