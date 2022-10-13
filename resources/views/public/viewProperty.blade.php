<x-public-layout filters="">
    <div>
        <section id="images-slide" class="splide" aria-label="Beautiful Images">
            <div class="splide__track">
                <ul class="splide__list">
                    {{-- Repeat 2 times --}}
                    @foreach ($property->propertyImages as $image)
                        <li class="splide__slide">
                            <div class="p-0 sm:p-2">
                                <a href="{{ url('storage/' . $image->image_path) }}" data-lightbox="property-img">
                                    <img src="{{ url('storage/' . $image->image_path) }}" alt="Tools"
                                        class="w-full h-56 md:h-96 object-cover">
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
    <div class="flex justify-between Site-Max-Width Left-Space items-center mt-4 p-4">
        <div class="text-darker-3 flex flex-col space-y-3">
            <div>
                <h2 class="text-3xl font-GraphikMedium">
                    {{ $property->bhk->name . ' ' . $property->getNoOfRooms('Bathroom') . 'Bath ' . $property->propertyType->name }}
                </h2>
            </div>
            <h3 class="text-2xl font-GraphikMedium my-1 lg:my-0">{{ $property->address }}</h3>
            <h3 class="text-xl font-GraphikLight my-1 lg:my-0">{{ $property->landmark }}, {{ $property->locality->name }}</h3>
        </div>
        <div class="w-full max-w-sm">
            <div
                class="py-2 col-span-2 mb-2 font-GraphikLight text-lg {{ $property->isAvailable() ? 'text-green-800' : 'text-darker' }}">
                {{ $property->isAvailable() ? 'Available Now' : $property->available_from->diffForHumans() }}
            </div>
            <button
                onclick='Livewire.emit("openModal", "book-property-modal", {{ json_encode(['property_id' => $property->id]) }})'
                class="bg-darker-3 text-piss-yellow p-5 w-full rounded-sm text-center text-md mt-3 lg:mt-0 hover:bg-piss-yellow hover:text-darker-3 ease-in-out duration-300 cursor-pointer">
                BOOK A VISIT
            </button>
        </div>
    </div>

    <div class="w-full">
        <div class="bg-darker-3 max-w-xl flex justify-between mr-4">
            <div class="max-w-md Left-Space p-4">
                <span class="text-white text-2xl font-Graphik">Rent: <span class="text-piss-yellow">₹{{ $property->rent }}</span></span>
            </div>
            <div class="bg-piss-yellow text-2xl h-full w-32 p-4">&nbsp;</div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var splide = new Splide('#images-slide', {
                type: 'loop',
                arrows: true,
                pagination: false,
                autoplay: true,
                interval: 5000,
                perPage: 6,
                breakpoints: {
                    // 2.5K 4 items
                    2560: {
                        perPage: 4,
                    },
                    // FHD 3 items
                    1920: {
                        perPage: 3,
                    },
                    // 1440 2 items
                    1400: {
                        perPage: 2,
                    },
                    // 768 1 item
                    700: {
                        perPage: 1
                    }
                }
            });
            splide.mount();
        });
    </script>
</x-public-layout>
