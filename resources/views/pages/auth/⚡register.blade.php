<?php
use Livewire\Volt\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

new class extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';

    public function register()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        return redirect()->route('login');
    }

    public function rendering($view)
    {
        $view->layout('components.layouts.auth');
    }
};
?>

<div class="min-h-screen bg-gray-900 flex items-center justify-center px-4 font-sans">

    {{-- Background decorative blobs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -right-32 size-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 size-96 bg-yellow-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">

        {{-- Brand Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black italic tracking-tighter uppercase text-white leading-none">
                Jadi<span class="text-yellow-500">Digital</span>
            </h1>
            <p class="mt-2 text-gray-400 text-sm font-medium">Buat akun baru dan mulai</p>
        </div>

        {{-- Card --}}
        <div class="bg-gray-800/60 backdrop-blur border border-white/10 rounded-2xl p-8 shadow-2xl">
            <h2 class="text-xl font-black italic uppercase text-white mb-6">Daftar Akun Baru</h2>

            <form wire:submit="register" class="space-y-5">

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">
                        Nama Lengkap
                    </label>
                    <input wire:model="name" type="text" id="name" required autofocus
                        class="w-full bg-gray-900/60 border border-white/10 text-white placeholder-gray-600 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                    @error('name')
                        <span class="text-yellow-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">
                        Email
                    </label>
                    <input wire:model="email" type="email" id="email" required
                        class="w-full bg-gray-900/60 border border-white/10 text-white placeholder-gray-600 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                    @error('email')
                        <span class="text-yellow-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">
                        Password
                    </label>
                    <input wire:model="password" type="password" id="password" required
                        class="w-full bg-gray-900/60 border border-white/10 text-white placeholder-gray-600 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                    @error('password')
                        <span class="text-yellow-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-3 px-8 rounded-lg transition duration-200 uppercase tracking-wide text-sm">
                    <span wire:loading.remove>Daftar</span>
                    <span wire:loading>Memproses...</span>
                </button>

                {{-- Login Link --}}
                <p class="text-center text-sm text-gray-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-yellow-500 hover:text-yellow-400 font-bold transition">
                        Masuk di sini
                    </a>
                </p>

            </form>
        </div>

    </div>
</div>