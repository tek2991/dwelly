<div class="flex justify-between fixed w-full z-20" style="background: linear-gradient(to right, #e6e6e6 59%, #4c4d47 41%);">
    <div class="flex justify-between mx-auto w-full Site-Max-Width p-4 pt-2">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('home') }}">
                <x-site-logo class="w-32" />
            </a>
        </div>
        <!-- Hamburger -->
        <div class="items-center my-auto">
            <button type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                data-drawer-placement="right"
                class="inline-flex items-center justify-center p-2 mb-8 rounded-md text-secondary hover:text-piss-yellow transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</div>
<!-- Drawer -->
<div id="drawer-navigation" class="fixed hidden z-40 h-screen py-4 overflow-y-auto bg-darker-2 w-96"
    tabindex="-1" aria-labelledby="drawer-navigation-label">
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