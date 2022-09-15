<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div>
        <div class="flex justify-between Gradient-Top-Banner fixed w-full z-20">
            <div class="flex justify-between mx-auto w-full Site-Max-Width p-4 md:mb-8"
                style="background-image: url({{ url('/resources/images/clouds.png') }}); background-repeat: no-repeat; background-position: bottom; background-size: 32vw">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-site-logo class="w-32" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-0 sm:-my-px sm:ml-10 md:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('owners')" :active="request()->routeIs('owners')">
                        {{ __('Owners') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="items-center my-auto md:hidden">
                <button type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                    data-drawer-placement="right"
                    class="inline-flex items-center justify-center p-2 md:mb-8 rounded-md text-darker-3 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Drawer -->
        <div id="drawer-navigation" class="fixed hidden z-40 h-screen py-4 overflow-y-auto bg-darker-2 w-80" tabindex="-1"
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
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('owners')" :active="request()->routeIs('owners')">
                    {{ __('Owners') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                    {{ __('About') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                    {{ __('Contact') }}
                </x-responsive-nav-link>
            </div>
        </div>
        <div class="font-sans text-gray-900 antialiased min-h-screen pt-24">
            {{ $slot }}
        </div>
        <div class="bg-darker-3">
            <footer>
                <div class="Site-Max-Width mx-auto py-8 grid grid-cols-3 text-secondary">
                    <div class="p-4">
                        <h2 class="font-GraphikMedium text-xl my-4">About Us</h2>
                        <p class="text-justify">
                            Dwelly is an end to end property management business, founded in August 2018, to enable
                            tenants
                            to find and live in rental properties without any hassle.
                        </p>
                    </div>
                    <div class="p-4">
                        <h2 class="font-GraphikMedium text-xl my-4">Contact Us</h2>
                        <p class="text-justify">Debadaru Path, <br>
                            Ambikagiri Nagar, Zoo Road <br>
                            Guwahati, Assam 781024
                        </p>
                        <p class="text-justify mt-4">+91 96786 44832 <br>
                            hello@dwelly.in</p>
                    </div>
                    <div class="p-4">
                        <h2 class="font-GraphikMedium text-xl my-4">Follow Us</h2>
                        <a href="https://www.facebook.com/www.dwelly.in"
                            class="flex text-blue-500 font-GraphikSemibold">
                            <svg fill="#3f83f8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="250px"
                                height="250px" class="w-6 h-6 mr-1">
                                <path
                                    d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z" />
                            </svg>
                            Facebook
                        </a>
                    </div>
                </div>
                <a title="Call: +91 96786 44832" href="tel:+91 96786 44832"
                    class="fixed z-90 bottom-10 right-8 bg-piss-yellow h-15 p-2 rounded-full drop-shadow-lg flex justify-center items-center text-white text-4xl hover:bg-yellow-400 hover:drop-shadow-2xl hover:animate-bounce duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                </a>
            </footer>
        </div>
    </div>
    <!-- Before-body-end -->
    @yield('before-body-end')
    <script>
        // remove hidden from drawer-navigation after page load
        // to prevent flash of unstyled content
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('drawer-navigation').classList.remove('hidden');
        });
    </script>
</body>

</html>
