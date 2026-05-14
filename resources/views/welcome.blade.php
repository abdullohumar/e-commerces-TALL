<x-layouts.app>
    <div class="bg-gray-400/50 min-h-screen p-4 font-sans text-white sm:px-8 lg:px-17">
        <livewire:hero-banner />

        <div class="w-full h-[2px] bg-gray-800 rounded-md -mt-2"></div>

        <livewire:guest-catalog />

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
