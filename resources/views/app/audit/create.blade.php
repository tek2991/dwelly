<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Start Audit') }}
        </h2>
    </x-slot>

    <livewire:create-audit />
</x-app-layout>
