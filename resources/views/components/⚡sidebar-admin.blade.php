<?php

use Livewire\Component;

new class extends Component {
    public function logout()
    {
        Auth::logout();
        return redirect()->route('guest.dashboard');
    }
};
?>

<div class="font-inter" x-data="{ sidebarOpen: true }">
    <aside class="antialiased font-black h-screen overflow-hidden flex-shrink-0 w-64 bg-gray-900/80 backdrop-blur-sm">
        <div class="p-4 py-7 border-b border-white/10 flex items-center justify-center gap-2 w-full">
            <h1 class="text-2xl font-black font-inter italic tracking-tight uppercase text-white leading-none">Admin
                <span class="text-yellow-500">Panel</span>
            </h1>            
        </div>
        <div class="w-full h-15 flex items-center px-7">
            <a href="#" class="text-md font-semibold text-gray-300">Dashboard</a>
        </div>
        <div class="w-full h-15 flex items-center px-7 border-b border-white/10">
            <a href="{{ route('guest.dashboard') }}" class="text-md font-semibold text-gray-300">Guest Dashboard</a>
        </div>
        <div class="w-full h-15 flex items-center px-7">
            <a href="{{ route('admin.hero-banner') }}" class="text-md font-semibold text-gray-300">Hero Banner</a>
        </div>
        <div class="w-full h-15 flex items-center px-7">
            <a href="#" class="text-md font-semibold text-gray-300">Product Banner</a>
        </div>
        <div class="w-full h-15 flex items-center px-7 border-b border-white/10">
            <a href="#" class="text-md font-semibold text-gray-300">Promo Banner</a>
        </div>
        <div class="w-full h-15 flex items-center px-7 hover:bg-gray-500">
            <button wire:click="logout()" class="text-md font-semibold text-gray-300 cursor-pointer w-full">
                Log Out
            </button>
        </div>
    </aside>
</div>
