<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Amenities</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($amenities as $id => $amenity)
                    <div>
                        <x-jet-label for="amenity_{{ $amenity['id'] }}" :value="__($amenity['name'])" />
                        <select id="amenity_{{ $amenity['id'] }}" wire:model="amenities.{{ $loop->index }}.has"
                            class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100" />
                        <option value="0">
                            No</option>
                        <option value="1">
                            Yes</option>
                        </select>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end mt-4">
                <x-jet-button wire:click="save" class="ml-4">
                    {{ __('Update') }}
                </x-jet-button>
            </div>
        </div>
    </div>
</div>
