<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex justify-between mb-2">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Reopen Audit</h2>
            </div>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Re open audit status to
                <span class="font-semibold text-gray-800 dark:text-gray-200">In Progress</span>. The audit will be available for editing.
            </p>

            @if ($err)
                <div class="my-3">
                    <label for="tenant_id" class="text-sm font-semibold text-red-700 block">
                        {{ $err }}
                    </label>
                </div>
            @endif

            {{-- Confirm check box and submit btn --}}
            <form wire:submit.prevent="reopenAudit">
                <div class="flex justify-between">
                    <div class="flex items center py-2">
                        @if ($editable)
                            <x-jet-checkbox wire:model="confirm" />
                        @else
                            <x-jet-checkbox wire:model="confirm" disabled />
                        @endif
                        <x-jet-label class="ml-2" for="confirm" value="Confirm" />
                    </div>
                    @if ($editable)
                        <x-jet-button class="ml-4" wire:loading.attr="disabled">
                            {{ __('Reopen Audit') }}
                        </x-jet-button>
                    @else
                        <x-jet-button class="ml-4" wire:loading.attr="disabled" disabled>
                            {{ __('Reopen Audit') }}
                        </x-jet-button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
