<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Furniture') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="text-xl font-regular pt-2 pb-4">Furniture details</h2>
                <form action="{{ route('furniture.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-jet-label for="name" :value="__('Name')" />
                            @error('name')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ old('name') }}" />
                        </div>
                        <div>
                            <x-jet-label for="icon_path" :value="__('Icon')" />
                            @error('icon_path')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <div class="flex space-x-3 items-center">
                                <x-jet-input id="icon_path" class="block mt-1 w-full" type="file"
                                    value="{{ old('icon_path') }}" />
                                @if (old('icon_path') != '')
                                    <img src="{{ url('storage/' . old('icon_path')) }}" alt="icon" class="w-8 h-8">
                                @endif
                            </div>
                        </div>
                        <div>
                            <x-jet-label for="show" :value="__('Show on website')" />
                            @error('show')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <x-input-select id="show" class="block mt-1 w-full" name="show">
                                <option value="1" {{ old('show') == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('show') == 0 ? 'selected' : '' }}>No</option>
                            </x-input-select>
                        </div>
                        <div>
                            <x-jet-label for="primary_furniture_id" :value="__('Primary Furniture')" />
                            @error('primary_furniture_id')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <x-input-select id="primary_furniture_id" class="block mt-1 w-full" name="primary_furniture_id">
                                <option value="">Self</option>
                                @foreach ($primaryFurnitures as $p_furniture)
                                    <option value="{{ $p_furniture->id }}"
                                        {{ $p_furniture->id == old('primary_furniture_id') ? 'selected' : '' }}>
                                        {{ $p_furniture->name }}
                                    </option>
                                @endforeach
                            </x-input-select>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Update') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
