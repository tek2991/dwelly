<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Rooms</h2>
            @if ($disabled)
                <p class="text-sm text-red-500 pb-4">
                    You can't update your rooms data after starting onboarding audit.
                </p>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($rooms as $id => $room)
                    <div>
                        <x-jet-label for="room_{{ $room['id'] }}" :value="__($room['name'])" />
                        <input id="room_{{ $room['id'] }}" type="number" name="room_{{ $room['id'] }}" :disabled="$disabled"
                            wire:model="rooms.{{ $id }}.quantity"
                            class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100" />
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end mt-4">
                <x-jet-button wire:click="save" :disabled="$disabled" class="ml-4">
                    {{ __('Update') }}
                </x-jet-button>
            </div>
        </div>
    </div>
</div>
