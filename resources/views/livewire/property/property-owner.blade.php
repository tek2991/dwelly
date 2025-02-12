<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="mb-6">
                <div>
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Owner</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Name --}}
                        <div>
                            <x-jet-label for="name" :value="__('Name')" />
                            @error('name')
                                <label for="name" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror

                            @if ($editing === true)
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name" />
                            @else
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name"
                                    disabled />
                            @endif
                        </div>
                        {{-- Email --}}
                        <div>
                            <x-jet-label for="email" :value="__('Email')" />
                            @error('email')
                                <label for="email" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror

                            @if ($editing === true)
                                <x-jet-input id="email" class="block mt-1 w-full" type="email"
                                    wire:model="email" />
                            @else
                                <x-jet-input id="email" class="block mt-1 w-full" type="email" wire:model="email"
                                    disabled />
                            @endif
                        </div>
                        {{-- Phone_1 --}}
                        <div>
                            <x-jet-label for="phone_1" :value="__('Phone 1')" />
                            @error('phone_1')
                                <label for="phone_1" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror

                            @if ($editing === true)
                                <x-jet-input id="phone_1" class="block mt-1 w-full" type="text"
                                    wire:model="phone_1" />
                            @else
                                <x-jet-input id="phone_1" class="block mt-1 w-full" type="text"
                                    wire:model="phone_1" disabled />
                            @endif
                        </div>
                        {{-- Phone_2 --}}
                        <div>
                            <x-jet-label for="phone_2" :value="__('Phone 2')" />
                            @error('phone_2')
                                <label for="phone_2" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror

                            @if ($editing === true)
                                <x-jet-input id="phone_2" class="block mt-1 w-full" type="text"
                                    wire:model="phone_2" />
                            @else
                                <x-jet-input id="phone_2" class="block mt-1 w-full" type="text"
                                    wire:model="phone_2" disabled />
                            @endif
                        </div>
                        {{-- Onboarded_at --}}
                        <div>
                            <x-jet-label for="onboarded_at" :value="__('Onboarded')" />
                            @error('onboarded_at')
                                <label for="onboarded_at" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror

                            @if ($editing === true)
                                <x-jet-input id="onboarded_at" class="block mt-1 w-full" type="date"
                                    wire:model="onboarded_at" />
                            @else
                                <x-jet-input id="onboarded_at" class="block mt-1 w-full" type="date"
                                    wire:model="onboarded_at" disabled />
                            @endif
                        </div>

                        <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- Beneficiary_name --}}
                            {{-- <div>
                                <x-jet-label for="beneficiary_name" :value="__('Beneficiary Name')" />
                                @error('beneficiary_name')
                                    <label for="beneficiary_name"
                                        class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                @if ($editing === true)
                                    <x-jet-input id="beneficiary_name" class="block mt-1 w-full" type="text"
                                        wire:model="beneficiary_name" />
                                @else
                                    <x-jet-input id="beneficiary_name" class="block mt-1 w-full" type="text"
                                        wire:model="beneficiary_name" disabled />
                                @endif
                            </div> --}}
                            {{-- Bank_name --}}
                            {{-- <div>
                                <x-jet-label for="bank_name" :value="__('Bank Name')" />
                                @error('bank_name')
                                    <label for="bank_name" class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                @if ($editing === true)
                                    <x-jet-input id="bank_name" class="block mt-1 w-full" type="text"
                                        wire:model="bank_name" />
                                @else
                                    <x-jet-input id="bank_name" class="block mt-1 w-full" type="text"
                                        wire:model="bank_name" disabled />
                                @endif
                            </div> --}}

                            {{-- ifsc --}}
                            {{-- <div>
                                <x-jet-label for="ifsc" :value="__('IFSC')" />
                                @error('ifsc')
                                    <label for="ifsc" class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                @if ($editing === true)
                                    <x-jet-input id="ifsc" class="block mt-1 w-full" type="text"
                                        wire:model="ifsc" />
                                @else
                                    <x-jet-input id="ifsc" class="block mt-1 w-full" type="text"
                                        wire:model="ifsc" disabled />
                                @endif
                            </div> --}}
                            {{-- account_number --}}
                            {{-- <div>
                                <x-jet-label for="account_number" :value="__('Account Number')" />
                                @error('account_number')
                                    <label for="account_number"
                                        class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                @if ($editing === true)
                                    <x-jet-input id="account_number" class="block mt-1 w-full" type="text"
                                        wire:model="account_number" />
                                @else
                                    <x-jet-input id="account_number" class="block mt-1 w-full" type="text"
                                        wire:model="account_number" disabled />
                                @endif
                            </div> --}}

                            {{-- Electricity_consumer_id_old --}}
                            <div>
                                <x-jet-label for="electricity_consumer_id_old" :value="__('Electricity Consumer ID (Old)')" />
                                @error('electricity_consumer_id_old')
                                    <label for="electricity_consumer_id_old"
                                        class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                @if ($editing === true)
                                    <x-jet-input id="electricity_consumer_id_old" class="block mt-1 w-full"
                                        type="text" wire:model="electricity_consumer_id_old" />
                                @else
                                    <x-jet-input id="electricity_consumer_id_old" class="block mt-1 w-full"
                                        type="text" wire:model="electricity_consumer_id_old" disabled />
                                @endif
                            </div>
                            {{-- Electricity_consumer_id_new --}}
                            <div>
                                <x-jet-label for="electricity_consumer_id_new" :value="__('Electricity Consumer ID (New)')" />
                                @error('electricity_consumer_id_new')
                                    <label for="electricity_consumer_id_new"
                                        class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                @if ($editing === true)
                                    <x-jet-input id="electricity_consumer_id_new" class="block mt-1 w-full"
                                        type="text" wire:model="electricity_consumer_id_new" />
                                @else
                                    <x-jet-input id="electricity_consumer_id_new" class="block mt-1 w-full"
                                        type="text" wire:model="electricity_consumer_id_new" disabled />
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($editing === true)
                        <div class="flex justify-end mt-4">
                            <x-jet-button wire:click="update" class="ml-4">
                                {{ __('Update') }}
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
                            <x-jet-button wire:click="edit" class="ml-4">
                                {{ __('Edit') }}
                            </x-jet-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
