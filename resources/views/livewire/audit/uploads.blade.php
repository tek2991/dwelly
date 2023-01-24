<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex justify-between mb-6">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Uploads</h2>
                <x-jet-button
                onclick="Livewire.emit('openModal', 'audit.upload-image-modal', {{ json_encode(['checklist_id' => $checklist_id]) }})"
                class="cursor-pointer">Upload</x-jet-button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- {{ $uploads }} --}}
                @forelse ($uploads as $upload)
                    <div class="relative">
                        @if ($upload->file_type == 'image')
                            <a href="{{ asset('storage/' . $upload->file_path) }}" data-lightbox="audit-img">
                                <img src="{{ asset('storage/' . $upload->file_path) }}" alt="property upload"
                                    class="w-full h-56 rounded-sm object-cover block ease-in-out duration-300">
                            </a>
                        @elseif ($upload->type == 'video')
                            <video src="{{ asset('storage/' . $upload->file_path) }}" alt="property upload"
                                class="w-full h-56 rounded-sm object-cover block ease-in-out duration-300"></video>
                        @endif
                    </div>
                @empty
                    <div class="">
                        <p class="text-gray-500">No uploads found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
