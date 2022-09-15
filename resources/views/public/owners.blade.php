<x-public-layout>
    <div class="">
        <div id="hero" style="background: linear-gradient(to right, #e6e6e6 59%, #4c4d47 41%);" class="pt-6">
            <div class="w-full"
                style="background-image: url({{ url('resources/images/city_bg_30.png') }});
                background-size: cover;
                background-repeat: no-repeat;
                background-position: bottom;">
                <div class="Site-Max-Width mx-auto p-4 flex justify-between items-end">
                    <div class="py-3">
                        <h2 class="font-GraphikMedium leading-none text-darker-3 text-5xl">
                            What <br>
                            dwelly <br>
                            does for you?
                        </h2>
                        <p class="py-4 text-darker-3 text-lg">
                            End to end property management <br> solutions for residential properties
                        </p>
                        <button type="button"
                            class="col-span-3 bg-darker-3 text-piss-yellow rounded-sm text-center p-4 text-lg hover:bg-piss-yellow hover:text-darker-3 ease-in-out duration-300 cursor-pointer w-full">
                            RENT OUT WITH DWELLY
                        </button>
                    </div>
                    <div>
                        <h1 class="text-right font-GraphikSemibold text-piss-yellow text-8xl">
                            <div >for</div>
                            <div class="font-GraphikLight text-white text-3xl my-4 underline decoration-piss-yellow decoration-4">dwelly</div>
                            <div >Owners</div>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #transparant-bg::after {
            background-image: url({{ url('resources/images/city_bg.svg') }});
            opacity: .3;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: bottom;
            class="pt-8 sm:flex

        }
    </style>
</x-public-layout>
