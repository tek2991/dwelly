<x-public-layout>
    <div id="hero">
        <img src="{{ url('resources/images/city_bg.svg') }}" alt="City Background" class="w-full mt-12 mb-6 sm:mb-12">
    </div>
    <div class="md:flex justify-between">
        <div>
            <h1 class="Left-Space p-4 md:p-2 font-GraphikSemibold text-4xl text-darker-3 ">Contact Us</h1>
            <div class="border-r-8 border-r-piss-yellow bg-secondary pr-6 lg:pr-12 mr-6 lg:mr-0">
                <address class="Left-Space p-4 font-GraphikSemibold text-darker-3 font-2xl">
                    <div class="my-4">
                        <a href="tel:+91 96786 44832" class="flex gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            +91 96786 44832
                        </a>
                    </div>
                    <div class="my-4">
                        <a href="mailto:hello@dwelly.in" class="flex gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            hello@dwelly.in
                        </a>
                    </div>
                    <div class="my-4">
                        <a href="#map" class="flex gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            Debadaru Path, Ambikagiri Nagar, Guwahati, Assam 781024
                        </a>
                    </div>
                </address>
            </div>
        </div>
        <div class="bg-white border-2 border-secondary rounded-sm shadow-md p-4 md:p-8 mt-8 md:-mt-32 Right-Space">
            <livewire:contact-form />
        </div>
    </div>
    <div id="map" class="w-full mt-20">
        <!-- <span class="col s12 m10 offset-m1"><h3>Location</h3></span> -->
        <iframe width="100%" height="500px" frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed/v1/place?q=Tranqville,+Debadaru Path,+Ambikagirinagar,+Guwahati,+Assam+781024&key={{ env('GOOGLE_MAPS_API_KEY') }}"
            allowfullscreen></iframe>
    </div>
</x-public-layout>
