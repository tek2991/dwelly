<div class="bg-white rounded-lg shadow dark:bg-gray-700">
    <button type="button" wire:click="$emit('closeModal')"
        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
    <div class="p-6">
        <h3 class="my-2 text-lg font-normal text-gray-500 dark:text-gray-400 text-center">
            Complete Property Onboarding
        </h3>

        @if ($canBeCompleted)
            <p class="py-3 font-semibold">
                Data cannot once onboarding is complete. Please ensure all data is correct before proceeding.
            </p>
            <div class="pt-4 pb-2">
                <button wire:click="completeOnboarding" type="button"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Complete Onboarding
                </button>
            </div>
        @else
            <div class="py-4">
                <p class="py-3 font-semibold">
                    Please complete the following audit before proceeding:
                </p>
                <ul class="list-disc pl-6 text-orange-700">
                    {{-- Property --}}
                    @if (!$onboarding->property_data)
                        <li>Property Data</li>
                    @endif
                    {{-- Owner --}}
                    @if (!$onboarding->owner_data)
                        <li>Owner Data</li>
                    @endif
                    {{-- Amenities --}}
                    @if (!$onboarding->amenities_data)
                        <li>Amenities</li>
                    @endif
                    {{-- room --}}
                    @if (!$onboarding->rooms_data)
                        <li>Room Data</li>
                    @endif
                    {{-- furniture --}}
                    @if (!$onboarding->furnitures_data)
                        <li>Furniture Data</li>
                    @endif
                    {{-- Onboarding audit --}}
                    @if (!$onboarding->auditCompleted())
                        <li>Onboarding Audit</li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</div>
