<x-public-layout>
    <div id="hero" style="background: linear-gradient(to right, #e6e6e6 60%, #4c4d47 40%);" class="pt-6">
        <div class="w-full"
            style="background-image: url({{ url('resources/images/city_bg_30.png') }});
                background-size: cover;
                background-repeat: no-repeat;
                background-position: bottom;">
            <div class="Site-Max-Width mx-auto p-4 flex justify-between items-end">
                <div class="pb-3 w-7/12 pr-2 sm:pr-0">
                    <h2 class="font-GraphikMedium leading-none text-darker-3 text-3xl sm:text-5xl">
                        What <br>
                        dwelly <br>
                        does for you?
                    </h2>
                    <p class="py-4 text-darker-3 text-md sm:text-lg max-w-sm">
                        End to end property management <br class="hidden md:block"> solutions for residential properties
                    </p>
                    <button type="button"
                        class="col-span-3 bg-darker-3 text-piss-yellow rounded-sm text-center p-4 xl:text-lg hover:bg-piss-yellow hover:text-darker-3 ease-in-out duration-300 cursor-pointer w-full max-w-sm">
                        RENT OUT WITH DWELLY
                    </button>
                </div>
                <div class="w-5/12 pb-4">
                    <h1 class="text-right font-GraphikSemibold text-piss-yellow text-4xl sm:text-6xl lg:text-8xl">
                        <div>for</div>
                        <div
                            class="font-GraphikLight text-white text-xl xl:text-3xl my-4 underline decoration-piss-yellow decoration-4">
                            dwelly</div>
                        <div>Owners</div>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    {{-- Show on desktop --}}
    <div class="hidden sm:flex justify-between Site-Max-Width mx-auto p-4 my-8">
        <div class="mr-2 md:mr-8 2xl:mr-12">
            <div class="bg-darker-3">
                <h3 class="p-4 xl:mr-20">
                    <div class="text-white font-GraphikMedium text-3xl md:text-4xl  lg:text-5xl">85+</div>
                    <div class="text-white text-md lg:text-lg">properties</div>
                </h3>
            </div>
            <div class="bg-darker-2">
                <h3 class="p-4 xl:mr-20">
                    <div class="text-white font-GraphikLight text-lg">
                        In Guwahati
                    </div>
                    <div class="text-piss-yellow text-sm lg:text-base">
                        and still growing...
                    </div>
                </h3>
            </div>
        </div>
        <div class="w-3/4 lg:w-4/6 grid grid-cols-3 gap-2 md:gap-12 lg:gap-20 xl:gap-24  2xl:gap-28">
            <div class="flip-card w-full h-full">
                <div class="flip-card-inner">
                    <div class="flip-card-front w-full h-full absolute Rounded-BOX-1 border-2 border-piss-yellow">
                        <div class="h-full flex justify-center items-center">
                            <div>
                                <img src="{{ url('resources/icons/property_maintenance.svg') }}" alt="Avatar"
                                    class="w-2/3 mx-auto">
                                <h3 class="text-darker-3 font-GraphikLight text-lg leading-tight py-4">Property
                                    <br>
                                    maintenance
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flip-card-back w-full h-full absolute flex items-center px-4 lg:px-8 bg-darker-3 Rounded-BOX-2 border-2 border-darker-3">
                        <p class="text-white text-left font-GraphikLight text-md leading-4 lg:text-lg md:leading-6">
                            We help with <br>
                            figuring out <br>
                            and solving your <br>
                            day to day <br>
                            <span class="text-piss-yellow">
                                operational <br>
                                issues. <br>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="flip-card w-full h-full">
                <div class="flip-card-inner">
                    <div class="flip-card-front w-full h-full absolute Rounded-BOX-1 border-2 border-piss-yellow">
                        <div class="h-full flex justify-center items-center">
                            <div>
                                <img src="{{ url('resources/icons/no_paperworks.svg') }}" alt="Avatar"
                                    class="w-2/3 mx-auto">
                                <h3 class="text-darker-3 font-GraphikLight text-lg leading-tight pt-2">Rent
                                    <br>
                                    on time
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flip-card-back w-full h-full absolute flex items-center px-4 lg:px-8 bg-darker-3 Rounded-BOX-2 border-2 border-darker-3">
                        <p class="text-white text-left font-GraphikLight text-md text-lg leading-6">
                            We ensure <br>
                            that you <br>
                            get your rent
                            <span class="text-piss-yellow">
                                payment <br>
                                on time.
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="flip-card w-full h-full">
                <div class="flip-card-inner">
                    <div class="flip-card-front w-full h-full absolute Rounded-BOX-1 border-2 border-piss-yellow">
                        <div class="h-full flex justify-center items-center">
                            <div>
                                <img src="{{ url('resources/icons/rent_on_time.svg') }}" alt="Avatar"
                                    class="w-2/3 mx-auto">
                                <h3
                                    class="text-darker-3 font-GraphikLight text-md leading-none 2xl:text-lg 2xl:leading-tight pt-4 2xl:pt-2">
                                    No
                                    <br>
                                    paperwork
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flip-card-back w-full h-full absolute flex items-center px-4 lg:px-8 bg-darker-3 Rounded-BOX-2 border-2 border-darker-3">
                        <p class="text-white text-left font-GraphikLight text-md leading-4 2xl:text-lg xl:leading-6">
                            We do all the
                            paperworks
                            for you like <br>
                            <span class="text-piss-yellow">
                                rental agreements,
                                documents verification.
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hide on desktop -->
    <div class="sm:hidden">
        <div class="">
            <section id="dwelly-for-owners-slide" class="splide h-full" aria-label="Beautiful Images">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="flex justify-evenly gap-6 p-8 items-center self-center mt-4">
                                <img src="{{ url('resources/icons/rent_on_time.svg') }}" alt="Rent on Time">
                                <div>
                                    <h3 class="text-darker-3 text-lg pb-2 font-GraphikMedium">Rent on time</h3>
                                    <p class="text-darker-3 font-GraphikLight">We ensure that you get your rent payment
                                        on time.</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="flex justify-around gap-6 p-8 items-center self-center mt-4">
                                <img src="{{ url('resources/icons/property_maintenance.svg') }}"
                                    alt="Property maintenanc">
                                <div>
                                    <h3 class="text-darker-3 text-lg pb-2 font-GraphikMedium">Property maintenance</h3>
                                    <p class="text-darker-3 font-GraphikLight">We help with figuring out and solving
                                        your day to day operational issues.</p>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="flex justify-around gap-6 p-8 items-center self-center mt-4">
                                <img src="{{ url('resources/icons/no_paperworks.svg') }}" alt="No paperwork">
                                <div>
                                    <h3 class="text-darker-3 text-lg pb-2 font-GraphikMedium">No paperwork</h3>
                                    <p class="text-darker-3 font-GraphikLight">We do all the paperworks for you like
                                        rental agreements and verification documents.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>

     <div id="hero" class="my-6 sm:flex">
        <div class="sm:w-3/5 bg-secondary">
            <div class="Left-Space h-full flex-row xl:flex items-center">
                <p class="p-4 pl-12 pb-8 pr-12 sm:pr-4 sm:max-w-sm text-darker-3 text-lg text-justify">
                    <span class="-ml-10 font-SecularOne text-5xl inline">“</span>
                    Dwelly aims to become a virtual property manager for every real estate asset owner. It was founded keeping in mind every woe and trouble of a property owner.
                </p>
                <div class="flex justify-evenly items-center px-3 pb-4 sm:px-0 sm:max-w-sm">
                    <div>
                        <img src="{{ url('resources/images/kaushal.png') }}" alt="quote" class="p-3 bg-cover">
                    </div>
                    <div>
                        <img src="{{ url('resources/images/antarikh.png') }}" alt="quote" class="p-3 bg-cover">
                    </div>
                    <div>
                        <img src="{{ url('resources/images/atif.png') }}" alt="quote" class="p-3 bg-cover">
                    </div>
                </div>
            </div>
        </div>
        <div class="sm:w-2/5 flex items-center justify-center sm:justify-start border-t-8 border-b-8 bg-darker-3 border-t-piss-yellow border-b-piss-yellow p-4">
            <p class="text-white font-GraphikLight text-4xl leading-snug sm:max-w-xs text-center sm:text-left">
                We have <span class="text-piss-yellow font-GraphikSemibold block text-5xl">Expertise</span> for your every <br class="sm:hidden"> Property hassle.
            </p>
        </div>
    </div>
    <style>
        .flip-card {
            background-color: transparent;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .flip-card-front {}

        .flip-card-back {
            transform: rotateY(180deg);
        }

        .splide__pagination__page {
                background-color: #e6e6e6;
            }

        .splide__pagination__page.is-active {
                background-color: #e8c811;
            }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var splide = new Splide('#dwelly-for-owners-slide', {
                type: 'loop',
                arrows: false,
                autoplay: true,
                interval: 3000,
            });
            splide.mount();
        });
    </script>
</x-public-layout>
