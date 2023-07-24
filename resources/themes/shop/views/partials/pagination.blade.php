@if ($paginator->hasPages())
    <div class="pagination shop mt-5">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="page-item previous">
                <i class="icon angle-left-icon"></i>
            </a>
        @else
            <a data-page="{{ urldecode($paginator->previousPageUrl()) }}" href="{{ urldecode($paginator->previousPageUrl()) }}" id="previous" class="page-item previous">
                <i class="icon angle-left-icon"></i>
            </a>
        @endif

        @if ($paginator->lastPage() > 1)

                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <?php
                    $half_total_links = 4;
                    $from = $paginator->currentPage() - $half_total_links;
                    $to = $paginator->currentPage() + $half_total_links;
                    if ($paginator->currentPage() < $half_total_links) {
                        $to += $half_total_links - $paginator->currentPage();
                    }
                    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
                    ?>
                    @if ($from < $i && $i < $to)

                            @if ($i == $paginator->currentPage())
                                <a class="page-item active">
                                    {{ $i }}
                                </a>
                            @else
                                <a class="page-item as" href="{{ $paginator->url($i) }}">
                                    {{ $i }}
                                </a>
                            @endif
                    @endif
                @endfor

        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ urldecode($paginator->nextPageUrl()) }}" data-page="{{ urldecode($paginator->nextPageUrl()) }}" id="next" class="page-item next">
                <i class="icon angle-right-icon"></i>
            </a>
        @else
            <a class="page-item next">
                <i class="icon angle-right-icon"></i>
            </a>
        @endif
    </div>
@endif
