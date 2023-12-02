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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Subcategory</a></li>
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
                                <form method="post" action="{{url('admin')}}/insertsubcategory">
                                    @csrf
                                    <label>Choose Category</label>
                                    <select class="form-control form-control-md mb-3" name="cat_id">
                                        @foreach($data as $value)
                                            <option value="{{$value->cat_id}}">{{$value->cname}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Sub Category" name="s_c_name" value="{{old('s_c_name')}}">
                                        @error('s_c_name')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>

                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Submit</button>
                                    {{session()->get('subcatmsg')}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">SubCategory List</h4>
                            <div class="table-responsive">
                                <span style="color:red;">{{session()->get('submsg')}}</span>
                                <span style="color:red;">{{session()->get('msg')}}</span>
                                <table class="table header-border" id="datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Category id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($subcat as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->cat_id}}</td>
                                            <td>{{$val->s_c_name}}</td>
                                            <td><span><a href="{{url('admin/fetchsubcategory')}}/{{$val->sub_cat_id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="{{url('admin/deletesubcategory/')}}/{{$val->sub_cat_id}}" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
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