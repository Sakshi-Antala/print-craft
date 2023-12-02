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
                                <form method="post" action="{{url('admin')}}/updatesubcategory/{{$subcat->sub_cat_id}}">
                                    @csrf
                                    <label>Choose Category</label>
                                    <select class="form-control form-control-md mb-3" name="cat_id">
                                        @foreach($cat as $value)
                                            @if($value->cat_id==$subcat->cat_id)
                                                <option value="{{$value->cat_id}}" selected>{{$value->cname}}</option>
                                            @else
                                                <option value="{{$value->cat_id}}">{{$value->cname}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Sub Category" name="s_c_name" value="{{$subcat->s_c_name}}">
                                    </div>

                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Update</button>
                                    {{session()->get('subcatmsg')}}
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