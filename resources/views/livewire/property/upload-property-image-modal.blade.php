<div class="bg-white rounded-lg shadow dark:bg-gray-700">
    <button type="button" wire:click="$emit('closeModal')"
        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
    <div class="p-6 text-center">
        <h3 class="my-2 text-lg font-normal text-gray-500 dark:text-gray-400"> Upload Property Image </h3>
        <div class="flex justify-between">
            <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900"> {{ $property->code }} </h3>
            <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900">
                {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
            </h3>
            <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900"> {{ $property->locality->name }} </h3>
        </div>
        <div>

        </div>
    </div>
</div>
