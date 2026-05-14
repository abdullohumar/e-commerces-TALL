<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

new class extends Component {
    use WithFileUploads;

    public $product_id, $products;
    public $category_id, $name, $slug, $short_description, $long_description, $price, $discount_price;
    public $image_path = [];
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
        $this->products = Product::latest()->get();
    }

    public function updatedName($value)
    {
        // Hanya auto-generate slug jika belum di-edit manual (mode create)
        if (!$this->product_id) {
            $this->slug = Str::slug($value);
        }
    }
    public $old_images = [];

    public function save()
    {
        $this->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . ($this->product_id ?? 'NULL'),
            'short_description' => 'required',
            'long_description' => 'required',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'image_path.*' => 'nullable|image|max:2048',
        ]);

        if ($this->product_id) {
            // ── UPDATE ─────────────────────────────────────────────────
            $product = Product::findOrFail($this->product_id);

            $product->update([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'slug' => $this->slug,
                'short_description' => $this->short_description,
                'long_description' => $this->long_description,
                'price' => $this->price,
                'discount_price' => $this->discount_price,
            ]);

            // Jika ada gambar baru diunggah, hapus lama & simpan yang baru
            if (!empty($this->image_path)) {
                // Hapus semua gambar lama dari storage
                foreach ($product->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->image_path);
                }
                $product->images()->delete();

                // Simpan gambar baru
                foreach ($this->image_path as $index => $image) {
                    $path = $image->store('products', 'public');
                    $product->images()->create([
                        'image_path' => $path,
                        'is_primary' => $index === 0,
                    ]);
                }
            }

            $message = 'Produk berhasil diperbarui!';
        } else {
            // ── CREATE ─────────────────────────────────────────────────
            $product = Product::create([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'slug' => $this->slug,
                'short_description' => $this->short_description,
                'long_description' => $this->long_description,
                'price' => $this->price,
                'discount_price' => $this->discount_price,
            ]);

            foreach ($this->image_path as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                ]);
            }

            $message = 'Produk baru berhasil ditambahkan!';
        }

        $this->reset([
            'product_id',
            'category_id',
            'name',
            'slug',
            'short_description',
            'long_description',
            'price',
            'discount_price',
            'image_path',
            'old_images'
        ]);

        $this->products = Product::latest()->get();
        session()->flash('success', $message);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $this->product_id = $product->id;
        $this->category_id = $product->category_id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->long_description = $product->long_description;
        $this->price = $product->price;
        $this->discount_price = $product->discount_price;
        $this->old_images = $product->images;   // relasi hasMany → Collection
        $this->image_path = [];                 // reset upload baru
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if($product->images) {
            Storage::disk('public')->delete($product->images);
        }
        $product->delete();

        $this->products = Product::latest()->get();
        session()->flash('success', 'Produk berhasil dihapus');
    }

    public function rendering($view)
    {
        $view->layout('components.layouts.admin');
    }
};
?>

<div class="font-inter p-6 overflow-hidden h-screen flex">
    <div class="scrollbar min-w-3xl overflow-y-auto">

        {{-- Header --}}
        <div class="mb-6 pb-5 border-b border-white/10">
            <h1 class="text-2xl font-bold text-white">Add New Product</h1>
            <p class="mt-1 text-sm text-gray-400">Fill in the details below to add a new product to your store.</p>
        </div>

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
        <div class="border border-white/10 rounded-2xl bg-gray-800/50">

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
                        {{ $this->product_id ? 'Edit Produk: ' . $this->name : 'Tambah Produk Baru' }}
                    </h2>
                    <p class="text-xs text-gray-500">
                        {{ $product_id ? 'Ubah data produk yang dipilih' : 'Isi semua field yang diperlukan' }}
                    </p>
                </div>
            </div>
            {{-- Form Body --}}
            <form wire:submit="save">

                {{-- Nama Produk --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="name" class="block text-sm font-semibold text-white">Nama Produk</label>
                            <p class="mt-0.5 text-xs text-gray-500">Nama utama produk yang ditampilkan</p>
                        </div>
                        <div class="sm:w-2/3">
                            <input wire:model.live="name" type="text" id="name"
                                placeholder="Contoh: Aplikasi Laundry - Mobile"
                                class="block w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                            @error('name')
                                <p class="mt-1.5 text-xs text-yellow-400">⚠ {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Slug --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="slug" class="block text-sm font-semibold text-white">Slug URL</label>
                            <p class="mt-0.5 text-xs text-gray-500">Auto-generate dari nama. Bisa diedit.</p>
                        </div>
                        <div class="sm:w-2/3">
                            <div class="flex items-center rounded-xl border border-white/10 bg-gray-900/60 focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500 transition overflow-hidden">
                                <span class="px-3 text-xs text-gray-500 shrink-0 border-r border-white/10 py-2.5">/produk/</span>
                                <input wire:model="slug" type="text" id="slug"
                                    placeholder="aplikasi-laundry-mobile"
                                    class="flex-1 bg-transparent px-3 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none">
                            </div>
                            @error('slug')
                                <p class="mt-1.5 text-xs text-yellow-400 flex items-center gap-1">⚠ {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Kategori --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="category_id" class="block text-sm font-semibold text-white">Kategori</label>
                            <p class="mt-0.5 text-xs text-gray-500">Pilih kategori produk</p>
                        </div>
                        <div class="sm:w-2/3">
                            <select wire:model="category_id" id="category_id"
                                class="block w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-2.5 text-sm text-white focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                                <option value="" class="mx-3">-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1.5 text-xs text-yellow-400">⚠ {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Short Description --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="short_description" class="block text-sm font-semibold text-white">Deskripsi Singkat</label>
                            <p class="mt-0.5 text-xs text-gray-500">Tampil di kartu produk</p>
                        </div>
                        <div class="sm:w-2/3">
                            <input wire:model="short_description" type="text" id="short_description"
                                placeholder="Deskripsi ringkas produk..."
                                class="block w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                            @error('short_description')
                                <p class="mt-1.5 text-xs text-yellow-400">⚠ {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Long Description --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label for="long_description" class="block text-sm font-semibold text-white">Deskripsi Lengkap</label>
                            <p class="mt-0.5 text-xs text-gray-500">Detail lengkap produk</p>
                        </div>
                        <div class="sm:w-2/3">
                            <textarea wire:model="long_description" id="long_description" rows="5"
                                placeholder="Tuliskan detail lengkap produk di sini..."
                                class="block w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition resize-none"></textarea>
                            @error('long_description')
                                <p class="mt-1.5 text-xs text-yellow-400">⚠ {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Harga --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label class="block text-sm font-semibold text-white">Harga</label>
                            <p class="mt-0.5 text-xs text-gray-500">Harga normal & diskon (opsional)</p>
                        </div>
                        <div class="sm:w-2/3 flex flex-col gap-3">
                            <div class="flex items-center rounded-xl border border-white/10 bg-gray-900/60 focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500 transition overflow-hidden">
                                <span class="px-3 text-xs text-gray-500 shrink-0 border-r border-white/10 py-2.5">Rp</span>
                                <input wire:model="price" type="number" id="price" min="0" step="1000"
                                    placeholder="Harga normal"
                                    class="flex-1 bg-transparent px-3 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none">
                            </div>
                            @error('price')
                                <p class="-mt-1 text-xs text-yellow-400">⚠ {{ $message }}</p>
                            @enderror

                            <div class="flex items-center rounded-xl border border-white/10 bg-gray-900/60 focus-within:border-yellow-500 focus-within:ring-1 focus-within:ring-yellow-500 transition overflow-hidden">
                                <span class="px-3 text-xs text-gray-500 shrink-0 border-r border-white/10 py-2.5">Rp</span>
                                <input wire:model="discount_price" type="number" id="discount_price" min="0" step="1000"
                                    placeholder="Harga diskon (opsional)"
                                    class="flex-1 bg-transparent px-3 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none">
                            </div>
                            @error('discount_price')
                                <p class="-mt-1 text-xs text-yellow-400">⚠ {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Gambar Produk --}}
                <div class="px-6 py-5 border-b border-white/10">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="sm:w-1/3">
                            <label class="block text-sm font-semibold text-white">Foto Produk</label>
                            <p class="mt-0.5 text-xs text-gray-500">Maks. 2MB per foto. Foto pertama jadi utama.</p>
                        </div>
                        <div class="sm:w-2/3">
                            <label
                                class="flex flex-col items-center justify-center w-full h-32 rounded-xl border-2 border-dashed border-white/10 bg-gray-900/40 cursor-pointer hover:border-yellow-500/50 hover:bg-gray-900/60 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-7 text-gray-500 mb-2" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                                <span class="text-xs text-gray-500">Klik untuk pilih foto</span>
                                <input wire:model="image_path" type="file" multiple accept="image/*" class="hidden">
                            </label>

                            @error('image_path.*')
                                <p class="mt-1.5 text-xs text-yellow-400">⚠ {{ $message }}</p>
                            @enderror

                            {{-- Preview gambar baru --}}
                            @if (!empty($image_path))
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach ($image_path as $i => $img)
                                        <div class="relative group">
                                            <img src="{{ $img->temporaryUrl() }}"
                                                class="size-20 object-cover rounded-lg border border-white/10"
                                                alt="preview">
                                            @if ($i === 0)
                                                <span class="absolute top-1 left-1 text-[9px] font-bold bg-yellow-500 text-black px-1 rounded">UTAMA</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Gambar lama (saat edit) --}}
                            @if (!empty($old_images) && empty($image_path))
                                <div class="mt-3">
                                    <p class="text-xs text-gray-500 mb-2">Foto saat ini:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($old_images as $img)
                                            <img src="{{ Storage::url($img->image_path) }}"
                                                class="size-20 object-cover rounded-lg border {{ $img->is_primary ? 'border-yellow-500' : 'border-white/10' }}"
                                                alt="existing">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="px-6 py-4 flex items-center justify-end gap-3">
                    @if ($product_id)
                        <button type="button" wire:click="$set('product_id', null)"
                            class="px-4 py-2 text-sm font-medium text-gray-400 hover:text-white transition">
                            Batal Edit
                        </button>
                    @endif
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-black text-sm font-bold rounded-xl transition">
                        <span wire:loading.remove wire:target="save">
                            {{ $product_id ? 'Simpan Perubahan' : 'Tambah Produk' }}
                        </span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                </div>

            </form>
        </div>

    </div>
    <div class="scrollbar overflow-y-auto flex flex-col p-6">
        @foreach ($products as $product)
            <div class="group relative">
                <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->title }}"
                    class="border border-white/10 rounded-md h-50">
                <div
                    class="absolute inset-0 font-inter flex flex-col justify-end p-4 bg-gradient-to-tr from-black to-transparent transition-opacity duration-300 group-hover:opacity-0 group-hover:pointer-events-none">
                    <h3 class="text-yellow-500 font-bold">{{ $product->title }}</h3>
                    <p class="text-xs text-white">{{ $product->subtitle }}</p>
                </div>

                <div
                    class="absolute inset-0 font-inter flex flex-col items-center justify-center gap-2 bg-black/60 transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <button class="px-4 py-1 bg-yellow-500 text-black text-sm font-bold rounded"
                        wire:click="edit({{ $product->id }})">Edit</button>
                    <button class="px-4 py-1 bg-red-500 text-white text-sm font-bold rounded"
                        onclick="confirm('Yakin ingin menghapus banner?')"
                        wire:click="delete({{ $product->id }})">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
</div>