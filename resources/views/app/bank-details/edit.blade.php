<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bank Details') }}
        </h2>
    </x-slot>

    {{-- Edit Bank Details --}}
    @livewire('property.edit-bank-detail', ['bankDetail' => $bankDetail])
</x-app-layout>
