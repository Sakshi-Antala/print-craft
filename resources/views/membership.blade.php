@extends('app')
@section('body')
    <style type="text/css">
        .price{
            width: 100%;
            height: auto;
            padding: 50px;
        }
        .card{
            transition: 0.4s ease;
            margin-bottom: 30px;
        }
        .card-header{
            font-weight: bold;
            background: white;
            line-height: 1.6rem;
            padding: 25px 0;
            font-size: 25px;
        }
        .card-body{
            padding: 30px 0;
        }
        .card-body li{
            margin: 10px 0;
            font-size:16px;
            line-height: 1.6;
        }
        .card-footer{
            padding: 30px 0;
            background: white;
        }
        .card-footer a{
            border: 1px solid black;
            border-radius: 100px;
            outline: none;
            color: black;
            font-weight: bold;
            margin: 0 5px;
            padding: 12px 35px;
            font-size: 16px;
            line-height: 1.4;
            text-align: center;
        }
        .card-footer a:hover{
            color: white;
            background: #ca1515;
            text-decoration: none;
        }
        .card:hover{
            transform: translateY(-20px);
        }
        .card:hover .card-header{
            color: white;
            background: #ca1515;
        }
    </style>
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Membership</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="price" id="price">
        <div class="container">
            <div class="row">
                @foreach($membership as $val)
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card text-center">
                                <div class="card-header">{{$val->m_title}}</div>
                                <div class="card-body">
                                    <li>Rs.{{$val->price}}/{{$val->m_title}}</li>
                                    @foreach(explode(",",$val->m_desc) as $value)
                                        <li>{{$value}}</li>
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <a href="{{url('mspurchase')}}/{{$val->mid}}">Purchase</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>

@endsection