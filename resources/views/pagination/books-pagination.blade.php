@if ($paginator->hasPages())
    <nav style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">

        {{-- Results info --}}
        <p style="font-size: 0.82rem; color: var(--ink-3); white-space: nowrap;">
            Showing
            <span style="font-weight: 600; color: var(--ink-2);">{{ $paginator->firstItem() }}</span>
            –
            <span style="font-weight: 600; color: var(--ink-2);">{{ $paginator->lastItem() }}</span>
            of
            <span style="font-weight: 600; color: var(--ink-2);">{{ $paginator->total() }}</span>
            results
        </p>

        {{-- Page links --}}
        <div style="display: flex; gap: 3px; align-items: center;">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="page-nav-btn disabled">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page-nav-btn" title="Previous page">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="page-btn" style="cursor: default; color: var(--ink-4);">…</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-btn active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page-nav-btn" title="Next page">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
            @else
                <span class="page-nav-btn disabled">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </span>
            @endif

        </div>
    </nav>

    <style>
        .page-btn,
        .page-nav-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            padding: 0 0.5rem;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 500;
            font-family: var(--font-sans);
            color: var(--ink-2);
            background: var(--white);
            border: 1px solid var(--border);
            text-decoration: none;
            transition: all .15s;
            cursor: pointer;
            line-height: 1;
        }

        .page-btn:hover,
        .page-nav-btn:hover {
            background: var(--surface);
            border-color: var(--blue);
            color: var(--blue);
        }

        .page-btn.active {
            background: var(--ink);
            color: white;
            border-color: transparent;
            box-shadow: 0 2px 6px rgba(15,17,23,.2);
        }

        .page-nav-btn.disabled {
            opacity: 0.35;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
@endif
