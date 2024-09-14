@if ($paginator->hasPages())

<div class="text-center">
    <div class="pagination">
        @if ($paginator->onFirstPage())
            <button class="disabled" aria-disabled="true">
                <i class="fal fa-angle-double-left"></i>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <button><i class="fal fa-angle-double-left"></i></button>
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <button class="disabled" aria-disabled="true">{{ $element }}</button>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="active">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}">
                            <button>{{ $page }}</button>
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                <button><i class="fal fa-angle-double-right"></i></button>
            </a>
        @else
            <button class="disabled" aria-disabled="true">
                <i class="fal fa-angle-double-right"></i>
            </button>
        @endif
    </div>
</div>
@endif
