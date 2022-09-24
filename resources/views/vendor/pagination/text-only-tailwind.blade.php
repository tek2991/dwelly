@if ($paginator->hasPages())
    <nav aria-label="{{ __('Pagination Description') }}" class="flex items-center justify-between">
        <div>
            <p class="text-lg leading-5 font-GraphikSemibold text-darker-3">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span>{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span>{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span>{{ $paginator->total() }}</span>
                {!! isset($resource) ? $resource : 'Results' !!}
            </p>
        </div>
    </nav>
@endif
