<th {{ $attributes->merge(['class' => 'px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase font-bold']) }}>
    <div class="flex @if ($attributes->has('sortable')) cursor-pointer @endif">
        {{ $slot }}
        @if ($attributes->has('sortable') && $currentSortBy == $sortBy)
            @if ($direction == 'asc')
            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            @else
            <svg class="ml-2 -mr-0.5 h-4 w-4 transform rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            @endif
        @endif
    </div>
</th>
