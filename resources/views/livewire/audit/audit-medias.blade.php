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
                    <div
                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ asset('storage/' . $image->media_path) }}" data-lightbox="audit-img">
                            <img class="rounded-t-lg w-full h-56 object-cover block"
                                src="{{ asset('storage/' . $image->media_path) }}" alt="Audit Image" />
                        </a>
                        <div class="p-2">
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $image->remarks }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex justify-between mb-6">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Videos</h2>
                <x-jet-button
                    onclick="Livewire.emit('openModal', 'audit.upload-audit-video-modal', {{ json_encode(['audit_id' => $audit->id]) }})"
                    class="cursor-pointer">Upload Video</x-jet-button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($videos as $video)
                    <div
                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <video class="rounded-t-lg w-full h-56 object-cover block" controls>
                            <source src="{{ asset('storage/' . $video->media_path) }}" type="video/mp4">
                        </video>
                        <div class="p-2">
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $video->remarks }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
