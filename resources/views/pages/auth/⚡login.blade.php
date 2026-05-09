<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

new class extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
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
        <div class="absolute -top-32 -left-32 size-96 bg-yellow-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 size-96 bg-yellow-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">

        {{-- Brand Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black italic tracking-tighter uppercase text-white leading-none">
                Jadi<span class="text-yellow-500">Digital</span>
            </h1>
            <p class="mt-2 text-gray-400 text-sm font-medium">Masuk untuk melanjutkan</p>
        </div>

        {{-- Card --}}
        <div class="bg-gray-800/60 backdrop-blur border border-white/10 rounded-2xl p-8 shadow-2xl">
            <h2 class="text-xl font-black italic uppercase text-white mb-6">Masuk ke Akun</h2>

            <form wire:submit="login" class="space-y-5">

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">
                        Email
                    </label>
                    <input wire:model="email" type="email" id="email" required autofocus
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

                {{-- Remember Me --}}
                <div class="flex items-center gap-2">
                    <input wire:model="remember" type="checkbox" id="remember"
                        class="h-4 w-4 rounded border-gray-600 bg-gray-900 text-yellow-500 focus:ring-yellow-500 focus:ring-offset-gray-900">
                    <label for="remember" class="text-sm text-gray-400">Ingat Saya</label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-3 px-8 rounded-lg transition duration-200 uppercase tracking-wide text-sm">
                    <span wire:loading.remove>Log In</span>
                    <span wire:loading>Memproses...</span>
                </button>

                {{-- Register Link --}}
                <p class="text-center text-sm text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-400 font-bold transition">
                        Daftar Sekarang
                    </a>
                </p>

            </form>
        </div>

    </div>
</div>