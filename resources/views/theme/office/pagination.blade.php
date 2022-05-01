@if ($paginator->hasPages())
<ul class="pagination pagination-circle pagination-sm">
    @if ($paginator->onFirstPage())
    <li class="page-item disabled">
        <a halaman="{{ $paginator->previousPageUrl() }}" class="page-link paginasi" href="javascript:void(0);" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>
    @else
    <li class="page-item disabled">
        <a class="page-link paginasi" href="javascript:void(0);" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>
    @endif
    @foreach ($elements as $element)
        @if (is_string($element))
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active">
                        <a class="page-link paginasi" href="javascript:void(0);">{{ $page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a halaman="{{ $url }}" class="page-link paginasi" href="javascript:void(0);">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
    <li class="page-item">
        <a halaman="{{ $paginator->nextPageUrl() }}" class="page-link paginasi" href="javascript:void(0);" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
    @else
    <li class="page-item disabled">
        <a class="page-link paginasi" href="javascript:void(0);" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
    @endif
</ul>
@endif