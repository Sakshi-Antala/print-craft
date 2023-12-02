@extends('agency.app')
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
                    <li class="breadcrumb-item"><a href="{{url('agency')}}/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Color</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">ADD COLOR</h3><br>
                            <div class="basic-form">
                                <form action="{{url('agency')}}/insertcolor" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Color" name="color" value="{{old('color')}}">
                                        @error('color')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Submit</button>
                                    {{session()->get('pcolor')}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Color List</h4>
                            <span style="color:red;">{{session()->get('cmsg')}}</span>
                            <span style="color:red;">{{session()->get('msg')}}</span>
                            <div class="table-responsive">
                                <table class="table header-border" id="datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($color as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->name}}</td>
                                            <td><span><a href="{{url('agency/fetchcolor')}}/{{$val->color_id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="{{url('agency/deletecolor/')}}/{{$val->color_id}}" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
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