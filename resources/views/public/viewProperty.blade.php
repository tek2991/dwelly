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
