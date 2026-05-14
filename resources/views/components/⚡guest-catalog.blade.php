<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div  x-data="{ activeTab: 'all' }">
    <div class="flex items-center justify-around my-2">
        <button class="text-white py-2 px-4 w-full h-full" @click="activeTab = 'all'"
            :class="activeTab==='all' ? 'bg-red-900' : ''">Semua Produk</button>
        <button class="text-white py-2 px-4 w-full h-full" @click="activeTab = 'website'"
            :class="activeTab==='website' ? 'bg-red-900' : ''">Website</button>
        <button class="text-white py-2 px-4 w-full h-full" @click="activeTab = 'mobile'"
            :class="activeTab==='mobile' ? 'bg-red-900' : ''">Mobile</button>
    </div>
    <div class="bg-yellow-200 p-4" x-show="activeTab === 'all'">
        <p>Ini semua produk</p>
    </div>
    <div class="bg-gray-200 p-4" x-show="activeTab === 'website'">
        <p>Ini website</p>
    </div>
    <div class="bg-gray-200 p-4" x-show="activeTab === 'mobile'">
        <p>Ini mobile</p>
    </div>
</div>
