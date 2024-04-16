<div class="bg-white rounded-lg shadow dark:bg-gray-700">
    <button type="button" wire:click="$emit('closeModal')"
        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
    @if (auth()->user()->can('update', $property))
        <div class="p-6 text-center">
            <h3 class="my-2 text-lg font-normal text-gray-500 dark:text-gray-400"> Create Nearby Establishment </h3>
            <div class="flex justify-between">
                <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900"> {{ $property->code }} </h3>
                <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900">
                    {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
                </h3>
                <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900"> {{ $property->locality->name }} </h3>
            </div>
            <div>
                <div class="flex flex-col text-start">

                    <div class="flex flex-col mt-4">
                        <label class="mb-1 text-xs font-bold tracking-wide text-gray-700 uppercase dark:text-gray-200"
                            for="establishment_type">Establishment Type</label>
                        @error('establishment_type_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        <select wire:model="establishment_type_id" id="establishment_type"
                            class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                            <option value="">Select Establishment Type</option>
                            @foreach ($establishmentTypes as $establishmentType)
                                <option value="{{ $establishmentType->id }}">
                                    {{ $establishmentType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col mt-4">
                        <label class="mb-1 text-xs font-bold tracking-wide text-gray-700 uppercase dark:text-gray-200"
                            for="description">Description</label>
                        @error('description')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        <textarea wire:model="description"
                            class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="description">
                        </textarea>
                    </div>

                    <div class="flex flex-col mt-4">
                        <label class="mb-1 text-xs font-bold tracking-wide text-gray-700 uppercase dark:text-gray-200"
                            for="distance">Distance (KM)</label>
                        @error('distance_in_kms')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        <input wire:model="distance_in_kms"
                            class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="distance" type="number" placeholder="Distance">
                    </div>
                </div>
                <button type="button" wire:click="save"
                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Save
                </button>
                <button type="button" wire:click="$emit('closeModal')" id="close-modal"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Cancel
                </button>
            </div>
        </div>
    @else
        <div class="p-6 text-center">
            <h3 class="my-2 text-lg font-normal text-gray-500 dark:text-gray-400">
                You are not authorized to create nearby establishment.
            </h3>
        </div>
    @endif
</div>
