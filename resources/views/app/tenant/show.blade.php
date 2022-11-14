<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tenant Details') }}
        </h2>
    </x-slot>

    @livewire('property.property-tenant', ['tenant' => $tenant])

    {{-- Tenants --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex justify-between mb-6">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">All Tenants (Related)</h2>
                </div>
                <livewire:tenant-table property_id="{{ $property->id }}" primary_tenant_id="{{ $tenant->primary_tenant_id }}" />
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex justify-between mb-6">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">All Documents</h2>
                    <x-jet-button
                        onclick="Livewire.emit('openModal', 'property.upload-tenant-document-modal', {{ json_encode(['tenant_id' => $tenant->id]) }})"
                        class="cursor-pointer">Add New</x-jet-button>
                </div>
                <livewire:property.tenant-document-table tenant_id="{{ $tenant->id }}" />
            </div>
        </div>
    </div>
</x-app-layout>
