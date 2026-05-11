<x-layouts.app>
    <div class="bg-gray-400/50 min-h-screen p-4 font-sans text-white sm:px-8 lg:px-17">
        <livewire:hero-banner />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div
                class="promo-card text-gray-300 tracking-wide relative overflow-hidden rounded-2xl p-8 flex flex-col justify-between h-[400px]">
                <!-- Background Overlay -->
                <div class="absolute bg-gradient-to-t from-black to-yellow-600/80 inset-0 z-0"></div>

                <div class="relative z-10">
                    <h2 class="text-2xl font-black italic leading-tight uppercase [-webkit-text-stroke:_0.5px_black]">
                        Kenapa harus dari Jadi<span class="text-yellow-500">Digital</span>?
                    </h2>
                    <ul class="mt-4 space-y-2 font-bold text-sm">
                        <li class="flex items-center gap-2">
                            <span class="text-yellow-500">✔</span> Teknologi Modern & Scalable
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-yellow-500">✔</span> Desain Eksklusif & UI/UX Friendly
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-yellow-500">✔</span> Maintenance Selama Masa Subscription
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-yellow-500">✔</span> Konsultasi Strategi Bisnis Gratis
                        </li>
                    </ul>
                    <button
                        class="mt-6 bg-yellow-500 text-black px-6 py-2 rounded-md text-xs font-bold uppercase hover:bg-yellow-600 transition border border-yellow-500">
                        Selengkapnya
                    </button>
                </div>

                <!-- Ikon yang disesuaikan dengan poin di atas -->
                <div class="relative z-10 grid grid-cols-4 gap-1 items-end">
                    <!-- 1. Teknologi Modern -->
                    <div class="text-center">
                        <div
                            class="size-10 mx-auto mb-2 bg-white/10 rounded-lg flex items-center justify-center border border-white/20">
                            🚀
                        </div>
                        <p class="text-[8px] font-black uppercase leading-tight">Modern &<br>Scalable</p>
                    </div>

                    <!-- 2. Desain Eksklusif -->
                    <div class="text-center">
                        <div
                            class="size-10 mx-auto mb-2 bg-white/10 rounded-lg flex items-center justify-center border border-white/20">
                            🎨
                        </div>
                        <p class="text-[8px] font-black uppercase leading-tight">Exclusive<br>Design</p>
                    </div>

                    <!-- 3. Garansi & Security -->
                    <div class="text-center">
                        <div
                            class="size-10 mx-auto mb-2 bg-white/10 rounded-lg flex items-center justify-center border border-white/20">
                            🛡️
                        </div>
                        <p class="text-[8px] font-black uppercase leading-tight">Warranty<br>& Secure</p>
                    </div>

                    <!-- 4. Konsultasi Gratis -->
                    <div class="text-center">
                        <div
                            class="size-10 mx-auto mb-2 bg-white/10 rounded-lg flex items-center justify-center border border-white/20">
                            💡
                        </div>
                        <p class="text-[8px] font-black uppercase leading-tight">Free<br>Consult</p>
                    </div>
                </div>
            </div>

            <livewire:newest-product/>

            <div
                class="bg-gray-900 rounded-2xl p-8 flex flex-col h-[400px] border border-white/5 relative overflow-hidden">
                <div class="z-10">
                    <button
                        class="bg-yellow-500 text-black text-[10px] font-black px-4 py-2 rounded-md uppercase mx-auto block mb-6">Pickup
                        In Store</button>
                    <div class="bg-black p-6 rounded-lg border border-white/10 mb-4 inline-block">
                        <h3 class="text-3xl font-black italic tracking-tighter">Jadi <span
                                class="block text-xs font-normal not-italic tracking-normal">Digital</span></h3>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Belanja Online di Webstore, <br> tersedia pilihan <span
                            class="text-white font-bold">Pick Up In Store!</span></p>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-[8px] text-gray-500 uppercase font-bold">
                        <p>JadiDigital Fulfillment Centre - Legok</p>
                        <p>JadiDigital Neighborhood Store - Pamulang</p>
                        <p>JadiDigital Neighborhood Store - Banjarbaru</p>
                        <p>JadiDigital Neighborhood Store - Yogyakarta</p>
                    </div>
                </div>
                <div class="absolute -right-10 -bottom-10 size-64 bg-white/5 blur-3xl rounded-full"></div>
            </div>
        </div>

        <div class="mt-4 bg-white text-black py-4 px-8 rounded-xl flex justify-between items-center">
            <h4 class="font-black italic uppercase text-sm">Visit Our Social</h4>
            <div class="flex gap-4">
                <div class="size-5 bg-black rounded-full"></div>
                <div class="size-5 bg-black rounded-full"></div>
                <div class="size-5 bg-black rounded-full"></div>
            </div>
        </div>
    </div>
</x-layouts.app>
