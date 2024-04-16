<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Audit Checklist') }}
            </h2>

            <x-button-link href="{{ route('audit.edit', $audit) }}">
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

    @if ($auditChecklist->checklistable->hasSecondaryItems())
        <livewire:audit.checklist-checklist :primary_audit_checklist_id="$auditChecklist->id" />
    @endif

    @livewire('audit.complete-checklist', ['auditChecklist' => $auditChecklist])

    @if (auth()->user()->hasRole('admin'))
        @livewire('audit.verify-checklist', ['auditChecklist' => $auditChecklist])
    @endif

</x-app-layout>
