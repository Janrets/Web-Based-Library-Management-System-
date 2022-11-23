<style>

.active span{

    border-color: gray !important;
  
}



</style>

@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" style="color: black !important;" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link shadow-none"  aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item" style="color: black !important;">
                    <a class="page-link shadow-none" style="color: black !important;" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link shadow-none">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" style="color: black !important;" aria-current="page"><span class="page-link shadow-none bg-gray">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link shadow-none" style="color: black !important;" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link shadow-none shadow-none" style="color: black !important;" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" style="color: black !important;" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link shadow-none"  aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
