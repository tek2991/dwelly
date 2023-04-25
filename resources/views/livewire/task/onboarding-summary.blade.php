<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Onboarding status</h2>
                                
                @if ($onboarding->completed)
                    <span class="ml-2 text-xs text-green-500">Completed</span>
                @endif
            </div>
            <div class="flex justify-between my-2">
                <a href="{{ route('onboarding.show', $onboarding) }}" target="_blank" class="text-blue-500 hover:underline">View
                    onboarding</a>
            </div>

            <ul class="grid grid-cols-1 md:grid-cols-2 gap-6 list-disc pl-4">
                <li>Property data: 
                    @if($onboarding->property_data)
                        <span class="text-green-500 text-sm font-semibold">Completed</span>
                    @else
                        <span class="text-red-500 text-sm font-semibold">Incomplete</span>
                    @endif
                </li>
                <li>Owner details: 
                    @if($onboarding->owner_data)
                        <span class="text-green-500 text-sm font-semibold">Completed</span>
                    @else
                        <span class="text-red-500 text-sm font-semibold">Incomplete</span>
                    @endif
                </li>
                <li>Amenities: 
                    @if($onboarding->amenities_data)
                        <span class="text-green-500 text-sm font-semibold">Completed</span>
                    @else
                        <span class="text-red-500 text-sm font-semibold">Incomplete</span>
                    @endif
                </li>
                <li>Rooms: 
                    @if($onboarding->rooms_data)
                        <span class="text-green-500 text-sm font-semibold">Completed</span>
                    @else
                        <span class="text-red-500 text-sm font-semibold">Incomplete</span>
                    @endif
                </li>
                <li>Furnitures: 
                    @if($onboarding->furnitures_data)
                        <span class="text-green-500 text-sm font-semibold">Completed</span>
                    @else
                        <span class="text-red-500 text-sm font-semibold">Incomplete</span>
                    @endif
                </li>
                <li>Onboarding Audit: 
                    @if($onboarding->auditCompleted())
                        <span class="text-green-500 text-sm font-semibold">Completed</span>
                    @else
                        <span class="text-red-500 text-sm font-semibold">Incomplete
                            @if(!$onboarding->audit()->exists())
                                (Not created)
                            @endif
                        </span>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
