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
                                        <th scope="col" class="all">SubCategory</th>
                                        <th scope="col" class="none">Product Description</th>
                                        <th scope="col" class="none">Min_order_qty</th>
                                        {{--<th scope="col" class="none">Color id</th>--}}
                                        {{--<th scope="col" class="none">PaperStock id</th>--}}
                                        <th scope="col" class="all">Agency id</th>
                                        {{--<th scope="col" class="all">Action</th>--}}
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
                                        <td>{{$val->catname}}</td>
                                        <td>{{$val->p_desc}}</td>
                                        <td>{{$val->min_qty}}</td>
                                        {{--<td>{{$val->color_id}}</td>--}}
                                        {{--<td>{{$val->p_s_id}}</td>--}}
                                        <td>{{$val->uid}}</td>
                                        {{--<td><span><a href="{{url('admin/fetchproduct')}}/{{$val->pid}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="{{url('admin/deleteproduct/')}}/{{$val->pid}}" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>--}}
                                        {{--</td>--}}
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
              url:"/admin/getpname/"+pname,
               success:function (result) {
                   $('#d_pname').text(result);
               }
           });
        });
        $('#cat_id').change(function () {
           var cid=$(this).val();
           $.ajax({
              url:"{{url('admin/getsubcat')}}/"+cid,
              success:function (result) {
                  $('#sub_cat_id').html(result);
              }
           });
        });
    </script>
@endsection