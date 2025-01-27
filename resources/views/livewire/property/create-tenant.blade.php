<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
                <a href="{{ route('property.edit', $property) }}"
                    class="ml-3 text-lg text-blue-700 font-bold hover:underline">
                    {{ $property->code }}
                </a>
            </h2>
            <form wire:submit.prevent="store">
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Name --}}
                    <div>
                        <x-jet-label for="name" :value="__('Name')" />
                        @error('name')
                            <label for="name" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model="name" required />
                    </div>
                    {{-- Email --}}
                    <div>
                        <x-jet-label for="email" :value="__('Email')" />
                        @error('email')
                            <label for="email" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                            wire:model="email" required />
                    </div>
                    {{-- Phone --}}
                    <div>
                        <x-jet-label for="phone_1" :value="__('Phone')" />
                        @error('phone_1')
                            <label for="phone_1" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="phone_1" class="block mt-1 w-full" type="text" name="phone_1"
                            wire:model="phone_1" required />
                    </div>
                    {{-- Phone 2 --}}
                    <div>
                        <x-jet-label for="phone_2" :value="__('Phone Alternate')" />
                        @error('phone_2')
                            <label for="phone_2" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="phone_2" class="block mt-1 w-full" type="text" name="phone_2"
                            wire:model="phone_2" />
                    </div>
                    {{-- Moved in at --}}
                    <div>
                        <x-jet-label for="moved_in_at" :value="__('Moved In At')" />
                        @error('moved_in_at')
                            <label for="moved_in_at" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="moved_in_at" class="block mt-1 w-full" type="date" name="moved_in_at"
                            wire:model="moved_in_at" required />
                    </div>
                    {{-- Moved out at --}}
                    <div>
                        <x-jet-label for="moved_out_at" :value="__('Moved Out At')" />
                        @error('moved_out_at')
                            <label for="moved_out_at" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="moved_out_at" class="block mt-1 w-full" type="date" name="moved_out_at"
                            wire:model="moved_out_at" />
                    </div>
                    {{-- Is_primary --}}
                    <div>
                        <x-jet-label for="is_primary" :value="__('Is Primary')" />
                        @error('is_primary')
                            <label for="is_primary" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="is_primary" wire:model="is_primary">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </x-input-select>
                    </div>
                    {{-- Primary_tenant --}}
                    <div>
                        <x-jet-label for="primary_tenants" :value="__('Primary Tenant')" />
                        @error('primary_tenant_id')
                            <label for="primary_tenant_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        @if ($is_primary)
                            <x-input-select id="primary_tenant_id" wire:model="primary_tenant_id" disabled>
                                <option value="">Select Primary Tenant</option>
                                @foreach ($primary_tenants as $primary_tenant)
                                    <option value="{{ $primary_tenant->id }}">
                                        {{ $primary_tenant->user->name }}
                                    </option>
                                @endforeach
                            </x-input-select>
                        @else
                            <x-input-select id="primary_tenant_id" wire:model="primary_tenant_id">
                                <option value="">Select Primary Tenant</option>
                                @foreach ($primary_tenants as $primary_tenant)
                                    <option value="{{ $primary_tenant->id }}">
                                        {{ $primary_tenant->user->name }}
                                    </option>
                                @endforeach
                            </x-input-select>
                        @endif
                    </div>
                    <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Beneficiary_name --}}
                        <div>
                            <x-jet-label for="beneficiary_name" :value="__('Beneficiary Name')" />
                            @error('beneficiary_name')
                                <label for="beneficiary_name" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="beneficiary_name" class="block mt-1 w-full" type="text" name="beneficiary_name"
                                wire:model="beneficiary_name" required />
                        </div>
                        {{-- Bank_name --}}
                        <div>
                            <x-jet-label for="bank_name" :value="__('Bank Name')" />
                            @error('bank_name')
                                <label for="bank_name" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="bank_name" class="block mt-1 w-full" type="text" name="bank_name"
                                wire:model="bank_name" required />
                        </div>
                        {{-- ifsc --}}
                        <div>
                            <x-jet-label for="ifsc" :value="__('IFSC')" />
                            @error('ifsc')
                                <label for="ifsc" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="ifsc" class="block mt-1 w-full" type="text" name="ifsc" wire:model="ifsc"
                                required />
                        </div>
                        {{-- account_number --}}
                        <div>
                            <x-jet-label for="account_number" :value="__('Account Number')" />
                            @error('account_number')
                                <label for="account_number" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="account_number" class="block mt-1 w-full" type="text" name="account_number"
                                wire:model="account_number" required />
                        </div>
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
