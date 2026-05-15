<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component {
    public $all, $web, $mobile;
    public function mount()
    {
        $this->all = Product::all();
        $this->web = Product::whereHas('category', fn($q) => $q->where('slug', 'website'))->get();
        $this->mobile = Product::whereHas('category', fn($q) => $q->where('slug', 'mobile'))->get();
    }
};
?>

<section class="py-16 px-4 bg-black mt-2 rounded-md">
    <div class="max-w-7xl mx-auto">

        {{-- Section Header --}}
        <div class="text-center mb-5">
            <h2 class="text-3xl font-black italic tracking-tighter uppercase text-white">Katalog Produk</h2>
            <p class="text-gray-400 mt-2 text-sm font-medium">Temukan produk terbaik kami untuk kebutuhanmu</p>
            <div class="mx-auto mt-4 h-1 w-16 rounded-full bg-yellow-500"></div>
        </div>

        {{-- Tab Navigation --}}
        <div x-data="{ activeTab: 'all' }">
            <div class="flex items-center justify-center gap-2 mb-10">
                <button
                    @click="activeTab = 'all'"
                    :class="activeTab === 'all'
                        ? 'bg-yellow-500 text-black shadow-lg shadow-yellow-500/30'
                        : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'"
                    class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                    Semua Produk
                </button>
                <button
                    @click="activeTab = 'website'"
                    :class="activeTab === 'website'
                        ? 'bg-yellow-500 text-black shadow-lg shadow-yellow-500/30'
                        : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'"
                    class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                    Website
                </button>
                <button
                    @click="activeTab = 'mobile'"
                    :class="activeTab === 'mobile'
                        ? 'bg-yellow-500 text-black shadow-lg shadow-yellow-500/30'
                        : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white'"
                    class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300">
                    Mobile
                </button>
            </div>

            {{-- Tab: Semua --}}
            <div x-show="activeTab === 'all'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($all as $product)
                    @include('components.⚡product-card', ['product' => $product])
                @endforeach
            </div>

            {{-- Tab: Website --}}
            <div x-show="activeTab === 'website'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($web as $product)
                    @include('components.⚡product-card', ['product' => $product])
                @endforeach
            </div>

            {{-- Tab: Mobile --}}
            <div x-show="activeTab === 'mobile'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($mobile as $product)
                    @include('components.⚡product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </div>
</section>
