<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Property') }}
        </h2>
    </x-slot>

    {{-- Create Property --}}
    @livewire('property.create-property')
</x-app-layout>
