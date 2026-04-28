<div class="flex flex-col items-center justify-center space-y-4 p-4">
    <div class="text-sm font-bold text-gray-700 dark:text-gray-300 self-start">
        Bukti Pembayaran:
    </div>

    @if ($record->payment_order)
        <div
            class="relative overflow-hidden rounded-lg border border-gray-200 dark:border-gray-800 shadow-sm bg-gray-100">
            <img src="{{ asset('storage/' . $record->payment_order) }}" alt="Bukti Pembayaran"
                class="max-h-[500px] w-full object-contain mx-auto">
        </div>

        <div class="flex gap-4 mt-2">
            <a href="{{ asset('storage/' . $record->payment_order) }}" target="_blank"
                class="text-xs text-primary-600 hover:underline flex items-center gap-1">
                <x-filament::icon icon="heroicon-m-arrow-top-right-on-square" class="w-3 h-3" />
                Buka Ukuran Penuh
            </a>
        </div>
    @else
        <div
            class="w-full p-8 bg-gray-50 dark:bg-gray-800/50 border border-dashed border-gray-300 dark:border-gray-700 rounded-xl text-center">
            <p class="text-sm text-gray-500">Gambar tidak ditemukan.</p>
        </div>
    @endif
</div>
