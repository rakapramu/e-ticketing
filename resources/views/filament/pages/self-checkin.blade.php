<x-filament-panels::page>
    <div x-data="{
        html5QrCode: null,
        isCameraRunning: false,
        isProcessing: false,
        showOverlay: false,
        overlayData: { success: true, name: '', message: '' },
    
        async startScanner() {
            if (this.isCameraRunning) return;
            if (!this.html5QrCode) {
                this.html5QrCode = new Html5Qrcode('reader-self');
            }
            const config = { fps: 10, qrbox: { width: 250, height: 250 }, disableFlip: true };
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
            
            // Code contains the Event ID. Let's process it.
            await this.$wire.processScan(code);
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
    }" 
    x-init="setTimeout(() => startScanner(), 500)"
    @scan-processed.window="
        overlayData = $event.detail.result;
        showOverlay = true;
        setTimeout(() => {
            showOverlay = false;
            if (html5QrCode && isCameraRunning) { html5QrCode.resume(); }
            isProcessing = false;
        }, 3000);
    " 
    @close-modal.window="stopScanner()" 
    class="scanner-container">
    
        <style>
            .scanner-container {
                position: relative;
                min-height: 420px;
                font-family: 'DM Sans', sans-serif;
            }
    
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
                border-radius: 24px;
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
            .dark .camera-box { border-color: #1f2937; }
            #reader-self video {
                transform: scaleX(1) !important;
                object-fit: cover !important;
                width: 100% !important;
                height: 100% !important;
                min-height: 320px;
            }
            #reader-self img { display: none !important; }
        </style>
    
        <div x-show="showOverlay" class="result-overlay" :class="overlayData.success ? 'overlay-success' : 'overlay-error'"
            style="display: none;">
            <div class="overlay-icon">
                <i :class="overlayData.success ? 'bi bi-check-circle-fill' : 'bi-shield-fill-x'"></i>
            </div>
            <div x-text="overlayData.name" class="visitor-name"></div>
            <div class="status-badge" x-text="overlayData.message"></div>
        </div>
    
        <div style="text-align: center; max-width: 500px; margin: 0 auto;">
            <p class="mb-4 text-gray-600 dark:text-gray-400">Arahkan kamera ke QR Code Event untuk melakukan Check-in secara mandiri.</p>
            <div wire:ignore id="reader-self" class="camera-box"></div>
    
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
    </div>
</x-filament-panels::page>
