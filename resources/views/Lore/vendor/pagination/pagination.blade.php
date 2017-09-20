@if ($paginator->hasPages())
    <div class="pager">
        <div class="row" style="margin: 0;">
            <div class="col">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <div class="page-item disabled"><span class="page-link">@lang('pagination.previous')</span></div>
                @else
                    <div class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></div>
                @endif
            </div>

            <div class="col">

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <div class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></div>
                @else
                    <div class="page-item disabled"><span class="page-link">@lang('pagination.next')</span></div>
                @endif
            </div>
        </div>
    </div>
@endif
