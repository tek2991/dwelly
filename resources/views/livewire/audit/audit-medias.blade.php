<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex justify-between mb-6">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Images</h2>
                <x-jet-button
                    onclick="Livewire.emit('openModal', 'audit.upload-audit-image-modal', {{ json_encode(['audit_id' => $audit->id]) }})"
                    class="cursor-pointer">Upload Image</x-jet-button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($images as $image)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="property Image"
                            class="w-full h-56 rounded-sm object-cover block">
                        {{-- Remarks --}}
                        <div class="absolute top-0 right-0 bg-white rounded-sm p-2">
                            <p>
                                <span class="font-bold">Remarks:</span>
                                <span>{{ $image->remarks }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
