        {{-- Tenants --}}
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-between mb-6">
                        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Bank Details</h2>
                        @if ($owner_or_tenant instanceof App\Models\Owner)
                            <x-button-link href="{{ route('bankDetailForOwner.create', ['owner' => $owner_or_tenant]) }}"
                                class="ml-4">
                                {{ __('Create New') }}
                            </x-button-link>
                        @elseif($owner_or_tenant instanceof App\Models\Tenant)
                            <x-button-link
                                href="{{ route('bankDetailForTenant.create', ['tenant' => $owner_or_tenant]) }}"
                                class="ml-4">
                                {{ __('Create New') }}
                            </x-button-link>
                        @endif
                    </div>
                    @php
                        $model_type = $owner_or_tenant instanceof App\Models\Owner ? 'App\Models\Owner' : 'App\Models\Tenant';
                        $model_id = $owner_or_tenant->id;
                    @endphp
                    <livewire:bank-detail-table  :model_type="$model_type" :model_id="$model_id" />
                </div>
            </div>
        </div>
