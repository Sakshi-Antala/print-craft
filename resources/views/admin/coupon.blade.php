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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Coupon</a></li>
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
                                <form method="post" action="{{url('admin')}}/insertcoupon" enctype="multipart/form-data">
                                    @csrf
                                    <label>Coupon Code</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Coupon Code" name="code" value="{{old('code')}}" id="code">
                                        @error('code')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Who Can Use</label>
                                    <select class="form-control form-control-md mb-3" name="uid" id="uid">
                                        <option value="0">All</option>
                                        @foreach($user as $value)
                                            <option value="{{$value->uid}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    <label>Coupon Type</label>
                                    <div class="form-group">
                                        <label class="radio-inline mr-3">
                                            <input type="radio" name="type" value="0" checked> Flat</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="1"> Percentage</label>
                                    </div>
                                    <label>Amount</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Amount" name="amount" value="{{old('amount')}}" id="amount">
                                        @error('amount')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>No Of Uses</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="No Of Uses" name="uses" value="{{old('uses')}}" id="uses">
                                        @error('uses')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Min_Order</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Min_Order" name="min_order" value="{{old('min_order')}}" id="min_order">
                                        @error('min_order')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Starting Date</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="date" placeholder="Starting Date" name="s_date" value="{{old('s_date')}}">
                                        @error('s_date')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <label>Ending Date</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="date" placeholder="Ending Date" name="e_date" value="{{old('e_date')}}">
                                        @error('e_date')<span style="color: red;">{{$message}}</span>@enderror
                                    </div>
                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Submit</button>
                                    <span style="color:red;">{{session()->get('message')}}</span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Coupon List</h4>
                            <div class="table-responsive">
                                <span style="color:red;">{{session()->get('msg')}}</span>
                                <table class="table header-border responsive" id="datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="all">No</th>
                                        <th scope="col" class="all">Code</th>
                                        <th scope="col" class="all">Username</th>
                                        <th scope="col" class="all">Type</th>
                                        <th scope="col" class="all">Amount</th>
                                        <th scope="col" class="none">Min_order</th>
                                        <th scope="col" class="all">Sdate</th>
                                        <th scope="col" class="all">Edate</th>
                                        <th scope="col" class="all">Status</th>
                                        <th scope="col" class="all">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($coupon as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$val->code}}</td>
                                            <td>{{($val->uid==0?"All":$val->name)}}</td>
                                            <td>{{($val->type==0?"Flat":"Percentage")}}</td>
                                            <td>{{$val->c_amount}}</td>
                                            <td>{{$val->min_order}}</td>
                                            <td>{{$val->s_date}}</td>
                                            <td>{{$val->e_date}}</td>
                                            <td>{{($val->c_status==0?"Deactive":"Active")}}</td>
                                            <td><span><a href="{{url('/admin/fetchcoupon')}}/{{$val->coupon_id}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="{{url('admin/deletecoupon')}}/{{$val->coupon_id}}" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
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
        $('#code').blur(function () {
          var code=$(this).val();
           $.ajax({
              url:"{{url('admin')}}/checkcode/"+code,
              success:function (result) {
                  if(result==0){
                      alert("Valid Coupon Code");
                  }else{
                      alert("Invalid Coupon Code");
                  }

              }
           });
        });
    </script>
@endsection