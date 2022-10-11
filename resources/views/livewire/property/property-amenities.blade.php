<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Amenities</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($amenities as $id => $amenity)
                    <div>
                        <x-jet-label for="amenity_{{ $amenity['id'] }}" :value="__($amenity['name'])" />
                        <select id="amenity_{{ $amenity['id'] }}" wire:model="amenities.{{ $loop->index }}.has"
                            {{ $editing === true ? '' : 'disabled' }}
                            class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100" />
                        <option value="0">
                            No</option>
                        <option value="1">
                            Yes</option>
                        </select>
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
                    <x-jet-button wire:click="edit" class="ml-4">
                        {{ __('Edit') }}
                    </x-jet-button>
                </div>
            @endif
        </div>
    </div>
</div>
