<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Contacts & Bookings') }}
                @if ($rentout_id)
                    <span class="text-green-800 font-md ml-4">(Filtered by rent out)</span>
                @endif
            </h2>
            @if ($rentout_id)
                <a href="{{ route('contactForm.index') }}" class="text-sm font-semibold text-blue-700 hover:underline">Back to all contacts</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <livewire:contact-table :rentout_id="$rentout_id" />
            </div>
        </div>
    </div>
</x-app-layout>
