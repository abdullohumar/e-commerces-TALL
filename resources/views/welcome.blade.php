<x-layouts.app>
    <div class="bg-gray-400/50 min-h-screen p-4 font-sans text-white sm:px-8 lg:px-17">
        <livewire:hero-banner />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div
                class="bg-gradient-to-b from-yellow-400 to-yellow-600 rounded-2xl p-8 text-black flex flex-col justify-between h-[400px]">
                <div>
                    <h2 class="text-2xl font-black italic leading-tight uppercase">Kenapa harus beli di website JadiDigital
                    </h2>
                    <ul class="mt-4 space-y-1 font-bold text-sm">
                        <li>• Gratis Ongkir</li>
                        <li>• Jaminan Return/Refund</li>
                    </ul>
                    <button
                        class="mt-6 bg-black text-white px-6 py-2 rounded-md text-xs font-bold uppercase">Selengkapnya</button>
                </div>
                <div class="flex justify-around items-end">
                    <div class="text-center">
                        <div
                            class="size-12 mx-auto mb-2 bg-white/20 rounded-xl flex items-center justify-center border border-black">
                            🚚</div>
                        <p class="text-[10px] font-black uppercase">Gratis Ongkir</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="size-12 mx-auto mb-2 bg-white/20 rounded-xl flex items-center justify-center border border-black">
                            📦</div>
                        <p class="text-[10px] font-black uppercase leading-tight">Pengembalian<br>Barang / Dana</p>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-2xl h-[400px]">
                <img src="https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?auto=format&fit=crop&q=80"
                    class="absolute inset-0 w-full h-full object-cover" alt="Oxford Shirt">
                <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center">
                    <span class="text-xs font-bold uppercase tracking-widest mb-1">New Arrival</span>
                    <h2 class="text-4xl font-black italic uppercase leading-none">Oxford <br> Shirt</h2>
                </div>
            </div>

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
