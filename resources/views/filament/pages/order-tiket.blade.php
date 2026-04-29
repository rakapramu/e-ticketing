<x-filament-panels::page>
    <div class="space-y-8">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Pilih Tiket Event</h1>
                <p class="text-gray-500 dark:text-gray-400">Temukan event terbaik dan pesan tiket favoritmu sekarang!</p>
            </div>

            <div
                class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm gap-4 max-w-sm">
                <div class="p-2 bg-primary-50 dark:bg-primary-950 rounded-full">
                    <x-filament::icon icon="heroicon-o-information-circle" class="w-6 h-6 text-primary-600" />
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-900 dark:text-white">Pastikan profil Anda sudah lengkap</p>
                    <p class="text-xs text-gray-500">Lengkapi profil untuk memudahkan proses pemesanan.</p>
                </div>
                <x-filament::icon icon="heroicon-m-chevron-right" class="w-4 h-4 text-gray-400" />
            </div>
        </div>

        @foreach ($this->getCategories() as $category)
            <div
                class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-sm mb-10">

                <div
                    class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-primary-600 rounded-xl shadow-lg">
                            <x-filament::icon icon="heroicon-s-tag" class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ $category->name }}</h2>
                        </div>
                    </div>
                    <span
                        class="px-3 py-1 bg-primary-50 text-primary-700 dark:bg-primary-900/30 text-xs font-bold rounded-full">
                        {{ $category->event->count() }} Event
                    </span>
                </div>

                <div class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($category->event as $index => $item)
                        {{-- Menggunakan $category->event sesuai relasi --}}
                        <div
                            class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center px-8 py-6 hover:bg-gray-50/80 transition-colors">

                            <div class="col-span-1 md:col-span-5 flex items-center gap-6">
                                <span class="text-2xl font-black text-primary-100 dark:text-gray-800">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <div>
                                    <h4 class="font-bold text-gray-950 dark:text-white text-lg">
                                        {{ $item->name }}</h4>
                                    <p class="text-sm text-gray-500 line-clamp-1">{{ $item->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-span-1 md:col-span-2 text-center">
                                <span class="text-xl font-extrabold text-primary-600">
                                    Rp {{ number_format($item->final_price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="col-span-1 md:col-span-2 flex justify-end">
                                {{ ($this->orderAction)(['ticketId' => $item->id]) }}
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-400 italic text-sm">
                            Belum ada event untuk kategori ini.
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 pt-8 border-t border-gray-200 dark:border-gray-800">
            @php
                $badges = [
                    [
                        'icon' => 'heroicon-o-shield-check',
                        'title' => 'Aman & Terpercaya',
                        'desc' => 'Setiap transaksi dijamin aman.',
                    ],
                    [
                        'icon' => 'heroicon-o-ticket',
                        'title' => 'Tiket Resmi',
                        'desc' => 'Semua tiket tersedia 100% resmi.',
                    ],
                    [
                        'icon' => 'heroicon-o-lock-closed',
                        'title' => 'Pembayaran Aman',
                        'desc' => 'Berbagai metode pembayaran aman.',
                    ],
                    [
                        'icon' => 'heroicon-o-user-group',
                        'title' => 'Customer Support',
                        'desc' => 'Tim kami siap membantu 24/7.',
                    ],
                ];
            @endphp
            @foreach ($badges as $badge)
                <div class="flex flex-col items-center md:items-start text-center md:text-left gap-3">
                    <div class="p-3 bg-gray-100 dark:bg-gray-800 rounded-xl">
                        <x-filament::icon icon="{{ $badge['icon'] }}" class="w-6 h-6 text-primary-600" />
                    </div>
                    <div>
                        <h5 class="text-sm font-bold text-gray-900 dark:text-white">{{ $badge['title'] }}</h5>
                        <p class="text-xs text-gray-500">{{ $badge['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-filament-panels::page>
