<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex items-baseline justify-between">
                <h2 class="text-xl font-regular pt-2 pb-4">Task</h2>
                @if (!$editable)
                    <span class="ml-2 text-xs text-green-500">Completed</span>
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-3">
                    <x-jet-label for="description" :value="__('Description')" />
                    <x-textarea id="description" class="block mt-1 w-full" wire:model="description"
                        disabled="{{ !$editing }}">
                    </x-textarea>
                </div>

                <div class="mt-3">
                    <x-jet-label for="priority" :value="__('Priority')" />
                    <x-input-select id="priority" class="block mt-1 w-full" wire:model="priority_id"
                        disabled="{{ !$editing }}">
                        <option value="">Select a priority</option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}">
                                {{ $priority->name }}</option>
                        @endforeach
                    </x-input-select>
                </div>
                <div class="mt-3">
                    <x-jet-label for="assigned_to" :value="__('Assigned To')" />
                    <x-input-select id="assigned_to" class="block mt-1 w-full" wire:model="assigned_to"
                        disabled="{{ !$editing }}">
                        <option value="">Select a user</option>
                        @foreach ($usersWithPerms as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}</option>
                        @endforeach
                    </x-input-select>
                </div>
                <div class="mt-3">
                    <x-jet-label for="task_state" :value="__('Current Status')" />
                    <x-jet-input id="task_state" type="text" class="block mt-1 w-full" disabled
                        value="{{ $task->taskState->name }}" />
                </div>
                <div class="mt-3">
                    <x-jet-label for="task_type" :value="__('Task Type')" />
                    <x-jet-input id="task_type" type="text" class="block mt-1 w-full" disabled
                        value="{{ substr(strrchr($task->taskable_type, '\\'), 1) }}" />
                </div>
                <div class="mt-3">
                    <x-jet-label for="created_by" :value="__('Created By')" />
                    <x-jet-input id="created_by" type="text" class="block mt-1 w-full" disabled
                        value="{{ $task->createdBy->name }}" />
                </div>
                <div class="mt-3">
                    <x-jet-label for="created_at" :value="__('Created At')" />
                    <x-jet-input id="created_at" type="text" class="block mt-1 w-full" disabled
                        value="{{ $task->created_at }}" />
                </div>

            </div>
            @can('update', $task)
                @if ($editing === true)
                    <div class="flex justify-end mt-4">
                        <x-jet-button wire:click="update" class="ml-4">
                            {{ __('Update') }}
                        </x-jet-button>

                        <x-jet-button wire:click="cancel" class="ml-8 bg-red-500 hover:bg-red-600">
                            {{ __('Cancel') }}
                        </x-jet-button>
                    </div>
                @else
                    <div class="flex justify-end mt-4">
                        @if ($this->updated === true)
                            <div class="text-sm text-gray-600 mt-3">
                                {{ __('Saved.') }}
                            </div>
                        @endif
                        @if ($editable)
                            <x-jet-button wire:click="edit" class="ml-4">
                                {{ __('Edit') }}
                            </x-jet-button>
                        @endif
                    </div>
                @endif
            @endcan
        </div>
    </div>
</div>
