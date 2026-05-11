<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\HeroBanner;
use Illuminate\Support\Facades\Storage;

new class extends Component {
    use WithFileUploads;

    public $heroBanners;
    public $banner_id = null;
    public $old_image = null;
    public string $title = '';
    public string $subtitle = '';
    public ?string $cta_text = null;
    public $image = null;

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'image' => $this->banner_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'cta_text' => 'nullable|string|max:255',
        ]);

        if ($this->banner_id) {
            $banner = HeroBanner::findOrFail($this->banner_id);
            $imagePath = $banner->image_path;

            if ($this->image) {
                Storage::disk('public')->delete($banner->image_path);
                $imagePath = $this->image->store('hero_banners', 'public');
            }

            $banner->update([
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'cta_text' => $this->cta_text,
                'image_path' => $imagePath,
            ]);

            $message = 'Banner berhasil diupdate!';
        } else {
            $imagePath = $this->image->store('hero_banners', 'public');

            HeroBanner::create([
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'image_path' => $imagePath,
                'cta_text' => $this->cta_text,
            ]);

            $message = 'Banner baru berhasil ditambahkan!';
        }

        $this->reset(['title', 'subtitle', 'cta_text', 'image', 'banner_id', 'old_image']);
        $this->heroBanners = HeroBanner::latest()->get();
        session()->flash('success', $message);
    }

    public function edit($id)
    {
        $banner = HeroBanner::findOrFail($id);

        $this->banner_id = $banner->id;
        $this->title = $banner->title;
        $this->subtitle = $banner->subtitle;
        $this->cta_text = $banner->cta_text;
        $this->old_image = $banner->image_path;
        $this->image = null;
    }

    public function cancelEdit()
    {
        $this->reset(['title', 'subtitle', 'cta_text', 'image', 'banner_id', 'old_image']);
    }

    public function delete($id)
    {
        $banner = HeroBanner::findOrFail($id);
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }
        $banner->delete();

        $this->heroBanners = HeroBanner::latest()->get();
        session()->flash('success', 'Banner berhasil dihapus!');
    }

    public function mount()
    {
        $this->heroBanners = HeroBanner::latest()->get();
    }

    public function rendering($view)
    {
        $view->layout('components.layouts.admin');
    }
};
?>

<div class="flex overflow-hidden h-screen p-6">
    <div class="scrollbar font-inter min-w-3xl border-r border-white/10 pr-6 overflow-y-auto">

        {{-- Page Header --}}
        <div class="mb-6 pb-5 border-b border-white/10">
            <h1 class="text-2xl font-bold text-white">Hero Banner</h1>
            <p class="mt-1 text-sm text-gray-400">Kelola banner utama yang tampil di halaman utama website.</p>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-gray-800/50 border border-white/10 rounded-2xl overflow-hidden">

            {{-- Card Header --}}
            <div class="px-6 py-4 border-b border-white/10 flex items-center gap-3">
                <div
                    class="size-8 rounded-lg bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-yellow-500" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-white">
                        {{ $banner_id ? 'Edit Banner: ' . $title : 'Tambah Banner Baru' }}
                    </h2>
                    <p class="text-xs text-gray-500">
                        {{ $banner_id ? 'Ubah data banner yang dipilih' : 'Isi semua field yang diperlukan' }}
                    </p>
                </div>
            </div>

            <form wire:submit="save">

                {{-- Title --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="title" class="block text-sm font-semibold text-white">Judul</label>
                            <p class="mt-0.5 text-xs text-gray-500">Teks judul utama banner</p>
                        </div>
                        <div class="sm:w-2/3">
                            <input wire:model="title" type="text" id="title"
                                placeholder="Contoh: New Arrival — Summer Collection"
                                class="block w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                            @error('title')
                                <p class="mt-1.5 text-xs text-yellow-400 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Subtitle --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="subtitle" class="block text-sm font-semibold text-white">Subjudul</label>
                            <p class="mt-0.5 text-xs text-gray-500">Deskripsi singkat di bawah judul</p>
                        </div>
                        <div class="sm:w-2/3">
                            <textarea wire:model="subtitle" id="subtitle" rows="3"
                                placeholder="Contoh: Flexi Fit — Anti Kusut, flexible, cool"
                                class="block w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition resize-none"></textarea>
                            @error('subtitle')
                                <p class="mt-1.5 text-xs text-yellow-400 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="image" class="block text-sm font-semibold text-white">Gambar Banner</label>
                            <p class="mt-0.5 text-xs text-gray-500">JPG, PNG, WebP — maks. 2MB</p>
                        </div>
                        <div class="sm:w-2/3">
                            {{-- Upload Area --}}
                            <label for="image"
                                class="flex flex-col items-center justify-center w-full h-36 rounded-xl border-2 border-dashed border-white/10 bg-gray-900/40 cursor-pointer hover:border-yellow-500/50 hover:bg-yellow-500/5 transition group">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="h-full w-full object-cover rounded-xl" alt="Preview">
                                @elseif ($old_image)
                                    <img src="{{ Storage::url($old_image) }}"
                                        class="h-full w-full object-cover rounded-xl" alt="Old Image">
                                @else
                                    {{-- Ikon Upload --}}
                                    <div
                                        class="flex flex-col items-center gap-2 text-gray-500 group-hover:text-yellow-500 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                        </svg>
                                        <span class="text-xs font-medium">Klik untuk upload gambar</span>
                                    </div>
                                @endif
                                <input wire:model="image" type="file" id="image" class="hidden" accept="image/*">
                            </label>

                            {{-- Loading indicator --}}
                            <div wire:loading wire:target="image"
                                class="mt-2 flex items-center gap-2 text-xs text-gray-400">
                                <svg class="animate-spin size-4 text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Mengupload gambar...
                            </div>

                            @error('image')
                                <p class="mt-1.5 text-xs text-yellow-400 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- CTA Text --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="cta_text" class="block text-sm font-semibold text-white">
                                Teks Tombol
                                <span class="ml-1 text-xs font-normal text-gray-500">(opsional)</span>
                            </label>
                            <p class="mt-0.5 text-xs text-gray-500">Label pada tombol call-to-action</p>
                        </div>
                        <div class="sm:w-2/3">
                            <input wire:model="cta_text" type="text" id="cta_text"
                                placeholder="Contoh: Harus punya!"
                                class="block w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                            @error('cta_text')
                                <p class="mt-1.5 text-xs text-yellow-400 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="px-6 py-4 bg-gray-900/30 flex items-center justify-between">
                    <p class="text-xs text-gray-600">* Field wajib diisi</p>
                    <div class="flex items-center gap-3">
                        @if ($banner_id)
                            <button type="button" wire:click="cancelEdit"
                                class="px-4 py-2 text-sm font-medium text-red-400 hover:text-white border border-red-500/20 rounded-xl hover:bg-red-500/10 transition">
                                Batal Edit
                            </button>
                        @else
                            <button type="button" wire:click="cancelEdit"
                                class="px-4 py-2 text-sm font-medium text-gray-400 hover:text-white border border-white/10 rounded-xl hover:bg-white/5 transition">
                                Reset
                            </button>
                        @endif
                        <button type="submit"  
                            @if (empty($title) || (!$banner_id && empty($image))) 
                                disabled 
                            @endif
                            wire:loading.attr="disabled" wire:target="save"
                            class="inline-flex items-center gap-2 px-5 py-2 text-sm font-semibold rounded-xl text-black bg-yellow-500 transition disabled:opacity-50 disabled:cursor-not-allowed enabled:hover:bg-yellow-400">

                            {{-- Ikon & Teks saat Normal --}}
                            <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                {{ $banner_id ? 'Update Banner' : 'Simpan Banner' }}
                            </span>

                            {{-- Ikon & Teks saat Loading --}}
                            <span wire:loading wire:target="save" class="flex items-center gap-2">
                                <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
    <div class="scrollbar flex flex-col w-full px-6 py-8 gap-2 overflow-y-auto">
        @foreach ($heroBanners as $banner)
            <div class="group relative">
                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}"
                    class="border border-white/10 rounded-md h-50">
                <div
                    class="absolute inset-0 font-inter flex flex-col justify-end p-4 bg-gradient-to-tr from-black to-transparent transition-opacity duration-300 group-hover:opacity-0 group-hover:pointer-events-none">
                    <h3 class="text-yellow-500 font-bold">{{ $banner->title }}</h3>
                    <p class="text-xs text-white">{{ $banner->subtitle }}</p>
                </div>

                <div
                    class="absolute inset-0 font-inter flex flex-col items-center justify-center gap-2 bg-black/60 transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button class="px-4 py-1 bg-yellow-500 text-black text-sm font-bold rounded"
                        wire:click="edit({{ $banner->id }})">Edit</button>
                    <button class="px-4 py-1 bg-red-500 text-white text-sm font-bold rounded"
                        onclick="confirm('Yakin ingin menghapus banner?')"
                        wire:click="delete({{ $banner->id }})">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
