<?php

use Livewire\Component;
use App\Models\HeroBanner;

new class extends Component {
    public $heroBanners;
    public int $activeIndex = 0;

    public function mount()
    {
        $this->heroBanners = HeroBanner::latest()->get();
    }

    public function goTo(int $index): void
    {
        $this->activeIndex = $index;
    }

    public function next(): void
    {
        $this->activeIndex = ($this->activeIndex + 1) % $this->heroBanners->count();
    }

    public function prev(): void
    {
        $count = $this->heroBanners->count();
        $this->activeIndex = ($this->activeIndex - 1 + $count) % $count;
    }
};
?>

{{-- Jika tidak ada data banner, tampilkan fallback --}}
@if ($heroBanners->isEmpty())
    <div class="relative overflow-hidden mb-4 h-[800px]">
        <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&q=80"
            class="absolute inset-0 w-full h-full object-cover" alt="Hero">
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent flex flex-col justify-center px-12">
            <h1 class="text-5xl font-black italic tracking-tighter uppercase leading-none">Welcome <br> To JadiDigital
            </h1>
            <p class="mt-4 text-gray-300 font-medium">Belum ada banner. Tambahkan di halaman admin.</p>
        </div>
    </div>
@else
    <div class="relative overflow-hidden mb-4 h-[500px]">

        {{-- Slides --}}
        @foreach ($heroBanners as $i => $banner)
            <div class="absolute inset-0 transition-opacity duration-700"
                style="{{ $i === $activeIndex ? 'opacity:1; z-index:1;' : 'opacity:0; z-index:0;' }}">

                {{-- Gambar dari storage --}}
                <img src="{{ Storage::url($banner->image_path) }}" class="absolute inset-0 w-full h-full object-cover"
                    alt="{{ $banner->title }}">

                {{-- Overlay + Konten --}}
                <div
                    class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent flex flex-col justify-center px-12 pointer-events-none">
                    <h1 class="text-5xl font-black italic tracking-tighter uppercase leading-none">
                        {!! nl2br(e($banner->title)) !!}
                    </h1>
                    @if ($banner->subtitle)
                        <p class="mt-4 text-gray-300 font-medium">{{ $banner->subtitle }}</p>
                    @endif
                    @if ($banner->cta_text)
                        <a href="{{ $banner->cta_link ?? '#' }}"
                            class="mt-8 bg-yellow-500 text-black font-bold py-3 px-8 rounded-lg w-fit hover:bg-yellow-400 transition pointer-events-auto">
                            {{ $banner->cta_text }}
                        </a>
                    @endif
                </div>
            </div>
        @endforeach

        {{-- Tombol Prev / Next (hanya jika > 1 banner) --}}
        @if ($heroBanners->count() > 1)
            <button wire:click="prev"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-10 size-10 flex items-center justify-center rounded-full bg-black/40 hover:bg-black/60 text-white transition backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button wire:click="next"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-10 size-10 flex items-center justify-center rounded-full bg-black/40 hover:bg-black/60 text-white transition backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        @endif

        {{-- Dot Indicator --}}
        @if ($heroBanners->count() > 1)
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 flex items-center gap-2">
                @foreach ($heroBanners as $i => $banner)
                    <button wire:click="goTo({{ $i }})"
                        class="rounded-full transition-all duration-300 {{ $i === $activeIndex ? 'w-6 h-2 bg-yellow-500' : 'size-2 bg-white/40 hover:bg-white/60' }}">
                    </button>
                @endforeach
            </div>
        @endif

    </div>
@endif
