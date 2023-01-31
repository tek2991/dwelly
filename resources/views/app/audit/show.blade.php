<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Details') }}
        </h2>
    </x-slot>

    <livewire:audit.audit-description :audit="$audit" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex justify-between mb-6">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Checklist items</h2>
                    @if (!$audit->completed)
                        <x-button-link href="{{ route('auditChecklist.create', ['audit' => $audit]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>Add</span>
                        </x-button-link>
                    @endif
                </div>

                <livewire:audit.audit-checklist-table :audit="$audit" />
            </div>
        </div>
    </div>

    <livewire:audit.complete-audit :audit="$audit" />

    <livewire:audit.assign-audit :audit="$audit" />

</x-app-layout>
