{{-- Product Card Component --}}
{{-- Usage: @include('components.⚡product-card', ['product' => $product]) --}}

<div class="group bg-white/5 rounded-2xl overflow-hidden border border-white/20 hover:border-yellow-500/60 transition-all duration-300 hover:shadow-xl hover:shadow-yellow-500/10 hover:-translate-y-1">

    {{-- Product Image --}}
    <div class="relative overflow-hidden aspect-video bg-white/5">
        @if ($product->images->first())
            <img
                src="{{ Storage::url($product->images->first()->image_path) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        {{-- Category badge --}}
        @if ($product->category)
            <span class="absolute top-3 left-3 bg-yellow-500 text-black text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                {{ $product->category->name }}
            </span>
        @endif
    </div>

    {{-- Product Info --}}
    <div class="p-5">
        <h3 class="text-white font-bold text-base mb-1 truncate group-hover:text-yellow-400 transition-colors duration-200">
            {{ $product->name }}
        </h3>
        <p class="text-gray-500 text-sm line-clamp-2 mb-4">
            {{ $product->short_description ?? '-' }}
        </p>

        {{-- Price --}}
        <div class="flex items-end justify-between">
            <div>
                @if ($product->discount_price)
                    <span class="text-gray-500 text-xs line-through block">
                        Rp {{ number_format($product->price, 0, ',', '.') }} / bulan
                    </span>
                    <span class="text-yellow-400 font-bold text-lg">
                        Rp {{ number_format($product->discount_price, 0, ',', '.') }} / bulan
                    </span>
                @else
                    <span class="text-yellow-400 font-bold text-lg">
                        Rp {{ number_format($product->price, 0, ',', '.') }} / bulan
                    </span>
                @endif
            </div>

            <a href="#"
                class="text-xs bg-yellow-500 hover:bg-yellow-400 text-black font-bold px-4 py-2 rounded-lg transition-colors duration-200">
                Detail
            </a>
        </div>
    </div>
</div>
