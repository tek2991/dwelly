<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="text-xl font-regular pt-2 pb-4">Task details</h2>
            <form method="POST" wire:submit.prevent="store">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Description --}}
                    <div class="md:col-span-3">
                        <x-jet-label for="description" :value="__('Description')" />
                        @error('description')
                            <label for="description" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-textarea id="description" class="block mt-1 w-full" type="text" wire:model="description" ></x-textarea>
                    </div>
                    {{-- Error Message --}}
                    @if ($err)
                        <div class="col-span-3">
                            <label for="tenant_id" class="text-sm font-semibold text-red-700 block">
                                {{ $err }}
                                <span>
                                    <a href="{{ route('audit.show', $existing_audit) }}" class="text-blue-700">Show</a>
                                </span>
                            </label>
                        </div>
                    @endif
                </div>
                <div class="flex justify-end mt-4">
                    @if ($disable_submit)
                        <x-jet-button class="ml-4" disabled>
                            {{ __('Create') }}
                        </x-jet-button>
                    @else
                        <x-jet-button class="ml-4">
                            {{ __('Create') }}
                        </x-jet-button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
