<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Bank Details') }}
        </h2>
    </x-slot>

    {{-- Create Bank Details --}}
    @livewire('property.create-bank-detail', ['owner_or_tenant' => $owner_or_tenant])
</x-app-layout>
