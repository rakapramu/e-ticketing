@if (auth()->user()->hasRole('partisipan'))
    <div class="mb-4 bg-white dark:bg-gray-900 border-l-4 border-primary-600 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-primary-50 dark:bg-primary-950 rounded-full">
                    <x-filament::icon icon="heroicon-o-credit-card" class="w-8 h-8 text-primary-600" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Informasi Pembayaran Bank Transfer</h3>
                    <p class="text-sm text-gray-500 text-balance">Silakan lakukan pembayaran sesuai total tagihan ke
                        rekening resmi berikut:</p>
                </div>
            </div>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 bg-gray-50 dark:bg-gray-800/50 p-4 rounded-lg border border-gray-100 dark:border-gray-700 w-full md:w-auto">
                <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Bank</div>
                <div class="text-sm font-bold text-gray-900 dark:text-white">: Bank Syariah Mandiri</div>

                <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Nama Rekening</div>
                <div class="text-sm font-bold text-gray-900 dark:text-white">: IAUI Wilayah DI Yogyakarta</div>

                <div class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Nomor Rekening</div>
                <div class="text-sm font-bold text-primary-600 flex items-center gap-2">
                    : 7446665558
                    <button onclick="navigator.clipboard.writeText('7446665558');"
                        class="hover:text-primary-500 transition-colors">
                        <x-filament::icon icon="heroicon-m-clipboard-document" class="w-4 h-4" />
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
