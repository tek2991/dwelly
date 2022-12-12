<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="text-xl font-regular pt-2 pb-4">Role details</h2>
            <form method="POST" wire:submit.prevent="store">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Property --}}
                    <div>
                        <x-jet-label for="property_id" :value="__('Property')" />
                        @error('property')
                            <label for="property_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="property_id" wire:model="property_id">
                            <option value="">Select property</option>
                            @foreach ($properties as $property)
                                <option value="{{ $property->id }}">{{ $property->code }}</option>
                            @endforeach
                        </x-input-select>
                    </div>
                    {{-- Audit type --}}
                    <div>
                        <x-jet-label for="audit_type_id" :value="__('Audit type')" />
                        @error('audit_type')
                            <label for="audit_type_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="audit_type_id" wire:model="audit_type_id">
                            <option value="">Select audit type</option>
                            @foreach ($auditTypes as $auditType)
                                <option value="{{ $auditType->id }}">{{ $auditType->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>
                    {{-- Audit date --}}
                    <div>
                        <x-jet-label for="audit_date" :value="__('Audit date')" />
                        @error('audit_date')
                            <label for="audit_date" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="audit_date" class="block mt-1 w-full" type="date" wire:model="audit_date" />
                    </div>
                    {{-- Tenant --}}
                    <div>
                        <x-jet-label for="tenant_id" :value="__('Tenant')" />
                        @error('tenant')
                            <label for="tenant_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        @if ($property_id &&
                            $audit_type_id &&
                            $audit_type_id != $onboarding_audit_type_id &&
                            $audit_type_id != $deboarding_audit_type_id)
                            <x-input-select id="tenant_id" wire:model="tenant_id">
                                <option value="">Select tenant</option>
                                @foreach ($tenants as $tenant)
                                    <option value="{{ $tenant->id }}">{{ $tenant->user->name }}</option>
                                @endforeach
                            </x-input-select>
                        @else
                            <x-input-select id="tenant_id" wire:model="tenant_id" disabled>
                                <option value="">Select tenant</option>
                            </x-input-select>
                        @endif
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
