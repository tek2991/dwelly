<x-public-layout>
    <div class="mx-auto mt-8 flex Site-Max-Width p-4">
        <div class="overflow-y-scroll h-screen" id="filters">
            {{-- Filters --}}
        </div>
        <div>
            {{-- Properties --}}
        </div>
    </div>
    <style>
        #filters {
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
    scrollbar-width: none;  /* Firefox */
}
#filters::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}
        #properties {
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
    scrollbar-width: none;  /* Firefox */
}
#properties::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}
    </style>
</x-public-layout>
