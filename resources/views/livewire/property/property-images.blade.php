<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" wire:sortable="updateImageOrder"
                wire:sortable.options="{ animation: 100 }">
                @foreach ($images as $image)
                    <div wire:sortable.item="{{ $image->id }}" wire:key="task-{{ $image->id }}" class="relative">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="property Image"
                            class="w-full h-56 object-cover block">
                        {{-- Dragable icon in the center --}}
                        <div wire:sortable.handle class="absolute top-4 left-4 cursor-move rounded-full bg-gray-700">
                            <svg class="w-6 h-6 text-gray-200 hover:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>

                        <div class="absolute bottom-4 left-4 bg-gray-700 rounded-md px-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox cursor-pointer disabled:cursor-not-allowed"
                                    wire:change="setCoverImage({{ $image->id }})" value="{{ $image->id }}"
                                    {{ $image->is_cover == 1 ? 'checked disabled' : '' }}>
                                <span class="ml-2 text-gray-200">Cover</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Upload Images form --}}
            <div class="mt-8">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Upload Images</h2>
                <div class="mt-4">
                    <form wire:submit.prevent="saveImages" class="flex items-center">
                        <input type="file" multiple wire:model="uploadedImages" class="form-input">
                        <x-jet-button class="ml-2">Upload</x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
