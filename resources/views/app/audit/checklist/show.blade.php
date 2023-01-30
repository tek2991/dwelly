<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Audit Checklist') }}
            </h2>

            <x-button-link href="{{ route('audit.show', $audit) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back</span>
            </x-button-link>
        </div>
    </x-slot>

    @livewire('audit.show-checklist', ['checklist_id' => $auditChecklist->id])

    @livewire('audit.uploads', ['checklist_id' => $auditChecklist->id])

    @if ($auditChecklist->is_primary)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-between mb-6">
                        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Checklist items</h2>
                        @if (!$audit->completed)
                            <x-button-link
                                href="{{ route('auditChecklist.create', ['audit' => $audit, 'primary_audit_checklist_id' => $auditChecklist->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span>Add Secondary Items</span>
                            </x-button-link>
                        @endif
                    </div>

                    <livewire:audit.audit-checklist-table :primary_audit_checklist_id="$auditChecklist->id" />
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
