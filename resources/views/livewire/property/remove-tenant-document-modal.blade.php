<div class="bg-white rounded-lg shadow dark:bg-gray-700">
    <button type="button" wire:click="$emit('closeModal')"
        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
    @if (auth()->user()->can('update', $tenant))
        <div class="p-6 text-center">
            <h3 class="my-2 text-lg font-normal text-red-500 dark:text-red-400"> Delete Tenant Document </h3>
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
                            for="document_type">Document Type</label>
                        <select wire:model="document_type_id" id="document_type" disabled
                            class="block w-full px-4 py-3 mb-3 leading-tight disabled:bg-gray-100 text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                            <option value="">Select document Type</option>
                            @foreach ($document_types as $documentType)
                                <option value="{{ $documentType->id }}">
                                    {{ $documentType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </form>
                <button type="button" wire:click="destroy"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Delete
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
                You are not authorized to edit tenants data.
            </h3>
        </div>
    @endif
</div>
