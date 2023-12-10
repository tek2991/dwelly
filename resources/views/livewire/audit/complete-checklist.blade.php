<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Complete Checklist</h2>
            {{-- Error Message --}}
            @if ($err)
                <div class="my-3">
                    <label class="text-sm font-semibold text-red-700 block">
                        {{ $err }}
                    </label>
                </div>
            @endif


            @if ($editable)
                <div class="my-3">
                    <label class="inline-flex items-center">
                        <x-jet-checkbox wire:model="confirm" />
                        <span class="ml-2">Confirm Checklist Completion</span>
                    </label>
                </div>
                <div class="flex justify-end mt-4">
                    <x-jet-button wire:click="complete" class="ml-4">
                        {{ __('Save') }}
                    </x-jet-button>
                </div>
            @else
                <div class="my-3">
                    <label class="inline-flex items-center">
                        <span class="ml-2">Checklist Completed 
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 ml-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </label>
                </div>
                <div class="flex justify-end mt-4">
                    <x-jet-button wire:click="complete" class="ml-4" disabled>
                        {{ __('Saved') }}
                    </x-jet-button>
                </div>
            @endif
        </div>
    </div>
</div>
