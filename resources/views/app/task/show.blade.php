<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="text-xl font-regular pt-2 pb-4">Task</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-3">
                        <x-jet-label for="description" :value="__('Description')" />
                        <x-textarea id="description" class="block mt-1 w-full" readonly>
                            {{ $task->description }}
                        </x-textarea>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="task_state" :value="__('Current Status')" />
                        <x-jet-input id="task_state" type="text" class="block mt-1 w-full" readonly
                            value="{{ $task->taskState->name }}" />
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="priority" :value="__('Priority')" />
                        <x-jet-input id="priority" type="text" class="block mt-1 w-full" readonly
                            value="{{ $task->priority->name }}" />
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="task_type" :value="__('Task Type')" />
                        <x-jet-input id="task_type" type="text" class="block mt-1 w-full" readonly
                            value="{{ substr(strrchr($task->taskable_type, '\\'), 1) }}" />
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="assigned_to" :value="__('Assigned To')" />
                        <x-jet-input id="assigned_to" type="text" class="block mt-1 w-full" readonly
                            value="{{ $task->assignedTo->name }}" />
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="created_by" :value="__('Created By')" />
                        <x-jet-input id="created_by" type="text" class="block mt-1 w-full" readonly
                            value="{{ $task->createdBy->name }}" />
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="created_at" :value="__('Created At')" />
                        <x-jet-input id="created_at" type="text" class="block mt-1 w-full" readonly
                            value="{{ $task->created_at }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (substr(strrchr($task->taskable_type, '\\'), 1) == 'Audit')
        <livewire:audit.audit-description :audit="$task->taskable" :disabled="true" />
    @endif
</x-app-layout>
