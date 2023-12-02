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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Membership</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Add Membership Plan</h3><br>
                            <div class="basic-form">
                                <form method="post" action="{{url('admin')}}/insertmembership" enctype="multipart/form-data">
                                    @csrf
                                    <label>Membership Name</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Membership Name" name="membershipname" value="{{old('membershipname')}}" id="name">
                                        @error('membershipname')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Membership Benefits</label>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="desc" name="desc" placeholder="Product Description">{{old('desc')}}</textarea>
                                        @error('desc')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Price</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Price" name="price" value="{{old('price')}}" id="Price">
                                        @error('price')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Duration</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Duration" name="duration" value="{{old('duration')}}" id="email">
                                        @error('duration')<span style="color: red;">{{$message}}</span>@enderror
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
                            <h4 class="card-title">Membership Plans</h4>
                            <div class="table-responsive">
                                <span style="color:red;">{{session()->get('message')}}</span>
                                <table class="table header-border responsive" id="datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="all">No</th>
                                        <th scope="col" class="all">Name</th>
                                        <th scope="col" class="all">Benefits</th>
                                        <th scope="col" class="all">Price</th>
                                        <th scope="col" class="none">Duration</th>
                                        <th scope="col" class="all">Operation</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($member as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->m_title}}</td>
                                            <td>{{$val->m_desc}}</td>
                                            <td>{{$val->price}}</td>
                                            <td>{{$val->duration}}</td>
                                            <td><span><a href="{{url('admin/fetchmembership')}}/{{$val->mid}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="{{url('admin/deletemembership/')}}/{{$val->mid}}" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
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