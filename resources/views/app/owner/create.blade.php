<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Owner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
                    {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
                    <a href="{{ route('property.show', $property) }}"
                        class="ml-3 text-lg text-blue-700 font-bold hover:underline">
                        {{ $property->code }}
                    </a>
                </h2>
                <form method="POST" action="{{ route('owner.store') }}">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div>
                            <x-jet-label for="name" :value="__('Name')" />
                            @error('name')
                                <label for="name" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus />
                        </div>
                        {{-- Email --}}
                        <div>
                            <x-jet-label for="email" :value="__('Email')" />
                            @error('email')
                                <label for="email" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                        </div>
                        {{-- Phone --}}
                        <div>
                            <x-jet-label for="phone_1" :value="__('Phone')" />
                            @error('phone')
                                <label for="phone_1" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="phone_1" class="block mt-1 w-full" type="text" name="phone_1"
                                :value="old('phone')" required />
                        </div>
                        {{-- Phone 2 --}}
                        <div>
                            <x-jet-label for="phone_2" :value="__('Phone Alternate')" />
                            @error('phone_2')
                                <label for="phone_2" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="phone_2" class="block mt-1 w-full" type="text" name="phone_2"
                                :value="old('phone_2')" />
                        </div>
                        {{-- Password --}}
                        <div>
                            <x-jet-label for="password" :value="__('Password')" />
                            @error('password')
                                <label for="password" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />
                        </div>
                        {{-- Password Confirmation --}}
                        <div>
                            <x-jet-label for="password" :value="__('Confirm Password')" />
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-jet-button class="ml-4" type="submit">
                            {{ __('Save') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
