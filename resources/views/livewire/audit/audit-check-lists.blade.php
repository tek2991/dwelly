<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Checklists</h2>
            <p class="mb-4 text-sm text-gray-700">Checklist items are generated during Audit creation.</p>
            {{-- Error Message --}}
            @if ($err)
                <div class="my-3">
                    <label for="tenant_id" class="text-sm font-semibold text-red-700 block">
                        {{ $err }}
                    </label>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($audit_checklists as $item)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <div class="flex justify-between">
                            <h3 class="text-gray-700 font-semibold text-lg w-full">{{ $item->checklistable->name }}</h3>
                            <h3 class="text-gray-700 font-semibold text-md text-right w-full">Total: {{ $item->total }}</h3>
                        </div>
                        <div class="flex items center justify-between mt-3">
                            @if ($editing)                                
                            <div>
                                <x-jet-label for="good-{{ $item->checklistable->id }}" :value="__('Good')" />
                                <x-jet-input id="good-{{ $item->checklistable->id }}" class="block mt-1" type="number"
                                    wire:model="checklist.{{ $item->checklistable->id }}.good" />
                            </div>
                            <div>
                                <x-jet-label for="bad-{{ $item->checklistable->id }}" :value="__('Bad')" />
                                <x-jet-input id="bad-{{ $item->checklistable->id }}" class="block mt-1" type="number"
                                    wire:model="checklist.{{ $item->checklistable->id }}.bad" />
                            </div>
                            @else
                            <div>
                                <x-jet-label for="good-{{ $item->checklistable->id }}" :value="__('Good')" />
                                <x-jet-input id="good-{{ $item->checklistable->id }}" class="block mt-1" type="number" disabled
                                    value="" />
                            </div>
                            <div>
                                <x-jet-label for="bad-{{ $item->checklistable->id }}" :value="__('Bad')" />
                                <x-jet-input id="bad-{{ $item->checklistable->id }}" class="block mt-1" type="number" disabled
                                    value="" />
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
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
                    @else
                        <x-jet-button class="ml-4" disabled>
                            {{ __('Audit Completed') }}
                        </x-jet-button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
