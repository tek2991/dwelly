<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="text-xl font-regular pt-2 pb-4">Add Checklist</h2>
            <form wire:submit.prevent="store">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Checklist Item type --}}
                    <div>
                        <x-jet-label for="item_type_id" :value="__('Item type')" />
                        @error('item_type_id')
                            <label for="item_type_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="item_type_id" wire:model="item_type_id">
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
                            <x-input-select id="room_id" wire:model="room_id">
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
                                <label for="primary_furniture_id"
                                    class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            @error('room_id')
                                <label for="room_id" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-input-select id="primary_furniture_id" wire:model="primary_furniture_id">
                                <option value="">Select primary furniture</option>
                                @foreach ($primary_furnitures as $primary_furniture)
                                    <option value="{{ $primary_furniture->id }}">{{ $primary_furniture->name }}</option>
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
                <div class="flex justify-end mt-4">
                    <x-jet-button class="ml-4">
                        {{ __('Create') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</div>
