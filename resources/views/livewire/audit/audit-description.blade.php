<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex items-baseline justify-between">
                <h2 class="text-xl font-regular pt-2 pb-4">
                    Audit Details
                </h2>

                @if ($audit->completed)
                    <span class="ml-2 text-xs text-green-500">Completed</span>
                @endif

            </div>
            @if ($readonly)
                {{-- Link to audit --}}
                <div class="mb-3">
                    <a href="{{ route('audit.edit', $audit->id) }}"
                        class="text-blue-500 hover:text-blue-700 hover:underline">
                        View Audit
                    </a>
                </div>
            @endif
            {{-- Error Message --}}
            @if ($err)
                <div class="my-3">
                    <label for="tenant_id" class="text-sm font-semibold text-red-700 block">
                        {{ $err }}
                    </label>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Property code --}}
                <div>
                    <x-jet-label for="code" :value="__('Property Code')" />
                    <x-jet-input id="code" class="block mt-1 w-full" type="text" disabled
                        value="{{ $audit->property ? $audit->property->code : 'NA' }}" />
                </div>
                {{-- Audit Type --}}
                <div>
                    <x-jet-label for="type" :value="__('Audit Type')" />
                    <x-jet-input id="type" class="block mt-1 w-full" type="text" disabled
                        value="{{ $audit->auditType->name }}" />
                </div>
                {{-- Audit Date --}}
                <div>
                    <x-jet-label for="date" :value="__('Audit Date (YYYY-MM-DD)')" />
                    <x-jet-input id="date" class="block mt-1 w-full" type="text" disabled
                        value="{{ $audit->audit_date }}" />
                </div>
                {{-- Created by --}}
                <div>
                    <x-jet-label for="created_by" :value="__('Created By')" />
                    <x-jet-input id="created_by" class="block mt-1 w-full" type="text" disabled
                        value="{{ $audit->CreatedBy->name }}" />
                </div>
                {{-- Created at --}}
                <div>
                    <x-jet-label for="created_at" :value="__('Created At')" />
                    <x-jet-input id="created_at" class="block mt-1 w-full" type="text" disabled
                        value="{{ $audit->created_at }}" />
                </div>
                {{-- Completed at --}}
                <div>
                    <x-jet-label for="completed_at" :value="__('Completed At')" />
                    <x-jet-input id="completed_at" class="block mt-1 w-full" type="text" disabled
                        value="{{ $audit->completed ? $audit->updated_at : 'NA' }}" />
                </div>
                {{-- Description --}}
                <div class="md:col-span-3">
                    <x-jet-label for="description" :value="__('Description')" />
                    @if ($editing)
                        <x-textarea id="description" class="block mt-1 w-full" wire:model="description" />
                    @else
                        <x-textarea id="description" class="block mt-1 w-full" wire:model="description" disabled />
                    @endif
                </div>
            </div>
            @if (!$readonly)
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
            @endif
        </div>
    </div>
</div>
