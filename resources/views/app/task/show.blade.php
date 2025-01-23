<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    @livewire('task.task-description', ['task' => $task])

    @if ($task->taskable instanceof App\Models\Audit)
        <livewire:audit.audit-description :audit="$task->taskable" :readonly="true" />
    @endif


    @if ($task->taskable instanceof App\Models\Audit)
        {{-- <livewire:task.reopen-audit :task="$task" /> --}}
    @endif

    @if ($task->taskable instanceof App\Models\Onboarding)
        <livewire:task.onboarding-summary :onboarding="$task->taskable" />
    @endif
    {{-- <livewire:task.task-complete :task="$task" /> --}}

</x-app-layout>
