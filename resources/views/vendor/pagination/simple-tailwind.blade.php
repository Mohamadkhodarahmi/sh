@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}" class="flex justify-between items-center text-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="text-gray-400 cursor-default">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="text-black hover:opacity-60 transition">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Pagination Elements --}}
        <span class="text-gray-600">
            صفحه {{ $paginator->currentPage() }} از {{ $paginator->lastPage() }}
        </span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="text-black hover:opacity-60 transition">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="text-gray-400 cursor-default">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
