<div x-data="{
    mode: 'cam',
    manualCode: '',
    html5QrCode: null,
    isCameraRunning: false,
    isProcessing: false,
    showOverlay: false,
    overlayData: { success: true, name: '', message: '' },

    get gateSelected() { return this.$wire.gate_id; },
    set gateSelected(value) { this.$wire.gate_id = value; },

    async startScanner() {
        if (!this.gateSelected || this.isCameraRunning) return;
        if (!this.html5QrCode) {
            this.html5QrCode = new Html5Qrcode('reader');
        }
        const config = { fps: 20, qrbox: { width: 250, height: 250 }, disableFlip: true };
        try {
            await this.html5QrCode.start({ facingMode: 'environment' }, config, (text) => this.handleScan(text));
            this.isCameraRunning = true;
        } catch (err) { console.error('Kamera gagal:', err); }
    },

    async stopScanner() {
        if (this.html5QrCode && this.isCameraRunning) {
            try {
                await this.html5QrCode.stop();
                this.isCameraRunning = false;
                this.isProcessing = false;
            } catch (err) { console.error('Gagal matikan kamera:', err); }
        }
    },

    async handleScan(code) {
        if (this.isProcessing) return;
        this.isProcessing = true;
        if (this.html5QrCode) { this.html5QrCode.pause(); }
        this.playBeep();
        if (navigator.vibrate) navigator.vibrate(50);
        await this.$wire.processScan(code);
    },

    manualCode: '',

    async handleManualVerify() {
        if (this.isProcessing || !this.manualCode) return;

        this.isProcessing = true;
        this.playBeep(); // Bunyikan bip agar seragam dengan scan kamera

        if (navigator.vibrate) navigator.vibrate(50);

        // Kirim kode manual ke backend
        await this.$wire.processScan(this.manualCode);

        // Reset input manual setelah dikirim
        this.manualCode = '';

        this.isProcessing = false;
    },

    playBeep() {
        try {
            const ctx = new(window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.type = 'sine';
            osc.frequency.value = 880;
            osc.start();
            gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + 0.2);
            setTimeout(() => {
                osc.stop();
                ctx.close();
            }, 200);
        } catch (e) {}
    }
}" x-init="$watch('gateSelected', value => { if (value) { setTimeout(() => startScanner(), 300) } else { stopScanner() } });
window.addEventListener('scan-processed', (event) => {
    overlayData = event.detail.result;
    showOverlay = true;
    setTimeout(() => {
        showOverlay = false;
        if (html5QrCode && isCameraRunning) { html5QrCode.resume(); }
        isProcessing = false;
    }, 5000);
});" x-on:close-modal.window="stopScanner()" class="scanner-container">

    <style>
        .scanner-container {
            position: relative;
            min-height: 420px;
            margin: -24px;
            padding: 24px;
            font-family: 'DM Sans', sans-serif;
            background-color: transparent;
        }

        /* OVERLAY STYLING */
        .result-overlay {
            position: absolute;
            inset: 0;
            z-index: 999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 32px;
            text-align: center;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            transition: all 0.4s ease;
        }

        .overlay-success {
            background: rgba(16, 185, 129, 0.92);
            color: #fff;
        }

        .overlay-error {
            background: rgba(239, 68, 68, 0.92);
            color: #fff;
        }

        .overlay-icon {
            font-size: 84px;
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.1));
        }

        .welcome-sub {
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 13px;
            font-weight: 500;
            opacity: 0.85;
        }

        .visitor-name {
            font-size: 32px;
            font-weight: 800;
            margin: 8px 0 16px 0;
            line-height: 1.1;
            letter-spacing: -0.5px;
        }

        .status-badge {
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 24px;
            border-radius: 100px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* UI ELEMENTS */
        .gate-select {
            width: 100%;
            padding: 14px;
            border-radius: 14px;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            font-size: 15px;
            color: #1f2937;
            outline: none;
            transition: 0.2s;
        }

        .dark .gate-select {
            background: #111827;
            border-color: #374151;
            color: #f3f4f6;
        }

        .tab-wrapper {
            display: flex;
            background: #f3f4f6;
            padding: 5px;
            border-radius: 16px;
            margin-bottom: 24px;
        }

        .dark .tab-wrapper {
            background: #1f2937;
        }

        .tab-btn {
            flex: 1;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .camera-box {
            width: 100%;
            min-height: 320px;
            background: #000;
            border-radius: 24px;
            overflow: hidden;
            border: 6px solid #fff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .dark .camera-box {
            border-color: #1f2937;
        }

        #reader video {
            transform: scaleX(1) !important;
            object-fit: cover !important;
            width: 100% !important;
            height: 100% !important;
            min-height: 320px;
        }

        #reader img {
            display: none !important;
        }

        .manual-input {
            width: 100%;
            padding: 18px;
            border-radius: 16px;
            border: 2px solid #f3f4f6;
            margin-bottom: 16px;
            outline: none;
            font-size: 16px;
            font-weight: 600;
            transition: 0.3s;
        }

        .dark .manual-input {
            background: #111827;
            border-color: #374151;
            color: #fff;
        }

        .manual-input:focus {
            border-color: #3b82f6;
        }

        .manual-label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            color: #9ca3af;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .manual-input {
            width: 100%;
            padding: 16px 20px;
            border-radius: 16px;
            border: 2px solid #f3f4f6;
            background: #fff;
            outline: none;
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .dark .manual-input {
            background: #111827;
            border-color: #374151;
            color: #fff;
        }

        .manual-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        /* PREMIUM BUTTON STYLE */
        .btn-verify-manual {
            position: relative;
            width: 100%;
            padding: 18px;
            border: none;
            border-radius: 18px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            font-weight: 800;
            font-size: 14px;
            letter-spacing: 1px;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
        }

        .btn-verify-manual:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.5);
            filter: brightness(1.1);
        }

        .btn-verify-manual:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-disabled {
            background: #9ca3af !important;
            box-shadow: none !important;
            cursor: not-allowed;
            opacity: 0.8;
        }

        /* Mini Spinner */
        .spinner-mini {
            width: 18px;
            height: 18px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin-mini 0.8s linear infinite;
        }

        @keyframes spin-mini {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div x-show="showOverlay" class="result-overlay" :class="overlayData.success ? 'overlay-success' : 'overlay-error'"
        style="display: none;">

        <div class="overlay-icon">
            <i :class="overlayData.success ? 'bi bi-check-circle-fill' : 'bi-shield-fill-x'"></i>
        </div>
        <div x-show="overlayData.success" class="welcome-sub">Selamat Datang / Welcome</div>
        <div x-text="overlayData.name" class="visitor-name"></div>
        <div class="status-badge" x-text="overlayData.message"></div>
    </div>

    <div style="margin-bottom: 24px;">
        <label
            style="display: block; font-size: 12px; font-weight: 700; color: #6b7280; margin-bottom: 10px; text-transform: uppercase;">Pilih
            Gate Masuk</label>
        <select wire:model.live="gate_id" x-model="gateSelected" class="gate-select">
            <option value="">-- PILIH GATE --</option>
            @foreach ($gates as $gate)
                <option value="{{ $gate->id }}">{{ $gate->nama }}</option>
            @endforeach
        </select>
    </div>

    <div x-show="gateSelected">
        <div class="tab-wrapper">
            <button type="button" @click="mode = 'cam'; startScanner();" class="tab-btn"
                :style="mode === 'cam' ? 'background: #fff; color: #3b82f6; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);' :
                    'background: transparent; color: #9ca3af;'">
                Kamera
            </button>
            <button type="button" @click="mode = 'manual'; stopScanner();" class="tab-btn"
                :style="mode === 'manual' ? 'background: #fff; color: #3b82f6; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);' :
                    'background: transparent; color: #9ca3af;'">
                Manual
            </button>
        </div>

        <div x-show="mode === 'cam'" style="text-align: center;">
            <div wire:ignore id="reader" class="camera-box"></div>

            <div style="margin-top: 24px;">
                <button type="button" x-show="!isCameraRunning" @click="startScanner()"
                    style="background: #10b981; color: #fff; border: none; padding: 14px 32px; border-radius: 50px; font-weight: 700; cursor: pointer; font-size: 14px; box-shadow: 0 10px 15px -3px rgba(16,185,129,0.3);">
                    AKTIFKAN KAMERA
                </button>
                <button type="button" x-show="isCameraRunning" @click="stopScanner()"
                    style="background: #ef4444; color: #fff; border: none; padding: 14px 32px; border-radius: 50px; font-weight: 700; cursor: pointer; font-size: 14px;">
                    MATIKAN KAMERA
                </button>
            </div>
        </div>

        <div x-show="mode === 'manual'" style="padding: 10px 0; animation: fadeIn 0.3s ease;">
            <div style="margin-bottom: 25px;">
                <label class="manual-label">Kode Order / Barcode</label>
                <input type="text" x-model="manualCode" placeholder="Masukkan kode tiket..." class="manual-input"
                    @keyup.enter="handleManualVerify()">
            </div>

            <button type="button" @click="handleManualVerify()" :disabled="isProcessing" class="btn-verify-manual"
                :class="isProcessing ? 'btn-disabled' : ''">
                <div class="btn-content">
                    <template x-if="!isProcessing">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <i class="bi bi-shield-check" style="font-size: 1.2rem;"></i>
                            <span>VERIFIKASI TIKET</span>
                        </div>
                    </template>

                    <template x-if="isProcessing">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <span class="spinner-mini"></span>
                            <span>MEMPROSES...</span>
                        </div>
                    </template>
                </div>
            </button>
        </div>
    </div>

    <div x-show="!gateSelected"
        style="padding: 80px 20px; text-align: center; border-radius: 24px; background: rgba(0,0,0,0.02); border: 2px dashed #e5e7eb;">
        <i class="bi bi-lock" style="font-size: 48px; color: #d1d5db; display: block; margin-bottom: 12px;"></i>
        <div style="font-size: 13px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px;">
            Scanner Terkunci</div>
        <div style="font-size: 12px; color: #d1d5db; margin-top: 4px;">Pilih gate untuk memulai pemindaian</div>
    </div>
</div>
