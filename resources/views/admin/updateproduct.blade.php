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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Updateproduct</a></li>
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
                                <form method="post" action="{{url('admin')}}/updateproduct/{{$product->pid}}" enctype="multipart/form-data">
                                    @csrf
                                    <label>Select Category</label>
                                    <select class="form-control form-control-md mb-3" name="cat_id" id="cat_id">
                                        @foreach($cat as $value)
                                            @if($value->cat_id==$product->cat_id)
                                               <option value="{{$value->cat_id}}" selected>{{$value->cname}}</option>
                                            @else
                                                <option value="{{$value->cat_id}}">{{$value->cname}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>Select SubCategory</label>
                                    <select class="form-control form-control-md mb-3" name="sub_cat_id" id="sub_cat_id">
                                        @foreach($subcat as $value)
                                            @if($value->sub_cat_id==$product->sub_cat_id)
                                                <option value="{{$value->sub_cat_id}}" selected>{{$value->s_c_name}}</option>
                                            @else
                                                <option value="{{$value->sub_cat_id}}">{{$value->s_c_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>Product Name</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Product Name" name="pname" value="{{$product->pname}}">
                                    </div>
                                    <label>Product Description</label>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="2" id="desc" name="desc" placeholder="Product Description">{{$product->p_desc}}</textarea>
                                    </div>
                                    <label>Required Data</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Required Data" name="required_data" value="{{$product->required_data}}" id="required_data">
                                    </div>
                                    <label>Min_Order_Quantity</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Min_Order_Quantity" name="min_qty" value="{{$product->min_qty}}" id="Min_Order_Quantity">
                                    </div>
                                    <label>Product Price</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Product Price" name="price" value="{{$product->price}}">
                                    </div>
                                    @php
                                    $loop_count=1;
                                    @endphp
                                    @foreach($attr as $val)
                                    <div class="form-row" id="pa{{$loop_count++}}">
                                        <div class="form-group col-md-6">
                                            <input type="hidden" value="{{$val['p_a_id']}}" name="p_a_id[]">
                                            <label>Color</label>
                                            <select class="form-control form-control-md" name="color[]" id="color">
                                                <option value="0">Select Color</option>
                                                @foreach($color as $value)
                                                    @if($value->color_id==$val['color_id'])
                                                        <option value="{{$value->color_id}}" selected>{{$value->name}}</option>
                                                    @else
                                                        <option value="{{$value->color_id}}">{{$value->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Size</label>
                                            <select class="form-control form-control-md" name="size[]" id="size">
                                                <option value="0">Select Size</option>
                                                @foreach($size as $value)
                                                    @if($value->size_id==$val['size_id'])
                                                        <option value="{{$value->size_id}}" selected>{{$value->size}}</option>
                                                    @else
                                                        <option value="{{$value->size_id}}">{{$value->size}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        {{--<div class="form-group col-md-4">--}}
                                            {{--<label>Paper Stock</label>--}}
                                            {{--<select class="form-control form-control-md" name="paperstock[]" id="paperstock">--}}
                                                {{--<option value="0">Select Paperstock</option>--}}
                                                {{--@foreach($paperstock as $value)--}}
                                                    {{--@if($value->p_s_id==$val['p_s_id'])--}}
                                                        {{--<option value="{{$value->p_s_id}}" selected>{{$value->m_type}}</option>--}}
                                                    {{--@else--}}
                                                        {{--<option value="{{$value->p_s_id}}">{{$value->m_type}}</option>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                        <div class="form-group col-md-6">
                                        <label>Product Image</label>
                                        <div class="form-group">
                                            <input type="file"  class="form-control-file" name="cimage[]" value="{{$val->url}}">{{$val->url}}
                                        </div>
                                        </div>
                                        @if($loop_count==2)
                                        <div class="form-group">
                                            <button type="button" class="btn  btn-success" id="button">Add<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                                            {{--<button type="button" class="btn  btn-danger" id="button1">Remove<span class="btn-icon-right"><i class="fa fa-minus"></i></span></button>--}}
                                        </div>
                                        @else
                                            <div class="form-group">
                                                {{--<button type="button" class="btn  btn-success" id="button">Add<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>--}}
                                                <a href="{{url('admin/deleteproductattr/')}}/{{$val->p_a_id}}/{{$val->pid}}"> <button type="button" class="btn  btn-danger" id="button1">Remove<span class="btn-icon-right"><i class="fa fa-minus"></i></span></button></a>
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                                    <div id="div"></div>
                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Submit</button>
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
@section('script')
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
        var count={{$loop_count}};
        $("#button").click(function(){
            count++;
            $("#div").append("<input type='hidden' value='' name='p_a_id[]'><div class='form-row' id='pa"+count+"'>\
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
                    <div class='form-group col-md-3'>\
                    <button type='button' class='btn  btn-danger' id='button1' onclick=add('"+count+"')>Remove<span class='btn-icon-right'><i class='fa fa-minus'></i></span></button>\
                    </div>\
                    </div>");
        });
        function add(count) {
            $('#pa'+count).remove();
        }
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