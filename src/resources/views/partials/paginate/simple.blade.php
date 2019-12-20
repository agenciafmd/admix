<div class="card-footer bg-gray-lightest">
    <div class="row" role="navigation">
        @if ($paginator->onFirstPage())
            <div class="col-sm-3 disabled" aria-disabled="true">
                {{--<span class="text-gray text-decoration-none">@lang('pagination.previous')</span>--}}
            </div>
        @else
            <div class="col-sm-3">
                <a href="{{ $paginator->previousPageUrl() }}" class="text-gray text-decoration-none"
                   rel="prev">@lang('pagination.previous')</a>
            </div>
        @endif
        <div class="col-sm-6 text-center">
                <span class="d-none d-md-block">
                    {{ (($paginator->currentPage() * $paginator->perPage()) - $paginator->perPage()) + 1 }} até
                    {{ (($paginator->currentPage() * $paginator->perPage()) > $paginator->total()) ? $paginator->total() : ($paginator->currentPage() * $paginator->perPage()) }} de
                    {{ $paginator->total() }} {{ ($paginator->total() <= 1) ? 'item' : 'itens' }}
                </span>
        </div>
        @if ($paginator->hasMorePages())
            <div class="col-sm-3 text-right">
                <a href="{{ $paginator->nextPageUrl() }}" class="text-gray text-decoration-none"
                   rel="next">@lang('pagination.next')</a>
            </div>
        @else
            <div class="col-sm-3 text-right disabled" aria-disabled="true">
                {{--<span class="text-gray text-decoration-none">@lang('pagination.next')</span>--}}
            </div>
        @endif
    </div>
</div>
