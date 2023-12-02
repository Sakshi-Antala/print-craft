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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
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
                                <form method="post" action="{{url('agency')}}/insertproduct" enctype="multipart/form-data">
                                    @csrf
                                    <label>Select Category</label>
                                    <select class="form-control form-control-md mb-3" name="cat_id" id="cat_id">
                                        @foreach($cat as $value)
                                            <option value="{{$value->cat_id}}">{{$value->cname}}</option>
                                        @endforeach
                                    </select>
                                    <label>Select SubCategory</label>
                                    <select class="form-control form-control-md mb-3" name="sub_cat_id" id="sub_cat_id">
                                        @foreach($subcat as $value)
                                            <option value="{{$value->sub_cat_id}}">{{$value->s_c_name}}</option>
                                        @endforeach
                                    </select>
                                    <label>Product Name</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Product Name" name="pname" value="{{old('pname')}}" id="pname">
                                        @error('pname')<span style="color: red;">{{$message}}</span>@enderror
                                        <span id="d_pname" style="color: red;"></span>
                                    </div>
                                    <label>Product Description</label>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="2" id="desc" name="desc" placeholder="Product Description">{{old('desc')}}</textarea>
                                        @error('desc')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Required Data</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Required Data" name="required_data" value="{{old('required_data')}}" id="required_data">
                                        @error('required_data')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Min_Order_Quantity</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Min_Order_Quantity" name="min_qty" value="{{old('min_qty')}}" id="Min_Order_Quantity">
                                        @error('min_qty')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Product Price</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Product Price" name="price" value="{{old('price')}}">
                                        @error('price')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <div class="form-row" id="pa1">
                                        <div class="form-group col-md-6">
                                            <label>Color</label>
                                            <select class="form-control form-control-md" name="color[]" id="color">
                                                <option value="0">Select Color</option>
                                                @foreach($color as $value)
                                                    <option value="{{$value->color_id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Size</label>
                                            <select class="form-control form-control-md" name="size[]" id="size">
                                                <option value="0">Select Size</option>
                                                @foreach($size as $value)
                                                    <option value="{{$value->size_id}}">{{$value->size}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label>Product Image</label>
                                    <div class="form-group">
                                        <input type="file"  class="form-control-file" name="cimage[]">
                                    </div>
                                    <div id="div"></div>
                                    <div class="form-group">
                                        <button type="button" class="btn  btn-success" id="button">Add<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                                        {{--<button type="button" class="btn  btn-danger" id="button1">Remove<span class="btn-icon-right"><i class="fa fa-minus"></i></span></button>--}}
                                    </div>

                                    <label>Product Image</label>
                                    <div class="form-group">
                                        <input type="file"  class="form-control-file" name="image[]" multiple>
                                        @error('image')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>

                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Submit</button>
                                    <span style="color:red;">{{session()->get('pmsg')}}</span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Product List</h4>
                            <span style="color:red;">{{session()->get('message')}}</span>
                            <div class="table-responsive">
                                <span style="color:red;">{{session()->get('msg')}}</span>
                                <table class="table header-border responsive" id="datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="all">No</th>
                                        <th scope="col" class="all">Pname</th>
                                        <th scope="col" class="all">Price</th>
                                        <th scope="col" class="all">Category id</th>
                                        <th scope="col" class="none">Product Description</th>
                                        <th scope="col" class="none">Min_order_qty</th>
                                        {{--<th scope="col" class="none">Color id</th>--}}
                                        {{--<th scope="col" class="none">PaperStock id</th>--}}
                                        <th scope="col" class="none">Uid</th>
                                        <th scope="col" class="all">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($product as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->pname}}</td>
                                            <td>{{$val->price}}</td>
                                            <td>{{$val->sub_cat_id}}</td>
                                            <td>{{$val->p_desc}}</td>
                                            <td>{{$val->min_qty}}</td>
                                            {{--<td>{{$val->color_id}}</td>--}}
                                            {{--<td>{{$val->p_s_id}}</td>--}}
                                            <td>{{$val->uid}}</td>
                                            <td><span><a href="{{url('agency/fetchproduct')}}/{{$val->pid}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="{{url('agency/deleteproduct/')}}/{{$val->pid}}" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
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
        var count=1;
        $("#button").click(function(){
            count++;
            $("#div").append("<div class='form-row' id='pa"+count+"'>\
            <div class='form-group col-md-6'>\
                    <label>Color</label>\
                    <select class='form-control form-control-md' name='color[]' id='color'>\
                    <option value='0'>Select Color</option>\
                    @foreach($color as $value)\
                    <option value='{{$value->color_id}}'>{{$value->name}}</option>\
                    @endforeach\
                    </select>\
                    </div>\
                    <div class='form-group col-md-6'>\
                    <label>Size</label>\
                    <select class='form-control form-control-md' name='size[]' id='size'>\
                    <option value='0'>Select Size</option>\
                    @foreach($size as $value)\
                    <option value='{{$value->size_id}}'>{{$value->size}}</option>\
                    @endforeach\
                    </select>\
                    </div>\
                    <div class='form-group col-md-6'>\
                    <label>Product Image</label>\
                    <div class='form-group'>\
                    <input type='file'  class='form-control-file' name='cimage[]'>\
                    </div>\
                    </div>\
                    <form class='form-inline'>\
                    <div class='form-group col-md-3'>\
                    <button type='button' class='btn  btn-danger' id='button1' onclick=add('"+count+"')>Remove<span class='btn-icon-right'><i class='fa fa-minus'></i></span></button>\
                    </div>\
                    </form>\
                    </div>");
        });
        function add(count) {
            $('#pa'+count).remove();
        }
        //        $('#button1').click(function () {
        ////           $('#pa'+count).remove();
        //            alert('hy');
        //        });
        $('#pname').blur(function () {
            var pname=$('#pname').val();
            $.ajax({
                url:"/agency/getpname/"+pname,
                success:function (result) {
                    $('#d_pname').text(result);
                }
            });
        });
        $('#cat_id').change(function () {
            var cid=$(this).val();
            $.ajax({
                url:"{{url('agency/getsubcat')}}/"+cid,
                success:function (result) {
                    $('#sub_cat_id').html(result);
                }
            });
        });
    </script>
@endsection