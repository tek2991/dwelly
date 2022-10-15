{{-- Property props --}}
@props(['property' => null])
<div class="flex" x-data="{ dropdownOpen: false }" @mouseleave="dropdownOpen = false">
    <button class="flex items-center px-4 tracking-wide border-2 rounded-full md:ml-4" @mouseover="dropdownOpen = true">
        <img src="{{ url('/resources/icons/share.svg') }}" alt="share icon" class="mr-2 h-5">
        <span class="text-lg">
            Share
        </span>
    </button>

    <div class="relative">
        <div x-show="dropdownOpen"
            class="absolute right-0 mt-8 w-48 bg-white rounded-md overflow-hidden shadow-xl z-20">
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.dwelly.in/pages/viewProperty/{{ $property->id }}" title="Share on Facebook" class="flex px-4 py-2 text-sm text-gray-800 border-b hover:bg-blue-100">
                <img src="{{ url('resources/icons/facebook.svg') }}" alt="" class="w-5 mr-3">
                <span class="text-gray-600">Facebook</span>
              </a>
              <a href="https://api.whatsapp.com/send?text=Check%20out%20this%20awesome%20property%20on%20Dwelly%20https://www.dwelly.in/pages/viewProperty/{{ $property->id }}" title="Share on Whatsapp" class="flex px-4 py-2 text-sm text-gray-800 border-b hover:bg-blue-100">
                <img src="{{ url('resources/icons/whatsapp.svg') }}" alt="" class="w-5 mr-3">
                <span class="text-gray-600">Whatsapp</span>
              </a>
              <a href="mailto:?subject=I love this property on Dwelly&body=2BHK 2Bath Apartment. Here's the link https://www.dwelly.in/pages/viewProperty/{{ $property->id }}" title="Share on Email" class="flex px-4 py-2 text-sm text-gray-800 border-b hover:bg-blue-100">
                <img src="{{ url('resources/icons/email.svg') }}" alt="" class="w-5 mr-3">
                <span class="text-gray-600">Email</span>
              </a>
              <a href="#" title="Download PDF" class="flex px-4 py-2 text-sm text-gray-800 border-b hover:bg-blue-100">
                <img src="{{ url('resources/icons/pdf.svg') }}" alt="" class="w-5 mr-3">
                <span class="text-gray-600">Brochure</span>
              </a>
        </div>
    </div>
</div>
