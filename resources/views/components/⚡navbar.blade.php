<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<nav x-data="{ openMobile: false, openProfile: false, openProject: false }"
    class="relative bg-gray-800/50 after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">
    <div class="mx-auto w-full px-4 sm:px-8 lg:px-18">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" @click="openMobile = !openMobile"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-black-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!openMobile" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" data-slot="icon"class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <svg x-show="openMobile" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" data-slot="icon" class="size-6">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <h3 class="font-brand text-[1.25rem]">My App</h3>
                </div>
                <div class="hidden sm:ml-6 sm:block font-inter">
                    <div class="flex space-x-4 nav-links">
                        <a href="#" class="rounded-md  px-3 py-2 text-sm font-medium text-gray-300">Dashboard</a>
                        <a href="#"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Team</a>

                        <div class="relative" x-data="{ openProject: false }" @mouseenter="openProject = true"
                            @mouseleave="openProject = false">

                            <button
                                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white flex items-center gap-1">
                                Projects
                                <svg :class="openProject ? 'rotate-180' : ''"
                                    class="size-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="openProject" x-cloak x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute left-0 z-10 pt-2 w-48 origin-top-left rounded-md  py-1 shadow-lg">
                                <p></p>
                                <div class="bg-gray-800 rounded-md">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">Web
                                        Design</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">App
                                        Development</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">E-Commerce</a>
                                </div>

                            </div>
                        </div>

                        <a href="#"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
                    </div>
                </div>
            </div>
            <div
                class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 gap-5">
                <button type="button"
                    class="relative rounded-full p-1 text-gray-800 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6">
                        <path
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                {{-- Search --}}
                <div x-data="{ onSearch: false }" @click="onSearch = true" @click.away="onSearch = false"
                    class="flex items-center transition-all duration-300 rounded-md"
                    :class="onSearch ? 'w-64 bg-gray-800/40 ring-1 ring-gray-500 px-2' : 'w-10'">

                    <div class="cursor-pointer p-2 rounded-full flex items-center justify-center shrink-0 transition-colors"
                        :class="onSearch ? '' : 'hover:bg-gray-800 hover:text-white'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5" :class="onSearch ? 'text-white' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>

                    <input x-show="onSearch" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="w-full bg-transparent outline-none text-white text-sm border-b border-gray-600 focus:border-white transition-colors"
                        type="text" placeholder="Search..." autofocus>
                </div>
                <!-- Profile dropdown -->
                <div class="relative ml-3">

                    <button @click="openProfile = !openProfile" @click.away="openProfile = false" type="button"
                        class="relative flex rounded-full focus:outline-none">
                        <span class="sr-only">Open user menu</span>
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt=""
                            class="size-8 rounded-full bg-gray-800 outline -outline-offset-1 outline-white/10" />
                    </button>

                    <div x-show="openProfile" x-cloak x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-gray-800 py-1 shadow-lg ring-1 ring-white/10">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">Your
                            profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">Settings</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">Sign out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-show="openMobile" x-cloak class="sm:hidden bg-gray-900/50 nav-links">
        <div class="space-y-1 px-2 pt-2 pb-3 relative">
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300">Dashboard</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300">Team</a>
            <div @mouseover="openProject = true" @mouseleave="openProject = false">
                <button type="button"
                    class="flex items-center rounded-md px-3 py-2 text-base font-medium text-gray-300 gap-3">
                    Projects
                    </svg>
                    <svg :class="openProject ? 'rotate-90' : ''"
                        class="size-4 transition-transform duration-200 translate-y-[1.05px]"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
                <div x-show="openProject" x-cloak x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute top-25 left-30 z-10 w-48 origin-top-left rounded-md bg-gray-800 shadow-lg ring-1 ring-white/10">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">Web
                        Design</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">App
                        Development</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">E-Commerce</a>
                </div>
            </div>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300">Calendar</a>
        </div>
    </div>
</nav>
