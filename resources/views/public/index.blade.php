<x-public-layout>
    <header
        class="text-darker-2 font-Graphik text-md max-w-4xl mx-auto pt-6 pb-2 sm:text-piss-yellow sm:text-3xl sm:py-8">
        <h1>Want a place to Stay?</h1>
    </header>
    <form action="#" method="get" class="max-w-4xl mx-auto">
        <script>
            function set_bhk(id, name) {
                // get input element with id = bhk_id and set its value to id
                document.getElementById('bhk_id').value = id;
                // Get span with id = bhk_name and set its innerHTML to name
                document.getElementById('bhk_name').innerHTML = name;
                // click the button with id = bhk_button
                document.getElementById('bhk_button').click();
            }
        </script>
        <input type="hidden" name="bhk_id" value="1" id="bhk_id">
        <div class="flex justify-center">
            <div class="flex">
                <button id="bhk_button" data-dropdown-toggle="bhk_dropdown"
                    class="flex bg-secondary rounded-bl-3xl pl-8 pr-3 py-3 gap-6" type="button">
                    <span id="bhk_name">
                        1 BHK
                    </span>
                    <svg aria-hidden="true" class="ml-1 mt-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div id="bhk_dropdown"
                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="bhk_button">
                        <li>
                            <button type="button" onclick="set_bhk(1, '1 BHK')"
                                class="inline-flex py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                <div class="inline-flex items-center">
                                    1 BHK
                                </div>
                            </button>
                        </li>
                        <li>
                            <button type="button" onclick="set_bhk(2, '2 BHK')"
                                class="inline-flex py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                <div class="inline-flex items-center">
                                    2 BHK
                                </div>
                            </button>
                        </li>
                        <li>
                            <button type="button" onclick="set_bhk(3, '3 BHK')"
                                class="inline-flex py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                <div class="inline-flex items-center">
                                    3 BHK
                                </div>
                            </button>
                        </li>
                        <li>
                            <button type="button" onclick="set_bhk(4, '4 BHK')"
                                class="inline-flex py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                <div class="inline-flex items-center">
                                    4 BHK
                                </div>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <input type="text" name="string" id=""
                class=" w-3/4 border-l-0 border-r-0 border-t-secondary border-b-secondary focus:border-t-secondary focus:border-b-piss-yellow focus:ring-0"
                placeholder="Location, Amenities...">
            <button type="submit"
                class="bg-piss-yellow rounded-tr-3xl rounded-bl-3xl -ml-5 px-8 py-3 hover:bg-darker ease-in-out duration-300">Search</button>
        </div>
    </form>
    <div id="hero">
        <img src="{{ url('resources/images/city_bg.svg') }}" alt="City Background" class="w-full my-12">
    </div>

    <!-- Hide on mobile -->
    <div class="hidden sm:flex bg-piss-yellow H-30pvw MaxH-18 sm:ustify-between sm:mt-20">
        <div class="w-1/4 z-20 p-4">
            <div
                class="Left-Space H-40pvw MaxH-23 W-30pvw MaxW-23 bg-white border-piss-yellow border-4 Rounded-BOX-2 NegM-T flex items-center">
                <div>
                    <div class="flex justify-between px-4 mb-6">
                        <div class="flex items-center">
                            <h2 class="text-piss-yellow font-GraphikMedium text-xl md:text-2xl lg:text-4xl">Want
                                a<br>place <br>to stay?</h2>
                        </div>
                        <img src="{{ url('resources/logos/dwelly_logo.png') }}" alt="Dwelly Logo" class="w-1/2 h-1/2">
                    </div>
                    <div class="col-span-2 border-l-8 border-l-piss-yellow mx-4 px-4">
                        <h2 class="font-GraphikMedium text-sm md:text-base">DWELLY for Tenants</h2>
                        <p class="font-GraphikLight text-sm md:text-base">A hassle free way of looking, booking and
                            staying in a city</p>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="w-3/4 bg-darker-3 border-piss-yellow border-t-8 border-b-8 z-0 flex justify-evenly pl-4 md:pl-0 items-center text-secondary text-center font-GraphikLight">
            <div class="flex-col justify-center items-center">
                <img src="{{ url('resources/images/house.svg') }}" alt="House" class="w-full">
                <h3>100% Verified <br> properties</h3>
            </div>
            <div class="flex-col justify-center items-center">
                <img src="{{ url('resources/images/agent.svg') }}" alt="Agent" class="w-full">
                <h3>Fixed service <br> fee</h3>
            </div>
            <div class="flex-col justify-center items-center">
                <img src="{{ url('resources/images/tools.svg') }}" alt="Tools" class="w-full">
                <h3>Maintenance <br> on demand</h3>
            </div>
        </div>
    </div>
    <!-- Hide on desktop -->
    <div class="sm:hidden">
        Testing
    </div>
</x-public-layout>
