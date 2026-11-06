@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="Pagination">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="disabled" aria-disabled="true">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;"><path d="M15 18l-6-6 6-6"/></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;"><path d="M15 18l-6-6 6-6"/></svg>
            </a>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span aria-hidden="true">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;"><path d="M9 18l6-6-6-6"/></svg>
            </a>
        @else
            <span class="disabled" aria-disabled="true">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;"><path d="M9 18l6-6-6-6"/></svg>
            </span>
        @endif
    </nav>
@endif
