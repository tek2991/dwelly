<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex justify-between mb-6">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Images</h2>
                <x-jet-button
                    onclick="Livewire.emit('openModal', 'property.upload-property-image-modal', {{ json_encode(['property_id' => $property->id]) }})"
                    class="cursor-pointer">Upload</x-jet-button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" wire:sortable="updateImageOrder"
                wire:sortable.options="{ animation: 300 }">
                @foreach ($images as $image)
                    <div wire:sortable.item="{{ $image->id }}" wire:key="task-{{ $image->id }}" class="relative">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="property Image"
                            class="w-full h-56 rounded-sm object-cover block ease-in-out duration-300 {{ $image->show != 1 ? 'grayscale blur-sm' : '' }}">
                        {{-- Dragable icon in the center --}}
                        <div wire:sortable.handle class="absolute top-4 left-4 cursor-move rounded-full bg-gray-700">
                            <svg class="w-6 h-6 text-gray-200 hover:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                        {{-- Set as cover check box --}}
                        <div class="absolute bottom-4 left-4 bg-gray-700 rounded-md px-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox cursor-pointer disabled:cursor-not-allowed"
                                    wire:change="setCoverImage({{ $image->id }})" value="{{ $image->id }}"
                                    {{ $image->is_cover == 1 ? 'checked disabled' : '' }}>
                                <span class="ml-2 text-gray-200">
                                    {{-- Cover logo --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                    </svg>

                                </span>
                            </label>
                        </div>
                        {{-- Update image show attribute --}}
                        <div class="absolute bottom-4 right-4 bg-gray-700 rounded-md px-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox cursor-pointer disabled:cursor-not-allowed"
                                    wire:change="updateImageShow({{ $image->id }})"
                                    {{ $image->show == 1 ? 'checked' : '' }}
                                    {{ $image->is_cover == 1 ? 'disabled' : '' }}>
                                <span class="ml-2 text-gray-200">
                                    {{-- Eye logo --}}
                                    <svg class="w-6 h-6 text-gray-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 10h.01M9 16h.01M15 10h.01M15 16h.01M9 14h.01M15 14h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
