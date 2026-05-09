<?php

use Livewire\Component;

new class extends Component {
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
};
?>

<nav x-data="{ openMobile: false, openProfile: false, openProject: false }"
    class="relative z-50 bg-gray-900/80 backdrop-blur-sm border-b border-white/10">
    <div class="mx-auto w-full px-4 sm:px-8 lg:px-18">
        <div class="relative flex h-16 items-center justify-between">

            {{-- Mobile menu button --}}
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button type="button" @click="openMobile = !openMobile"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!openMobile" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <svg x-show="openMobile" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" class="size-6">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            {{-- Brand + Nav Links --}}
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                {{-- Brand --}}
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-xl font-black italic tracking-tighter uppercase text-white leading-none">
                        Jadi<span class="text-yellow-500">Digital</span>
                    </a>
                </div>

                {{-- Desktop Nav Links --}}
                <div class="hidden sm:ml-8 sm:flex sm:items-center sm:space-x-1">
                    <a href="{{ route('dashboard') }}"
                        class="rounded-md px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-white transition">
                        Dashboard
                    </a>
                    <a href="#"
                        class="rounded-md px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-white transition">
                        Produk
                    </a>

                    {{-- Dropdown: Kategori --}}
                    <div class="relative" x-data="{ openProject: false }" @mouseenter="openProject = true"
                        @mouseleave="openProject = false">
                        <button
                            class="rounded-md px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-white flex items-center gap-1 transition">
                            Kategori
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
                            class="absolute left-0 z-10 pt-2 w-48 origin-top-left">
                            <div class="bg-gray-800 rounded-xl border border-white/10 shadow-xl py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-yellow-400 transition">
                                    Pakaian Pria
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-yellow-400 transition">
                                    Pakaian Wanita
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-yellow-400 transition">
                                    Aksesoris
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="#"
                        class="rounded-md px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-white transition">
                        Promo
                    </a>
                </div>
            </div>

            {{-- Right Side Actions --}}
            <div class="absolute inset-y-0 right-0 flex items-center gap-3 pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                {{-- Notification Bell --}}
                <button type="button"
                    class="relative rounded-full p-2 text-gray-400 hover:text-white hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        aria-hidden="true" class="size-5">
                        <path
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                {{-- Search --}}
                <div x-data="{ onSearch: false }" @click="onSearch = true" @click.away="onSearch = false"
                    class="flex items-center transition-all duration-300 rounded-lg"
                    :class="onSearch ? 'w-56 bg-gray-800/60 ring-1 ring-yellow-500 px-3' : 'w-9'">
                    <div class="cursor-pointer p-2 rounded-full flex items-center justify-center shrink-0 transition-colors"
                        :class="onSearch ? 'text-yellow-500' : 'text-gray-400 hover:text-white'">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input x-show="onSearch" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        class="w-full bg-transparent outline-none text-white text-sm placeholder-gray-500"
                        type="text" placeholder="Cari produk..." autofocus>
                </div>

                {{-- Cart Icon --}}
                <button type="button"
                    class="relative rounded-full p-2 text-gray-400 hover:text-white hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </button>

                {{-- Profile Dropdown --}}
                <div class="relative">
                    <button @click="openProfile = !openProfile" @click.away="openProfile = false" type="button"
                        class="relative flex items-center gap-2 rounded-full focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        <span class="sr-only">Open user menu</span>
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt=""
                            class="size-8 rounded-full outline outline-2 outline-yellow-500/50 hover:outline-yellow-500 transition" />
                    </button>

                    <div x-show="openProfile" x-cloak x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-52 origin-top-right rounded-xl bg-gray-800 border border-white/10 py-1 shadow-xl">

                        {{-- User Info --}}
                        <div class="px-4 py-3 border-b border-white/10">
                            <p class="text-xs font-black uppercase tracking-widest text-yellow-500">JadiDigital</p>
                            <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name ?? 'User' }}</p>
                        </div>

                        <a href="#"
                            class="block px-4 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-yellow-400 transition">
                            Profil Saya
                        </a>
                        <a href="#"
                            class="block px-4 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-yellow-400 transition">
                            Pengaturan
                        </a>
                        <div class="border-t border-white/10 mt-1 pt-1">
                            <button wire:click="logout"
                                class="w-full text-left block px-4 py-2 text-sm font-bold uppercase tracking-wide text-gray-400 hover:bg-red-500/10 hover:text-red-400 transition">
                                Sign Out
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="openMobile" x-cloak x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="sm:hidden bg-gray-900/95 border-t border-white/10">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ route('dashboard') }}"
                class="block rounded-lg px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-white transition">
                Dashboard
            </a>
            <a href="#"
                class="block rounded-lg px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-white transition">
                Produk
            </a>

            {{-- Mobile Dropdown: Kategori --}}
            <div @click="openProject = !openProject">
                <button type="button"
                    class="w-full flex items-center justify-between rounded-lg px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-white transition">
                    Kategori
                    <svg :class="openProject ? 'rotate-90' : ''"
                        class="size-4 transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
                <div x-show="openProject" x-cloak class="pl-4 mt-1 space-y-1">
                    <a href="#"
                        class="block rounded-lg px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-400 hover:text-yellow-400 transition">
                        Pakaian Pria
                    </a>
                    <a href="#"
                        class="block rounded-lg px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-400 hover:text-yellow-400 transition">
                        Pakaian Wanita
                    </a>
                    <a href="#"
                        class="block rounded-lg px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-400 hover:text-yellow-400 transition">
                        Aksesoris
                    </a>
                </div>
            </div>

            <a href="#"
                class="block rounded-lg px-3 py-2 text-sm font-bold uppercase tracking-wide text-gray-300 hover:bg-white/5 hover:text-white transition">
                Promo
            </a>
        </div>
    </div>
</nav>
