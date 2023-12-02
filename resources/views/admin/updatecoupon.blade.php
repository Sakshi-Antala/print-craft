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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Coupon</a></li>
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
                                <form method="post" action="{{url('admin')}}/updatecoupon/{{$coupon->coupon_id}}" enctype="multipart/form-data">
                                    @csrf
                                    <label>Coupon Code</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Coupon Code" name="code" value="{{$coupon->code}}" id="code">
                                    </div>
                                    <label>Who Can Use</label>
                                    <select class="form-control form-control-md mb-3" name="uid" id="uid">
                                        <option value="0">All</option>
                                        @foreach($user as $value)
                                            @if($value->uid==$coupon->uid)
                                                <option value="{{$value->uid}}" selected>{{$value->name}}</option>
                                            @else
                                                <option value="{{$value->uid}}">{{$value->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>Coupon Type</label>
                                    <div class="form-group">
                                        @if($coupon->type==0)
                                        <label class="radio-inline mr-3">
                                            <input type="radio" name="type" value="0" checked> Flat</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="1"> Percentage</label>
                                        @endif
                                        @if($coupon->type==1)
                                                <label class="radio-inline mr-3">
                                                    <input type="radio" name="type" value="0"> Flat</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="type" value="1" checked> Percentage</label>
                                        @endif
                                    </div>
                                    <label>Amount</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Amount" name="amount" value="{{$coupon->c_amount}}" id="amount">
                                    </div>
                                    <label>No Of Uses</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="No Of Uses" name="uses" value="{{$coupon->no_of_uses}}" id="uses">
                                    </div>
                                    <label>Min_Order</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="text" placeholder="Min_Order" name="min_order" value="{{$coupon->min_order}}" id="min_order">
                                    </div>
                                    <label>Starting Date</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="date" placeholder="Starting Date" name="s_date" value="{{$coupon->s_date}}">
                                    </div>
                                    <label>Ending Date</label>
                                    <div class="form-group">
                                        <input class="form-control form-control-md" type="date" placeholder="Ending Date" name="e_date" value="{{$coupon->e_date}}">
                                    </div>
                                    <button type="submit" class="btn mb-1 btn-rounded btn-primary">Update</button>
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