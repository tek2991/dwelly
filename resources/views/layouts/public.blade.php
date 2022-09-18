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
        @if (Route::is('owners'))
            <x-nav-owners />
        @elseif (Route::is('property.index'))
            <x-nav-search />
        @else
            <x-nav-main />
        @endif
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
                    <a href="https://www.facebook.com/www.dwelly.in" class="flex text-blue-500 font-GraphikSemibold">
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

    <!-- Before-body-end -->
    @yield('before-body-end')
    <script>
        // remove hidden from drawer-navigation after page load
        // to prevent flash of unstyled content
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('drawer-navigation').classList.remove('hidden');
        });
    </script>
</body>

</html>
