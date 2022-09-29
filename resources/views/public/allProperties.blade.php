<x-public-layout :filters="$filters">
    <div class="mx-auto mt-12 sm:mt-8 flex Site-Max-Width" id="filters-container">
        <div class="hidden sm:block overflow-y-scroll h-screen p-4 sticky top-20 sm:w-80 sm:mr-8" id="filters">
            <form action="{{ route('allProperties') }}" method="GET" class="text-darker-3" id="allPropertiesForm">
                <input type="hidden" name="query" id="hidden-search" value="">
                <input type="hidden" name="sortBy", id="hidden-sort-by" value="recomended">
                <h3 class="font-GraphikBold text-lg mb-4">Filters</h3>
                <div>
                    @foreach ($filters as $filterType => $items)
                        @foreach ($items as $filter)
                            @php
                                // Table name in nsake case
                                $tableName = Str::snake($filterType);
                                $attribute = DB::table($tableName)
                                    ->where('id', $filter)
                                    ->first();
                            @endphp
                            <span id="badge-dismiss-default"
                                class="inline-flex items-center py-1 px-2 mr-2 mb-2 text-sm font-medium text-darker-3 bg-secondary rounded-sm">
                                {{ $attribute->name }}
                                <button type="button"
                                    onclick="removeFilter('{{ $tableName }}', '{{ $filter }}')"
                                    class="inline-flex items-center p-0.5 ml-2 text-sm text-darker-3 bg-transparent rounded-sm hover:bg-darker"
                                    data-dismiss-target="#badge-dismiss-default" aria-label="Remove">
                                    <svg aria-hidden="true" class="w-3.5 h-3.5" aria-hidden="true" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Remove badge</span>
                                </button>
                            </span>
                        @endforeach
                    @endforeach
                </div>
                <div class="mb-2 pb-6 border-b-2 border-b-secondary">
                    <h4 class="font-GraphikMedium mb-2 text-sm">Bedroom</h4>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($bhks as $bhk)
                            <div>
                                <input class="text-piss-yellow rounded-sm border-gray-400 focus:ring-0" type="checkbox"
                                    name="bhks[]" value="{{ $bhk->id }}" id="bhks-{{ $bhk->id }}"
                                    @if (in_array($bhk->id, $filters->bhks)) checked @endif>
                                <label class="text-gray-400 text-sm"
                                    for="bhks-{{ $bhk->id }}">{{ $bhk->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-2 pb-6 border-b-2 border-b-secondary">
                    <h4 class="font-GraphikMedium mb-2 text-sm">Category</h4>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($amenities as $amenity)
                            <div>
                                <input class="text-piss-yellow rounded-sm border-gray-400 focus:ring-0" type="checkbox"
                                    name="amenities[]" value="{{ $amenity->id }}" id="amenities-{{ $amenity->id }}"
                                    @if (in_array($amenity->id, $filters->amenities)) checked @endif>
                                <label class="text-gray-400 text-sm" for="amenities-{{ $amenity->id }}">
                                    {{ str_replace(' Friendly', '', $amenity->name) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-2 pb-6 border-b-2 border-b-secondary">
                    <h4 class="font-GraphikMedium mb-2 text-sm">Accomodation Type</h4>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($propertyTypes as $propertyType)
                            <div>
                                <input class="text-piss-yellow rounded-sm border-gray-400 focus:ring-0" type="checkbox"
                                    name="propertyTypes[]" value="{{ $propertyType->id }}"
                                    id="propertyTypes-{{ $propertyType->id }}"
                                    @if (in_array($propertyType->id, $filters->propertyTypes)) checked @endif>
                                <label class="text-gray-400 text-sm" for="propertyTypes-{{ $propertyType->id }}">
                                    {{ $propertyType->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-2 pb-6 border-b-2 border-b-secondary">
                    <h4 class="font-GraphikMedium mb-2 text-sm">Furnishing</h4>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($furnishings as $furnishing)
                            <div>
                                <input class="text-piss-yellow rounded-sm border-gray-400 focus:ring-0" type="checkbox"
                                    name="furnishings[]" value="{{ $furnishing->id }}"
                                    id="furnishings-{{ $furnishing->id }}"
                                    @if (in_array($furnishing->id, $filters->furnishings)) checked @endif>
                                <label class="text-gray-400 text-sm" for="furnishings-{{ $furnishing->id }}">
                                    {{ $furnishing->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-2 pb-6 border-b-2 border-b-secondary">
                    <h4 class="font-GraphikMedium mb-2 text-sm">Amenities</h4>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($amenities2 as $amenity)
                            <div>
                                <input class="text-piss-yellow rounded-sm border-gray-400 focus:ring-0" type="checkbox"
                                    name="amenities[]" value="{{ $amenity->id }}" id="amenities-{{ $amenity->id }}"
                                    @if (in_array($amenity->id, $filters->amenities)) checked @endif>
                                <label class="text-gray-400 text-sm" for="amenities-{{ $amenity->id }}">
                                    {{ $amenity->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-2 pb-6 border-b-2 border-b-secondary">
                    <h4 class="font-GraphikMedium mb-2 text-sm">Locality</h4>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($localities as $locality)
                            <div>
                                <input class="text-piss-yellow rounded-sm border-gray-400 focus:ring-0" type="checkbox"
                                    name="localities[]" value="{{ $locality->id }}"
                                    id="localities-{{ $locality->id }}"
                                    @if (in_array($locality->id, $filters->localities)) checked @endif>
                                <label class="text-gray-400 text-sm" for="localities-{{ $locality->id }}">
                                    {{ $locality->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full">
            <div class="ml-auto max-w-5xl p-4">
                <div class="flex justify-between items-center">
                    {{-- pagination description --}}
                    <div>
                        {{ $properties->links('vendor.pagination.text-only-tailwind', ['resource' => 'Properties']) }}
                    </div>
                    {{-- Sort by drop down --}}
                    <div class="hidden sm:flex items-center">
                        <div>
                            <h3 class="text-md text-darker-2 mr-3">Sort by:</h3>
                        </div>
                        <div class="ml-4">
                            <select name="sort_by" id="sort-by"
                                class="text-darker-3 border-0 p-0 focus:ring-0 cursor-pointer w-44"
                                onchange="updateSortBy(this)">
                                <option value="recomended" @if (request('sortBy') == 'recomended') selected @endif>Featured
                                </option>
                                <option value="price_asc" @if (request('sortBy') == 'price_asc') selected @endif>Price: Low
                                    to High</option>
                                <option value="price_desc" @if (request('sortBy') == 'price_desc') selected @endif>Price:
                                    High
                                    to Low</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- Properties --}}
                @forelse ($properties as $property)
                    <div id="property-{{ $property->id }}" class="mb-8 border-t-2 pt-4">
                        <div class="lg:grid lg:grid-cols-2 gap-6 justify-between">
                            <div
                                class="py-2 col-span-2 font-GraphikLight text-sm {{ $property->isAvailable() ? 'text-green-800' : 'text-darker' }}">
                                {{ $property->isAvailable() ? 'Available Now' : $property->available_from->diffForHumans() }}
                            </div>
                            <div>
                                @php
                                    $image_url = 'https://via.placeholder.com/600x400.png?text=No+Image+Uploaded';
                                    $images = $property->propertyImages;
                                    // Check if there is a cover image
                                    $coverImage = $images->where('is_cover', true)->first();
                                    // If there is no cover image, get the first image
                                    $coverImage = $coverImage ? $coverImage : $images->first();
                                    // If there is an image, get the url
                                    $image_url = $coverImage ? $coverImage->image_path : $image_url;
                                @endphp
                                <img src="{{ url('storage/' . $image_url) }}" alt=""
                                    class="w-full h-60 object-cover">
                            </div>
                            <div class="flex flex-col justify-between text-darker-3 mt-6 lg:mt-0">
                                <div class="flex justify-between">
                                    <h2 class="text-xl font-GraphikMedium">
                                        {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
                                    </h2>
                                    <button>
                                        <img src="{{ url('resources/icons/share.svg') }}" alt="">
                                    </button>
                                </div>
                                <h3 class="text-darker-2 my-1 lg:my-0">{{ $property->building_name }}</h3>
                                <h3 class="font-GraphikLight text-sm my-1 lg:my-0">
                                    {{ $property->landmark . ', ' . $property->locality->name }}</h3>
                                <p class="text-darker-2 my-1 lg:my-0">{{ $property->furnishing->name }}</p>
                                <span class="flex items-center my-2 lg:my-0">
                                    <p class="pr-2">Featues:</p>
                                    @php
                                        $amenities = ['Parking', 'Security', 'Lift'];
                                    @endphp
                                    @foreach ($amenities as $amenity)
                                        @php
                                            $amenity_check = $property->checkPropertyAminity($amenity);
                                        @endphp
                                        <svg height="12" width="12">
                                            <circle cx="6.2" cy="6.2" r="6.2"
                                                fill="{{ $amenity_check ? '#e8c811' : '#686868' }}">
                                            </circle>
                                        </svg>
                                        <p class="pl-1 pr-6">{{ $amenity }}</p>
                                    @endforeach
                                </span>
                                <p class="my-2 lg:my-0">Rent <span
                                        class="text-xl text-red-600">₹{{ $property->rent }}/-</span></p>
                                <button onclick='Livewire.emit("openModal", "book-property-modal", {{ json_encode(["property_id" => $property->id]) }})'
                                    class="bg-darker-3 text-piss-yellow rounded-sm text-center text-sm mt-3 lg:mt-0 py-2 hover:bg-piss-yellow hover:text-darker-3 ease-in-out duration-300 cursor-pointer w-full">BOOK
                                    A VISIT</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col justify-center">
                        <img src="{{ url('resources/images/no_match_found.png') }}" alt=""
                            class="mx-auto w-80">
                        <h3 class="text-2xl font-GraphikMedium text-darker-3 text-center">Sorry, No Properties Found!
                        </h3>
                        <p class="text-lg text-darker-3 text-center mb-6 mt-2">Please check the spelling or reset some filters.</p>
                        <a href="{{ route('allProperties') }}"
                            class="bg-darker-3 text-piss-yellow rounded-sm text-center text-sm lg:mt-0 py-2 hover:bg-piss-yellow hover:text-darker-3 ease-in-out duration-300 cursor-pointer w-full sm:w-96 sm:mx-auto">Reset Search</a>
                    </div>
                @endforelse
                <div class="flex justify-center mt-24 mb-14">
                    {{ $properties->links('vendor.pagination.styled-tailwind') }}
                </div>
            </div>
        </div>
    </div>
    </div>
    <style>
        #filters {
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }

        #filters::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }

        #properties {
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }

        #properties::-webkit-scrollbar {
            display: none;
            /* Safari and Chrome */
        }
    </style>
    <script>
        // Wait for DOM to load
        window.addEventListener('DOMContentLoaded', function() {
            // Get the mobile filter button
            const mobileFilterButton = document.getElementById('mobile-filter-button');
            // Get the filters-container
            const filtersContainer = document.getElementById('filters-container');
            // When the user clicks on the button, toggle the filters
            mobileFilterButton.addEventListener('click', function() {
                const classes_to_toggle = ['hidden', 'sm:block', 'sticky', 'top-20', 'shadow-md',
                    'border-b-1', 'border-l-1', 'border-r-1', 'border-b-darker-3', 'pb-4',
                    'rounded-b-2xl'
                ]
                classes_to_toggle.forEach(function(class_to_toggle) {
                    document.getElementById('filters').classList.toggle(class_to_toggle);
                })
                document.getElementById('filters-container').classList.toggle('flex');
            });
        })

        function updateSortBy(element) {
            const sort_by = element.value;
            const hidden_sort_by = document.getElementById('hidden-sort-by');
            hidden_sort_by.value = sort_by;

            // Submit the form
            submitForm();
        }

        // Function is called from nav-search.blade.php
        function updateBHK(element) {
            const bhk = element.value;
            // get the bhks checkboxes
            const bhk_checkboxes = document.getElementsByName('bhks[]');
            // Loop through the checkboxes
            bhk_checkboxes.forEach(function(bhk_checkbox) {
                // Check if the checkbox value is equal to the bhk value
                if (bhk_checkbox.value == bhk) {
                    // If yes, then check the checkbox
                    bhk_checkbox.checked = true;
                } else {
                    // If no, then uncheck the checkbox
                    bhk_checkbox.checked = false;
                }
            });

            // Submit the form
            submitForm();
        }

        // Function is called from nav-search.blade.php
        function updateSearch(element) {
            console.log(element);
            const search = element.value;
            const hidden_search = document.getElementById('hidden-search');
            hidden_search.value = search;

            // If the user has pressed enter, submit the form
            if (event.keyCode === 13) {
                // Submit the form
                submitForm();
            }
        }

        // Get the allPropertiesForm
        const allPropertiesForm = document.getElementById('allPropertiesForm');

        // function to submit the form
        function submitForm() {
            allPropertiesForm.submit();
        }

        // Listen for any input changes and submit the form
        allPropertiesForm.addEventListener('input', function(event) {
            submitForm();
        });

        // Remove filters
        function removeFilter(attributeName, attributeValue) {
            // Get the attribute input
            const attributeInput = document.getElementById(attributeName + '-' + attributeValue);
            // Uncheck the attribute input
            attributeInput.checked = false;
            // Submit the form
            submitForm();
        }
    </script>
</x-public-layout>
