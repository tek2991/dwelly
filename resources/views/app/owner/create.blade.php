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
                </h2>
                <form method="POST" action="{{ route('owner.store') }}">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        
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
