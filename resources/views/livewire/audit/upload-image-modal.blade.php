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
        <h3 class="my-2 text-lg font-normal text-gray-500 dark:text-gray-400"> Upload Audit Image </h3>
        <div class="grid grid-cols-3">
            <h3 class="my-2 font-normal text-left text-gray-700 dark:text-gray-900">
                {{ $audit->auditType->name }}
            </h3>
            @if ($property != null)
                <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900"> {{ $audit->property->code }} </h3>
                @else
                <h3 class="my-2 font-normal text-gray-700 dark:text-gray-900"> New Property </h3>
            @endif
            <h3 class="my-2 font-normal text-right text-gray-700 dark:text-gray-900"> {{ $audit->audit_date }} </h3>
        </div>
        <div class="mt-4">
            <form wire:submit.prevent="saveImage">
                {{-- File pond  --}}
                <x-filepond wire:model="image" allowImagePreview allowFileTypeValidation imagePreviewMaxHeight="200"
                    allowFileTypeValidation acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation maxFileSize="4mb" allowImageResize />
                @error('image')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <div class="my-4">
                    <x-jet-label for="condition" value="{{ __('Condition') }}" />
                    <x-input-select id="condition" class="block mt-1 w-full" wire:model="condition">
                        <option value="">Select Condition</option>
                        <option value="1">Good</option>
                        <option value="0">Bad</option>
                    </x-input-select>
                    @error('condition')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="my-4">
                    <x-jet-label for="remarks" value="{{ __('Remarks') }}" />
                    <x-textarea id="remarks" class="block mt-1 w-full" type="text" wire:model="remarks"></x-textarea>
                    @error('remarks')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
