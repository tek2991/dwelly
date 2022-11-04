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
        <h3 class="my-2 text-lg font-normal text-gray-500 dark:text-gray-400"> Upload Tenant Document </h3>
        <div class="flex justify-between">
            <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900"> {{ $property->code }} </h3>
            <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900">
                {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
            </h3>
            <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900"> {{ $property->locality->name }} </h3>
        </div>
        <div wire:ignore class="mt-4">
            <form wire:submit.prevent="saveDocument">
                {{-- Document Type --}}
                <div class="flex flex-col mb-4">
                    <label class="mb-2 text-sm font-bold text-gray-700 dark:text-gray-200" for="document_type_id">
                        Document Type
                    </label>
                    <select wire:model="document_type_id" id="document_type_id"
                        class="block w-full px-4 py-2 mt-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 focus:border-blue-500 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray"
                        required>
                        <option value="">Select Document Type</option>
                        @foreach ($documentTypes as $documentType)
                            <option value="{{ $documentType->id }}">
                                {{ $documentType->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('document_type_id')
                        <span class="text-xs text-red-500 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                {{-- File pond  --}}
                <x-filepond wire:model="file" allowFileSizeValidation maxFileSize="4mb" />
                @error('file')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <div class="flex justify-center">
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
