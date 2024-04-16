<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Owner Details') }}
        </h2>
    </x-slot>

    @livewire('property.property-owner', ['owner' => $owner])

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex justify-between mb-6">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Documents</h2>
                    <x-jet-button
                        onclick="Livewire.emit('openModal', 'property.upload-owner-document-modal', {{ json_encode(['owner_id' => $owner->id]) }})"
                        class="cursor-pointer">Add New</x-jet-button>
                </div>
                <livewire:property.owner-document-table owner_id="{{ $owner->id }}" />
            </div>
        </div>
    </div>
</x-app-layout>
