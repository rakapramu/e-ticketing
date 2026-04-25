<div x-data="{
    mode: 'cam',
    manualCode: '',
    html5QrCode: null,
    isCameraRunning: false,

    // Sinkronisasi gateSelected dengan properti gate_id di Livewire
    get gateSelected() {
        return this.$wire.gate_id;
    },
    set gateSelected(value) {
        this.$wire.gate_id = value;
    },

    async startScanner() {
        if (!this.gateSelected) return; // Jangan start jika gate belum dipilih
        if (this.isCameraRunning) return;

        if (!this.html5QrCode) {
            this.html5QrCode = new Html5Qrcode('reader');
        }

        const config = {
            fps: 15,
            qrbox: { width: 250, height: 250 },
            disableFlip: true
        };

        try {
            await this.html5QrCode.start({ facingMode: 'environment' },
                config,
                (text) => this.onScanSuccess(text)
            );
            this.isCameraRunning = true;
        } catch (err) {
            console.error('Kamera gagal:', err);
        }
    },

    async stopScanner() {
        if (this.html5QrCode && this.isCameraRunning) {
            try {
                await this.html5QrCode.stop();
                this.isCameraRunning = false;
            } catch (err) {
                console.error('Gagal mematikan kamera:', err);
            }
        }
    },

    async onScanSuccess(code) {
        if (navigator.vibrate) navigator.vibrate(50);
        await $wire.processScan(code);
    }
}" x-init="$watch('gateSelected', value => { if (value) { setTimeout(() => startScanner(), 300) } else { stopScanner() } })" x-on:close-modal.window="stopScanner()" class="p-2">

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Pilih Gate Terlebih Dahulu
        </label>
        <select wire:model.live="gate_id" x-model="gateSelected"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500">
            <option value="">-- Pilih Gate Masuk --</option>
            @foreach ($gates as $gate)
                <option value="{{ $gate->id }}">{{ $gate->nama }}</option>
            @endforeach
        </select>
    </div>

    <div x-show="gateSelected" x-transition>
        <div class="flex p-1 mb-4 bg-gray-100 rounded-lg dark:bg-gray-800">
            <button type="button" @click="mode = 'cam'; startScanner();"
                :class="mode === 'cam' ? 'bg-white dark:bg-gray-700 shadow-sm text-primary-600' : 'text-gray-500'"
                class="flex-1 py-2 text-sm font-medium rounded-md transition-all">
                <i class="bi bi-camera"></i> Kamera
            </button>
            <button type="button" @click="mode = 'manual'; stopScanner();"
                :class="mode === 'manual' ? 'bg-white dark:bg-gray-700 shadow-sm text-primary-600' : 'text-gray-500'"
                class="flex-1 py-2 text-sm font-medium rounded-md transition-all">
                <i class="bi bi-keyboard"></i> Manual
            </button>
        </div>

        <div x-show="mode === 'cam'" class="space-y-4">
            <div wire:ignore id="reader"
                class="overflow-hidden rounded-xl bg-black border-2 border-gray-200 dark:border-gray-700"
                style="width: 100%; min-height: 300px;">
            </div>

            <div class="flex justify-center gap-2">
                <template x-if="!isCameraRunning">
                    <x-filament::button color="success" icon="heroicon-m-play" @click="startScanner()" type="button">
                        Hidupkan Kamera
                    </x-filament::button>
                </template>
                <template x-if="isCameraRunning">
                    <x-filament::button color="danger" icon="heroicon-m-stop" @click="stopScanner()" type="button">
                        Matikan Kamera
                    </x-filament::button>
                </template>
            </div>
        </div>

        <div x-show="mode === 'manual'" class="space-y-4 py-4">
            <x-filament::input.wrapper>
                <x-filament::input type="text" x-model="manualCode" placeholder="Masukkan Kode Order..."
                    @keyup.enter="$wire.processScan(manualCode)" />
            </x-filament::input.wrapper>

            <x-filament::button @click="$wire.processScan(manualCode)" class="w-full" type="button">
                Verifikasi Kode
            </x-filament::button>
        </div>
    </div>

    <div x-show="!gateSelected"
        class="py-10 text-center bg-gray-50 dark:bg-gray-900/50 rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-800">
        <div class="flex justify-center mb-3 text-gray-400">
            <x-heroicon-o-lock-closed class="w-12 h-12" />
        </div>
        <p class="text-sm text-gray-500">Scanner terkunci. Pilih Gate untuk memulai.</p>
    </div>

    <style>
        #reader video {
            transform: scaleX(1) !important;
            object-fit: cover !important;
            width: 100% !important;
            height: 100% !important;
            min-height: 300px;
        }

        #reader img {
            display: none !important;
        }
    </style>
</div>
