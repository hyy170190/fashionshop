@if ($paginator->hasPages())
    <div class="product__pagination">


        @foreach ($elements as $element)

            @if (is_string($element))
                <a class="disabled"><span>{{ $element }}</span></a>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active"><span>{{ $page }}</span></a>
                    @else
                        <a href="{{ $url }}" class="text-dark">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

    </div>
@endif
