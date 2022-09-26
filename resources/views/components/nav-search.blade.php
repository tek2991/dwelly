@props(['filters'])
<div class="fixed w-full z-20 Gradient-Top-Banner pt-3">
    <div class="flex justify-between mx-auto w-full Site-Max-Width p-4 pt-2">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('home') }}">
                <x-site-logo class="w-32 hidden sm:block" />
                <x-site-logo-small class="sm:hidden w-8" />
            </a>
        </div>
        {{-- Search Bar --}}
        <div class="w-full flex justify-center">
            <div class="w-full max-w-3xl px-4 lg:px-0">
                <script>
                    function set_bhk(id, name) {
                        // get input element with id = bhk_id and set its value to id
                        document.getElementById('bhk_id').value = id;
                        // Get span with id = bhk_name and set its innerHTML to name
                        document.getElementById('bhk_name').innerHTML = name;
                        // click the button with id = bhk_button
                        document.getElementById('bhk_button').click();

                        updateBHK(document.getElementById('bhk_id'));
                    }
                </script>
                <input type="hidden" name="bhk_id" value="" id="bhk_id">
                <div class="flex justify-center">
                    <div class="flex">
                        <button id="bhk_button" data-dropdown-toggle="bhk_dropdown"
                            class="flex w-full min-w-max bg-secondary rounded-bl-2xl w-fill pl-4 pr-2 py-2 md:pl-3 md:pr-2 md:py-3 lg:pl-8 lg:gap-6"
                            type="button">
                            <span id="bhk_name" class="text-sm md:text-base">
                                @php
                                    $bhks = $filters->bhks;
                                    // Chcek if bhks contains only one element
                                    if (count($bhks) == 1) {
                                        // If yes, then set the bhk_id to that element
                                        echo $bhks[0] . ' BHK';
                                        echo '<script>
                                            document.getElementById("bhk_id").value = ' . $bhks[0] . '
                                        </script>';
                                    } else {
                                        // If no, then set the bhk_id to 0
                                        echo 'BHK';
                                        echo '<script>
                                            document.getElementById("bhk_id").value = 0
                                        </script>';
                                    }
                                @endphp
                            </span>
                            <svg aria-hidden="true" class="ml-1 md:mt-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
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
                                        class="py-2 px-4 w-full text-sm text-gray-700 text-center hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                        1 BHK
                                    </button>
                                </li>
                                <li>
                                    <button type="button" onclick="set_bhk(2, '2 BHK')"
                                        class="py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                        2 BHK
                                    </button>
                                </li>
                                <li>
                                    <button type="button" onclick="set_bhk(3, '3 BHK')"
                                        class="py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                        3 BHK
                                    </button>
                                </li>
                                <li>
                                    <button type="button" onclick="set_bhk(4, '4 BHK')"
                                        class="py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                        4 BHK
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input type="text" id="search" onkeyup="updateSearch(this)"
                        class="w-full border-l-0 border-r-0 text-sm rounded-tr-2xl sm:text-base border-t-secondary border-b-secondary focus:border-t-secondary focus:border-b-piss-yellow focus:ring-0"
                        placeholder="Location, Amenities..." value="{{ request('query') }}">
                    <button type="button" onclick="submitForm()"
                        class="bg-piss-yellow rounded-tr-3xl rounded-bl-2xl -ml-5 px-8 py-2 text-sm sm:text-base md:py-3 hover:bg-darker ease-in-out duration-300 hidden sm:block">Search</button>
                </div>
            </div>
        </div>
        <!-- Hamburger -->
        <div class="items-center my-auto">
            <button type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                data-drawer-placement="right"
                class="inline-flex items-center justify-center p-2 pr-0 mb-2 rounded-md text-darker-3 hover:text-piss-yellow transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    <div
        class="flex sm:hidden justify-center rounded-b-2xl shadow-md border-b-1 border-l-1 border-r-1 border-b-darker-3 pb-4">
        <div class="flex items-center">
            <div>
                <h3 class="text-md text-darker-2 mr-3">Sort by:</h3>
            </div>
            <div class="ml-4">
                <select name="sort_by" id="sort_by" class="text-darker-3 border-0 p-0 focus:ring-0 bg-gray-50 w-44"
                    onchange="updateSortBy(this)">
                    <option value="recomended" @if (request('sortBy') == 'recomended') selected @endif>Featured</option>
                    <option value="price_asc" @if (request('sortBy') == 'price_asc') selected @endif>Price: Low to High
                    </option>
                    <option value="price_desc" @if (request('sortBy') == 'price_desc') selected @endif>Price: High to Low
                    </option>
                </select>
            </div>
        </div>
        <button class="pl-4" id="mobile-filter-button">
            <img src="{{ url('resources/icons/filter.svg') }}" alt="filters">
        </button>
    </div>
</div>
<!-- Drawer -->
<div id="drawer-navigation" class="fixed hidden z-40 h-screen py-4 overflow-y-auto bg-darker-2 w-96" tabindex="-1"
    aria-labelledby="drawer-navigation-label">
    <h5 id="drawer-navigation-label" class="text-base font-semibold text-secondary uppercase p-6">Menu</h5>
    <button type="button" data-drawer-dismiss="drawer-navigation" aria-controls="drawer-navigation"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <div class="py-4 overflow-y-auto">
        <x-responsive-nav-link-list />
    </div>
</div>
