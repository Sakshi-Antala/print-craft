@if($paginator->hasPages())
    <div class="pagination__option">
        @if(!$paginator->onFirstPage())
            <a href="{{$paginator->previousPageUrl()}}"><i class="fa fa-angle-left"></i></a>
        @endif
        @if(is_array($elements[0]))
            @foreach($elements[0] as $key=>$url)
                @if($key==$paginator->currentPage())
                        <a href="{{$url}}" class="active">{{$key}}</a>
                @else
                        <a href="{{$url}}">{{$key}}</a>
                @endif
            @endforeach
        @endif
        @if($paginator->hasMorePages())
                <a href="{{$paginator->nextPageUrl()}}"><i class="fa fa-angle-right"></i></a>
        @endif
    </div>

@endif








{{--<div class="pagination__option">--}}
    {{--{{$product->links()}}--}}

    {{--<a href="#">{{$product->links()}}</a>--}}
    {{--<a href="#">3</a>--}}
    {{--<a href="#"><i class="fa fa-angle-right"></i></a>--}}
{{--</div>--}}