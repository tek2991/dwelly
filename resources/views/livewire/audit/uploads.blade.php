<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex justify-between pt-2 pb-4">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Uploads</h2>
                <div>
                    @if ($editable)
                        <x-jet-button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover"
                            data-dropdown-trigger="hover" type="button">Upload<svg class="w-4 h-4 ml-2" aria-hidden="true"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </x-jet-button>
                    @endif
                    <!-- Dropdown menu -->
                    <div id="dropdownHover"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                            <li>
                                <a href="#"
                                    onclick="Livewire.emit('openModal', 'audit.upload-image-modal', {{ json_encode(['checklist_id' => $checklist_id]) }})"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Image</a>
                            </li>
                            <li>
                                <a href="#"
                                    onclick="Livewire.emit('openModal', 'audit.upload-video-modal', {{ json_encode(['checklist_id' => $checklist_id]) }})"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Video</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                {{-- {{ $uploads }} --}}
                @forelse ($uploads as $upload)
                    <div class="relative">
                        @if ($upload->file_type == 'image')
                            <a href="{{ asset('storage/' . $upload->file_path) }}" data-lightbox="audit-img">
                                <img src="{{ asset('storage/' . $upload->file_path) }}" alt="property upload"
                                    class="w-full h-56 rounded-sm object-cover block ease-in-out duration-300">
                            </a>
                        @elseif ($upload->file_type == 'video')
                            <video src="{{ asset('storage/' . $upload->file_path) }}" controls alt="property upload"
                                class="w-full h-56 rounded-sm object-cover block ease-in-out duration-300"></video>
                        @endif
                        <p class="bg-gray-200 rounded-b-md p-2 text-gray-800 text-sm">
                            {{ $upload->remarks != null ? $upload->remarks : 'No remarks' }}
                        </p>
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
