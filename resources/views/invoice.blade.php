@extends('app')
@section('body')

    <main class="content">
        <div class="container">

            <h1 class="h3 my-3">Invoice #{{$order->o_id}}</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body m-sm-3 m-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted">Payment No.</div>
                                    <strong>{{$order->transaction_id}}</strong>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <div class="text-muted">Payment Date</div>
                                    <strong>{{$order->o_date}}</strong>
                                </div>
                            </div>

                            <hr class="my-4" />

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="text-muted">Client</div>
                                    <strong>
                                        {{$order->o_name}}
                                    </strong>
                                    <p>
                                        {{$order->address}} <br> {{$order->city}}  <br> India-{{$order->pincode}} <br>
                                        <a href="mailto:{{$order->email}}">
                                            {{$order->email}}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <div class="text-muted">Payment To</div>
                                    <strong>
                                        VistaPrint
                                    </strong>
                                    <p>
                                        354 Roy Alley <br> Surat-395006 <br> India <br>
                                        <a href="mailto: vistaprint@gmail.com">
                                            vistaprint@gmail.com
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width:5%">No.</th>
                                        <th style="width:10%">Product Name</th>
                                        <th class="text-center" style="width:5%">Price</th>
                                        <th class="text-center" style="width:5%">Qty</th>
                                        <th class="" style="width:15%">Decription</th>
                                        <th class="text-center" style="width:10%">Logo On Design</th>
                                        <th class="text-center" style="width:15%">Uploaded design</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total=0;
                                    @endphp
                                    @foreach($odetail as $key=>$value)
                                        @php
                                            $total=$total+($value['qty']*$value['price']);
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td>{{$value->pname}}</td>
                                            <td class="text-center">{{$value->price}}</td>
                                            <td class="text-center">{{$value->qty}}</td>
                                            <td class="">color:{{$value->color}}
                                                <br>size:{{$value->size}}<br>
                                                paperstock:{{$value->paperstock}}<br>
                                                Required Data:{{$value->required_datas}}
                                            </td>
                                            <td style="text-align: center;">
                                                <img width="80px"  src="{{asset('public/Assets')}}/img/cimage/{{($value->logo_url!=''?$value->logo_url:' --')}}" alt="">
                                            </td>
                                            {{--@if($value->color=='')--}}
                                                {{--<td class="text-center">--</td>--}}
                                            {{--@else--}}
                                                {{--<td class="text-center">{{$value->color}}</td>--}}
                                            {{--@endif--}}
                                            {{--@if($value->size=='')--}}
                                                {{--<td class="text-center">--</td>--}}
                                            {{--@else--}}
                                                {{--<td class="text-center">{{$value->size}}</td>--}}
                                            {{--@endif--}}
                                            {{--@if($value->paperstock=='')--}}
                                                {{--<td class="text-center">--</td>--}}
                                            {{--@else--}}
                                                {{--<td class="text-center">{{$value->paperstock}}</td>--}}
                                            {{--@endif--}}
                                            {{--@if($value->required_datas=='' && $value->logo_url=='')--}}
                                                {{--<td class="text-center">--</td>--}}
                                            {{--@else--}}
                                                {{--<td class="text-center">{{$value->required_datas}}{{$value->logo_url}}</td>--}}
                                            {{--@endif--}}
                                            @php
                                                $arr=explode(",",$value->user_uploaded_design);
                                            @endphp
                                            <td class="" style="text-align: center;"><img width="100px"  src="{{asset('public/Assets')}}/img/product-img/custom_design/{{(isset($arr) && count($arr)>0 && $arr[0]!=''?$arr[0]:'None')}}" alt=""></td>
                                            {{--<td class="text-right">({{$value->color}}!=''?{{$value->color}}:'--')</td>--}}
                                            {{--<td class="text-right">({{$value->size}}!=''?{{$value->size}}:'--')</td>--}}
                                            {{--<td class="text-right">({{$value->paperstock}}!=''?{{$value->paperstock}}:'--')</td>--}}
                                            {{--<td class="text-right">{{$value->required_datas}},{{$value->logo_url}}</td>--}}
                                            {{--<td class="text-right">{{$value->user_uploaded_design}}</td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-xs-6 text-right pull-right invoice-total my-3">
                                <p><strong>Subtotal</strong> : {{$total}}</p>
                                <p><strong>Discount</strong> : {{$order->d_amt}} </p>
                                <p><strong>Total</strong> : {{$total-$order->d_amt}} </p>
                            </div>

                            <div class="text-center">
                                <p class="text-sm">
                                    <strong>Extra note:</strong> Thank You.
                                </p>
                                <button type="button" class="site-btn noprint" id="register" onclick="window.print()">Print this receipt</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <style>
        @media print{
            .noprint{
                display: none;
            }
        }
    </style>
@endsection