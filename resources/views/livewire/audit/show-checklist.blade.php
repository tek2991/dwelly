<div class="pt-12 pb-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="text-xl font-regular pt-2 pb-4">Checklist Details {{ $checklist->is_primary ? '(Primary)' : '(Secondary)' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Checklist Item type --}}
                <div>
                    <x-jet-label for="item_type_id" :value="__('Item type')" />
                    @error('item_type_id')
                        <label for="item_type_id" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <x-input-select id="item_type_id" wire:model="item_type_id" :disabled="$secondary_furniture_id">
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
                        <x-input-select id="room_id" wire:model="room_id" :disabled="$secondary_furniture_id">
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
                        <x-input-select id="primary_furniture_id" wire:model="primary_furniture_id" :disabled="$secondary_furniture_id">
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
                            <label for="secondary_furniture_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="secondary_furniture_id" wire:model="secondary_furniture_id">
                            <option value="">Select secondary furniture</option>
                            @foreach ($secondary_furnitures as $secondary_furniture)
                                <option value="{{ $secondary_furniture->id }}">{{ $secondary_furniture->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>
                @endif

                {{-- Remarks --}}
                <div class="md:col-span-3">
                    <x-jet-label for="remarks" :value="__('Remarks')" />
                    @error('remarks')
                        <label for="remarks" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <x-textarea id="remarks" class="w-full" wire:model="remarks" />
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
                    <x-jet-button wire:click="edit" class="ml-4">
                        {{ __('Edit') }}
                    </x-jet-button>
                </div>
            @endif
        </div>
    </div>
</div>
