<div class="pt-12 pb-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex items-baseline">
                <h2 class="text-xl font-regular pt-2 pb-4">
                    Checklist Details
                </h2>

                @if ($checklist->is_primary)
                    <span class="ml-2 text-xs text-gray-500">Primary</span>
                @else
                    <span class="ml-2 text-xs text-gray-500">Secondary</span>
                @endif

                @if ($checklist->completed)
                    <span class="ml-2 text-xs text-green-500">Completed</span>
                @endif

                @if (!$checklist->is_primary)
                    {{-- Link to primary --}}
                    <a href="{{ route('auditChecklist.show', $checklist->primary_audit_checklist_id) }}"
                        class="ml-auto text-xs text-blue-500 hover:text-blue-700 hover:underline">View Primary</a>
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Checklist Item type --}}
                <div>
                    <x-jet-label for="item_type_id" :value="__('Item type')" />
                    @error('item_type_id')
                        <label for="item_type_id" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <x-input-select id="item_type_id" wire:model="item_type_id" :disabled="!$editing">
                        <option value="">Select audit type</option>
                        @foreach ($item_types as $id => $item_type)
                            <option value="{{ $id }}">{{ $item_type }}</option>
                        @endforeach
                    </x-input-select>
                </div>

                {{-- Rooms --}}
                @if ($item_type_id == 2)
                    <div>
                        <x-jet-label for="room_id" :value="__('Room')" />
                        @error('room_id')
                            <label for="room_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="room_id" wire:model="room_id" :disabled="!$editing">
                            <option value="">Select room</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>
                @endif

                {{-- Primary Furniture --}}
                @if ($item_type_id == 1)
                    <div>
                        <x-jet-label for="primary_furniture_id" :value="__('Primary Furniture')" />
                        @error('primary_furniture_id')
                            <label for="primary_furniture_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        @error('room_id')
                            <label for="room_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="primary_furniture_id" wire:model="primary_furniture_id" :disabled="!$editing">
                            <option value="">Select primary furniture</option>
                            @foreach ($primary_furnitures as $primary_furniture)
                                <option value="{{ $primary_furniture->id }}">{{ $primary_furniture->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>
                @endif

                {{-- Secondary Furniture --}}
                @if ($item_type_id == 1 && $secondary_furniture_id)
                    <div>
                        <x-jet-label for="secondary_furniture_id" :value="__('Secondary Furniture')" />
                        @error('secondary_furniture_id')
                            <label for="secondary_furniture_id"
                                class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="secondary_furniture_id" wire:model="secondary_furniture_id">
                            <option value="">Select secondary furniture</option>
                            @foreach ($secondary_furnitures as $secondary_furniture)
                                <option value="{{ $secondary_furniture->id }}">{{ $secondary_furniture->name }}
                                </option>
                            @endforeach
                        </x-input-select>
                    </div>
                @endif

                {{-- Name --}}
                <div class="md:col-span-3 md:grid md:grid-cols-3">
                    <div>
                        <x-jet-label for="name" :value="__('Name')" />
                        @error('name')
                            <label for="name" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                            :disabled="!$editing" />
                    </div>
                </div>

                {{-- Remarks --}}
                <div class="md:col-span-3">
                    <x-jet-label for="remarks" :value="__('Remarks')" />
                    @error('remarks')
                        <label for="remarks" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <x-textarea id="remarks" class="w-full" wire:model="remarks" :disabled="!$editing" />
                </div>
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
                    @if ($this->saved === true)
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
