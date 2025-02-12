<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ $user->name }}'s Bank Details
            </h2>
            <form wire:submit.prevent="store">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
                        {{-- Is current --}}
                        <div>
                            <x-jet-label for="is_current" :value="__('Is Current')" />
                            @error('is_current')
                                <label for="is_current" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-checkbox id="is_current" class="block mt-1" type="checkbox" name="is_current"
                                wire:model="is_current" />
                        </div>
                    </div>
                    <h3 class="mt-3">
                        Document Details
                    </h3>
                    <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Document Type --}}
                        <div>
                            <x-jet-label for="document_type" :value="__('Document Type')" />
                            @error('document_type')
                                <label for="document_type" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <select id="document_type" class="block mt-1 w-full" name="document_type" wire:model="document_type_id"
                                required>
                                @foreach ($document_types as $documentType)
                                    <option value="{{ $documentType->id }}">
                                        {{ $documentType->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Document --}}
                        <div>
                            <x-jet-label for="document" :value="__('Document')" />
                            @error('document')
                                <label for="document" class="text-xs text-red-700 block">{{ $message }}</label>
                            @enderror
                            <x-jet-input id="document" class="block mt-1 w-full" type="file" name="document"
                                wire:model="document" required />
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
