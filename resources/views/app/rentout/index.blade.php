<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rentouts') }}
                @if ($contact_id)
                    submitted by {{ App\Models\Contact::find($contact_id)->name }}
                @endif
            </h2>
            @if ($contact_id)
                <a href="{{ route('rentOut.index') }}" class="text-sm font-semibold text-blue-700 hover:underline">Back to all rentouts</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <livewire:rent-out-table  :contact_id="$contact_id" />
            </div>
        </div>
    </div>
</x-app-layout>
