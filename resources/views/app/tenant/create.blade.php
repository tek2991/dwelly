<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Tenant') }}
        </h2>
    </x-slot>

    {{-- Create Tenant --}}
    @livewire('property.create-tenant', ['property' => $property])

</x-app-layout>
