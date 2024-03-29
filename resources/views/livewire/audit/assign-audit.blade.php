<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Assign Audit to Property</h2>
            {{-- Error Message --}}
            @if ($err)
                <div class="my-3">
                    <label class="text-sm font-semibold text-red-700 block">
                        {{ $err }}
                    </label>
                </div>
            @endif


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <x-jet-label for="create_or_assign" :value="__('Assign or Create a new Property')" />
                    @error('create_or_assign')
                        <label for="create_or_assign" class="text-xs text-red-700 block">{{ $message }}</label>
                    @enderror
                    <x-input-select id="assign_or_create" wire:model="assign_or_create" :disabled="!$editing">
                        <option value="1">Create New Property</option>
                        <option value="2">Select existing property</option>
                    </x-input-select>
                </div>
                @if ($assign_or_create == 2)
                    <div>
                        <x-jet-label for="property_id" :value="__('Property')" />
                        @error('property_id')
                            <label for="property_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="property_id" wire:model="property_id" :disabled="!$editing">
                            <option value="">Select property</option>
                            @foreach ($properties as $property)
                                <option value="{{ $property->id }}">
                                    {{ $property->code . ' - ' . $property->building_name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>
                @endif
            </div>
            <div class="flex justify-end mt-4">
                @if ($editing === true)
                    <div class="flex justify-end mt-4">
                        <x-jet-button class="ml-4" wire:click="assign">
                            {{ $assign_or_create == 1 ? 'Create Property' : 'Assign Property' }}
                        </x-jet-button>

                        <x-jet-button wire:click="cancel" class="ml-8 bg-red-500 hover:bg-red-600">
                            {{ __('Cancel') }}
                        </x-jet-button>
                    </div>
                @else
                    <div class="flex justify-end mt-4">
                        @if ($this->updated === true)
                            <div class="text-sm text-gray-600 mt-3">
                                {{ __('Saved.') }}
                            </div>
                        @endif
                        @if ($editable)
                            <x-jet-button wire:click="edit" class="ml-4">
                                {{ __('Edit') }}
                            </x-jet-button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
