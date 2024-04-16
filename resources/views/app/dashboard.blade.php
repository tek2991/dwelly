<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($stats as $name => $stat)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div
                            class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                {{ $name }}
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ $stat }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @hasrole('admin')
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h2 class="text-xl font-regular pt-2 pb-4">
                        All Pending tasks
                    </h2>
                    <livewire:task.all-pending-task />
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h2 class="text-xl font-regular pt-2 pb-4">
                        My Pending tasks
                    </h2>
                    <livewire:task.assigned-pending-task />
                </div>
            @endhasrole
        </div>
    </div>
</x-app-layout>
