<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="mb-6">
                <div>
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Update Onboarding Owner</h2>
                    @if ($disabled)
                        <p class="text-sm text-red-500 pb-4">
                            You can't update owner details after starting onboarding audit!
                        </p>
                    @endif
                    <form wire:submit.prevent="save">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- Name --}}
                            <div>
                                <x-jet-label for="name" :value="__('Name')" />
                                @error('name')
                                    <label for="name" class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                <x-jet-input id="name" class="block mt-1 w-full" type="text" :disabled="$disabled"
                                    wire:model="name" />
                            </div>
                            {{-- Email --}}
                            <div>
                                <x-jet-label for="email" :value="__('Email')" />
                                @error('email')
                                    <label for="email" class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror
                                <x-jet-input id="email" class="block mt-1 w-full" type="email" :disabled="$disabled"
                                    wire:model="email" />
                            </div>
                            {{-- Phone_1 --}}
                            <div>
                                <x-jet-label for="phone_1" :value="__('Phone 1')" />
                                @error('phone_1')
                                    <label for="phone_1" class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                <x-jet-input id="phone_1" class="block mt-1 w-full" type="text" :disabled="$disabled"
                                    wire:model="phone_1" />
                            </div>
                            {{-- Phone_2 --}}
                            <div>
                                <x-jet-label for="phone_2" :value="__('Phone 2')" />
                                @error('phone_2')
                                    <label for="phone_2" class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                <x-jet-input id="phone_2" class="block mt-1 w-full" type="text" :disabled="$disabled"
                                    wire:model="phone_2" />
                            </div>
                            {{-- Onboarded_at --}}
                            <div>
                                <x-jet-label for="onboarded_at" :value="__('Onboarded')" />
                                @error('onboarded_at')
                                    <label for="onboarded_at" class="text-xs text-red-700 block">{{ $message }}</label>
                                @enderror

                                <x-jet-input id="onboarded_at" class="block mt-1 w-full" type="date" :disabled="$disabled"
                                    wire:model="onboarded_at" />
                            </div>

                            <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                                {{-- Beneficiary_name --}}
                                <div>
                                    <x-jet-label for="beneficiary_name" :value="__('Beneficiary Name')" />
                                    @error('beneficiary_name')
                                        <label for="beneficiary_name"
                                            class="text-xs text-red-700 block">{{ $message }}</label>
                                    @enderror

                                    <x-jet-input id="beneficiary_name" class="block mt-1 w-full" type="text" :disabled="$disabled"
                                        wire:model="beneficiary_name" />
                                </div>
                                {{-- Bank_name --}}
                                <div>
                                    <x-jet-label for="bank_name" :value="__('Bank Name')" />
                                    @error('bank_name')
                                        <label for="bank_name"
                                            class="text-xs text-red-700 block">{{ $message }}</label>
                                    @enderror

                                    <x-jet-input id="bank_name" class="block mt-1 w-full" type="text" :disabled="$disabled"
                                        wire:model="bank_name" />
                                </div>

                                {{-- ifsc --}}
                                <div>
                                    <x-jet-label for="ifsc" :value="__('IFSC')" />
                                    @error('ifsc')
                                        <label for="ifsc" class="text-xs text-red-700 block">{{ $message }}</label>
                                    @enderror

                                    <x-jet-input id="ifsc" class="block mt-1 w-full" type="text" :disabled="$disabled"
                                        wire:model="ifsc" />
                                </div>
                                {{-- account_number --}}
                                <div>
                                    <x-jet-label for="account_number" :value="__('Account Number')" />
                                    @error('account_number')
                                        <label for="account_number"
                                            class="text-xs text-red-700 block">{{ $message }}</label>
                                    @enderror

                                    <x-jet-input id="account_number" class="block mt-1 w-full" type="text" :disabled="$disabled"
                                        wire:model="account_number" />
                                </div>

                                {{-- Electricity_consumer_id_old --}}
                                <div>
                                    <x-jet-label for="electricity_consumer_id_old" :value="__('Electricity Consumer ID (Old)')" />
                                    @error('electricity_consumer_id_old')
                                        <label for="electricity_consumer_id_old"
                                            class="text-xs text-red-700 block">{{ $message }}</label>
                                    @enderror

                                    <x-jet-input id="electricity_consumer_id_old" class="block mt-1 w-full" :disabled="$disabled"
                                        type="text" wire:model="electricity_consumer_id_old" />
                                </div>
                                {{-- Electricity_consumer_id_new --}}
                                <div>
                                    <x-jet-label for="electricity_consumer_id_new" :value="__('Electricity Consumer ID (New)')" />
                                    @error('electricity_consumer_id_new')
                                        <label for="electricity_consumer_id_new"
                                            class="text-xs text-red-700 block">{{ $message }}</label>
                                    @enderror

                                    <x-jet-input id="electricity_consumer_id_new" class="block mt-1 w-full" :disabled="$disabled"
                                        type="text" wire:model="electricity_consumer_id_new" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <x-jet-button type="submit" :disabled="$disabled" class="ml-4">
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
