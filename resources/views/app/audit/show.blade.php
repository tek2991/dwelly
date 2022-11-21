<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Details') }}
        </h2>
    </x-slot>

    <livewire:audit.audit-description :audit="$audit" />
</x-app-layout>
