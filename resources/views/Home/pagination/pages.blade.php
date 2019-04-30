@if ($paginator->hasPages())
<div class="productList_pages_Collect clearfix">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        {{--不能点击--}}
        <a href="" class="on">《</a>
    @else
        <a href="{{$paginator->lastPage()}}" >《</a>
    @endif
    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <a class="on">{{ $element }}</a>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    {{--不能点--}}
                    <a class="on">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">》</a>
    @else
        <a class="on"><span>》</span></a>
    @endif
</div>
@endif
