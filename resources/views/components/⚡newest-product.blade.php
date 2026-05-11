<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component
{
    public $newestProducts;

    public function mount()
    {
        $this->newestProducts = Product::latest()->take(1)->get();
    }
};
?>

<div>
    @if ($newestProducts->isEmpty())
        <div class="relative overflow-hidden rounded-2xl h-[400px]">
                <img src="https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?auto=format&fit=crop&q=80"
                    class="absolute inset-0 w-full h-full object-cover" alt="Oxford Shirt">
                <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center">
                    <span class="text-xs font-bold uppercase tracking-widest mb-1">New Arrival Cuy</span>
                    <h2 class="text-4xl font-black italic uppercase leading-none">Belum Ada <br> Produk Baru</h2>
                </div>
            </div>

    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($newestProducts as $product)
                <div class="relative overflow-hidden rounded-2xl h-[400px]">
                    <img src="{{ $product->images->first()->image_path }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $product->name }}">
                    <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center">
                        <span class="text-xs font-bold uppercase tracking-widest mb-1">New Arrival</span>
                        <h2 class="text-4xl font-black italic uppercase leading-none">{{ $product->name }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>