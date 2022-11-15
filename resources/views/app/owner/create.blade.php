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
                    <x-jet-validation-errors class="mb-4" />
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div>
                            <x-jet-label for="name" :value="__('Name')" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus />
                        </div>
                        {{-- Email --}}
                        <div>
                            <x-jet-label for="email" :value="__('Email')" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                        </div>
                        {{-- Phone --}}
                        <div>
                            <x-jet-label for="phone_1" :value="__('Phone')" />
                            <x-jet-input id="phone_1" class="block mt-1 w-full" type="text" name="phone_1"
                                :value="old('phone_1')" required />
                        </div>
                        {{-- Phone 2 --}}
                        <div>
                            <x-jet-label for="phone_2" :value="__('Phone Alternate')" />
                            <x-jet-input id="phone_2" class="block mt-1 w-full" type="text" name="phone_2"
                                :value="old('phone_2')" />
                        </div>
                        {{-- Onboarded at --}}
                        <div>
                            <x-jet-label for="onboarded_at" :value="__('Onboarded At')" />
                            <x-jet-input id="onboarded_at" class="block mt-1 w-full" type="date" name="onboarded_at"
                                :value="old('onboarded_at')" required />
                        </div>
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Beneficiary name --}}
                            <div>
                                <x-jet-label for="beneficiary_name" :value="__('Beneficiary Name')" />
                                <x-jet-input id="beneficiary_name" class="block mt-1 w-full" type="text"
                                    name="beneficiary_name" :value="old('beneficiary_name')" required />
                            </div>
                            {{-- Bank name --}}
                            <div>
                                <x-jet-label for="bank_name" :value="__('Bank Name')" />
                                <x-jet-input id="bank_name" class="block mt-1 w-full" type="text" name="bank_name"
                                    :value="old('bank_name')" required />
                            </div>
                            {{-- Bank IFSC --}}
                            <div>
                                <x-jet-label for="ifsc" :value="__('Bank IFSC')" />
                                <x-jet-input id="ifsc" class="block mt-1 w-full" type="text" name="ifsc"
                                    :value="old('ifsc')" required />
                            </div>
                            {{-- Account number --}}
                            <div>
                                <x-jet-label for="account_number" :value="__('Account Number')" />
                                <x-jet-input id="account_number" class="block mt-1 w-full" type="text"
                                    name="account_number" :value="old('account_number')" required />
                            </div>
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Electricity consumer id old --}}
                            <div>
                                <x-jet-label for="electricity_consumer_id_old" :value="__('Electricity Consumer ID Old')"
                                    class="text-gray-600" />
                                <x-jet-input id="electricity_consumer_id_old" class="block mt-1 w-full" type="text"
                                    name="electricity_consumer_id_old" :value="old('electricity_consumer_id_old')" />
                            </div>
                            {{-- Electricity consumer id new --}}
                            <div>
                                <x-jet-label for="electricity_consumer_id_new" :value="__('Electricity Consumer ID New')"
                                    class="text-gray-600" />
                                <x-jet-input id="electricity_consumer_id_new" class="block mt-1 w-full" type="text"
                                    name="electricity_consumer_id_new" :value="old('electricity_consumer_id_new')" />
                            </div>
                        </div>


                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Password --}}
                            <div class="col-start-1 col-end-2">
                                <x-jet-label for="password" :value="__('Password')" />
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
