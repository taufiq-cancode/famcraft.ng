@if ($paginator->hasPages())
    <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="paginate_button page-item previous disabled"><a class="page-link" aria-disabled="true">Previous</a></li>
            @else
                <li class="paginate_button page-item previous"><a href="{{ $paginator->previousPageUrl() }}" class="page-link">Previous</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="paginate_button page-item disabled"><a class="page-link">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button page-item active"><a class="page-link">{{ $page }}</a></li>
                        @else
                            <li class="paginate_button page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="paginate_button page-item next"><a href="{{ $paginator->nextPageUrl() }}" class="page-link">Next</a></li>
            @else
                <li class="paginate_button page-item next disabled"><a class="page-link" aria-disabled="true">Next</a></li>
            @endif
        </ul>
    </div>
@endif
