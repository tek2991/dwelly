<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Assign Audit to Property</h2>
            {{-- Error Message --}}
            @if ($err)
                <div class="my-3">
                    <label class="text-sm font-semibold text-red-700 block">
                        {{ $err }}
                    </label>
                </div>
            @endif

            @if ($audit->completed)
                
            @else
                <div class="my-3">
                    <label class="text-sm font-semibold text-red-700 block">
                        Audit Not Completed
                    </label>
                </div>
            @endif
        </div>
    </div>
</div>
