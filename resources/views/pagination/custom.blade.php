@if ($paginator->hasPages())
    <nav class="pagination-nav" role="navigation" aria-label="Paginação">
        <div class="pagination-container">
            <div class="pagination-info">
                <span>
                    Mostrando 
                    @if ($paginator->firstItem())
                        <strong>{{ $paginator->firstItem() }}</strong>
                        até 
                        <strong>{{ $paginator->lastItem() }}</strong>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    de 
                    <strong>{{ $paginator->total() }}</strong>
                    resultados
                </span>
            </div>

            <div class="pagination-buttons">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="pagination-btn pagination-btn-disabled" aria-disabled="true" aria-label="Página anterior">
                        <span aria-hidden="true">&laquo; Anterior</span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn pagination-btn-link" rel="prev" aria-label="Página anterior">
                        &laquo; Anterior
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="pagination-dots" aria-disabled="true">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="pagination-btn pagination-btn-active" aria-current="page">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="pagination-btn pagination-btn-link">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn pagination-btn-link" rel="next" aria-label="Próxima página">
                        Próxima &raquo;
                    </a>
                @else
                    <span class="pagination-btn pagination-btn-disabled" aria-disabled="true" aria-label="Próxima página">
                        <span aria-hidden="true">Próxima &raquo;</span>
                    </span>
                @endif
            </div>
        </div>
    </nav>
<style>
    .pagination-nav {
        width: 100%;
    }

    .pagination-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .pagination-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #cfe8f0;
        font-size: 0.875rem;
    }

    .pagination-info strong {
        color: #fefcfb;
        font-weight: 600;
    }

    .pagination-buttons {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .pagination-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 0.75rem;
        min-width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid rgba(254,252,251,.15);
        background: rgba(10,17,40,.45);
        color: #fefcfb;
        cursor: pointer;
    }

    .pagination-btn-link {
        color: #fefcfb;
        background: rgba(10,17,40,.45);
    }

    .pagination-btn-link:hover {
        background: rgba(254,252,251,.08);
        border-color: rgba(18,130,162,.5);
        color: #fefcfb;
        text-decoration: none;
    }

    .pagination-btn-active {
        background: rgba(18,130,162,.5);
        border-color: rgba(18,130,162,.7);
        color: #fefcfb;
        box-shadow: 0 2px 8px rgba(18,130,162,.3);
        cursor: default;
    }

    .pagination-btn-disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: rgba(10,17,40,.25);
        border-color: rgba(254,252,251,.08);
        color: #cfe8f0;
    }

    .pagination-dots {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
        color: #cfe8f0;
        font-size: 0.875rem;
    }

    @media (max-width: 640px) {
        .pagination-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination-buttons {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .pagination-info {
            text-align: center;
            justify-content: center;
        }
    }
</style>
@endif

