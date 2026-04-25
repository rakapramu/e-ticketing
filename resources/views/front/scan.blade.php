<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scan & Registrasi — {{ str_replace('-', ' ', config('app.name')) }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
    <style>
        /* Memastikan area scanner mengikuti wrapper yang sudah Anda buat */
        #reader {
            width: 100% !important;
            border: none !important;
        }

        #reader video {
            border-radius: 12px;
            object-fit: cover;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body>

    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>

    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
        <i id="t-icon" class="bi bi-moon-stars-fill t-icon"></i>
        <div class="t-pill"></div>
        <span id="t-label" class="t-label">Dark Mode</span>
    </button>

    <div class="container" style="max-width:680px;position:relative;z-index:1;padding-bottom:60px;">

        <div class="page-header">
            <h1 class="page-title">Scan &amp; Registrasi</h1>
            <p class="page-sub">Scan QR code atau barcode tiket untuk verifikasi masuk venue.</p>
        </div>

        <div class="mode-tabs">
            <button class="mode-tab active" id="tab-cam" onclick="switchTab('cam')">
                <i class="bi bi-camera"></i> Kamera
            </button>
            <button class="mode-tab" id="tab-manual" onclick="switchTab('manual')">
                <i class="bi bi-keyboard"></i> Manual
            </button>
        </div>

        <div id="panel-cam" class="panel active">
            <div class="scan-card">
                <div class="section-label"><i class="bi bi-camera-fill"></i> Kamera Scanner</div>

                <div class="cam-wrapper">
                    <div id="reader"></div>

                    <div class="cam-placeholder" id="cam-placeholder">
                        <i class="bi bi-camera-off"></i>
                        <div>Klik tombol di bawah untuk<br>mengaktifkan kamera</div>
                    </div>
                </div>

                <div class="cam-status" id="cam-status">
                    <div class="dot"></div>
                    <span id="cam-status-txt">Kamera tidak aktif</span>
                </div>

                <button class="btn-cam" id="btn-cam" onclick="toggleCamera()">
                    <i class="bi bi-camera-fill" id="btn-cam-icon"></i>
                    <span id="btn-cam-txt">Aktifkan Kamera</span>
                </button>
            </div>

            <div class="result-card" id="cam-result"></div>
        </div>

        <div id="panel-manual" class="panel">
            <div class="scan-card">
                <div class="section-label"><i class="bi bi-keyboard-fill"></i> Input Manual</div>

                <div class="mb-3">
                    <label class="form-label">Kode Order / Barcode Tiket</label>
                    <div class="input-icon-wrap">
                        <i class="bi bi-upc-scan"></i>
                        <input type="text" class="form-control" id="manual-code"
                            placeholder="Contoh: NBF-2025-A7K3M9" oninput="this.value = this.value.toUpperCase()"
                            onkeydown="if(event.key==='Enter') verifyManual()" />
                    </div>
                </div>

                <button class="btn-verify" id="btn-verify" onclick="verifyManual()">
                    <i class="bi bi-shield-check"></i> Verifikasi Tiket
                </button>
            </div>

            <div class="result-card" id="manual-result"></div>
        </div>
    </div>

    <script>
        /* ── Configuration ── */
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content;
        let html5QrCode = null;
        let camActive = false;
        let scanCooldown = false;

        /* ── Theme Logic ── */
        const html = document.documentElement;
        const tIcon = document.getElementById('t-icon');
        const tLabel = document.getElementById('t-label');
        let theme = localStorage.getItem('nb-theme') || 'dark';

        function applyTheme(t) {
            theme = t;
            html.setAttribute('data-theme', t);
            localStorage.setItem('nb-theme', t);
            tIcon.className = t === 'dark' ? 'bi bi-moon-stars-fill t-icon' : 'bi bi-sun-fill t-icon';
            tLabel.textContent = t === 'dark' ? 'Dark Mode' : 'Light Mode';
        }
        applyTheme(theme);

        function toggleTheme() {
            applyTheme(theme === 'dark' ? 'light' : 'dark');
        }

        /* ── Tab Logic ── */
        function switchTab(name) {
            document.getElementById('tab-cam').classList.toggle('active', name === 'cam');
            document.getElementById('tab-manual').classList.toggle('active', name === 'manual');
            document.getElementById('panel-cam').classList.toggle('active', name === 'cam');
            document.getElementById('panel-manual').classList.toggle('active', name === 'manual');
            if (name === 'manual' && camActive) stopCamera();
        }

        /* ── Camera Logic (Html5Qrcode) ── */
        async function toggleCamera() {
            if (camActive) {
                stopCamera();
            } else {
                startCamera();
            }
        }

        async function startCamera() {
            const scannerContainer = document.getElementById('reader');
            const placeholder = document.getElementById('cam-placeholder');

            html5QrCode = new Html5Qrcode("reader");

            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                },
                aspectRatio: 1.0
            };

            try {
                placeholder.classList.add('hidden');
                // Menggunakan kamera belakang (environment) secara default
                await html5QrCode.start({
                    facingMode: "environment"
                }, config, onScanSuccess);

                camActive = true;
                updateCameraUI(true);
            } catch (err) {
                console.error("Gagal akses kamera:", err);
                alert("Kamera tidak dapat diakses. Pastikan izin diberikan.");
                placeholder.classList.remove('hidden');
            }
        }

        async function stopCamera() {
            if (html5QrCode) {
                await html5QrCode.stop();
                html5QrCode = null;
            }
            camActive = false;
            updateCameraUI(false);
            document.getElementById('cam-placeholder').classList.remove('hidden');
        }

        function updateCameraUI(isActive) {
            const statusTxt = document.getElementById('cam-status-txt');
            const statusDiv = document.getElementById('cam-status');
            const btnIcon = document.getElementById('btn-cam-icon');
            const btnTxt = document.getElementById('btn-cam-txt');

            if (isActive) {
                statusDiv.classList.add('active');
                statusTxt.textContent = "Kamera aktif — arahkan ke tiket";
                btnIcon.className = "bi bi-camera-video-off-fill";
                btnTxt.textContent = "Matikan Kamera";
            } else {
                statusDiv.classList.remove('active');
                statusTxt.textContent = "Kamera tidak aktif";
                btnIcon.className = "bi bi-camera-fill";
                btnTxt.textContent = "Aktifkan Kamera";
            }
        }

        /* ── Scan Handler ── */
        function onScanSuccess(decodedText) {
            if (scanCooldown) return;

            scanCooldown = true;
            // Play sound effect jika perlu
            // new Audio('/beep.mp3').play();

            document.getElementById('cam-status-txt').textContent = `Terdeteksi: ${decodedText}`;
            verifyCode(decodedText, document.getElementById('cam-result'));

            // Cooldown agar tidak scan berkali-kali dalam 3 detik
            setTimeout(() => {
                scanCooldown = false;
                if (camActive) document.getElementById('cam-status-txt').textContent =
                    "Kamera aktif — arahkan ke tiket";
            }, 3000);
        }

        /* ── API Verification Logic ── */
        async function verifyCode(code, resultEl) {
            code = code.trim().toUpperCase();
            if (!code) return;

            renderResult(resultEl, 'loading');

            try {
                const response = await fetch(`/api/tickets/${encodeURIComponent(code)}/verify`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        code: code
                    })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    renderResult(resultEl, 'success', data.ticket);
                } else {
                    renderResult(resultEl, 'error', null, data.message || 'Tiket tidak valid');
                }
            } catch (err) {
                renderResult(resultEl, 'error', null, 'Koneksi server terputus.');
            }
        }

        async function verifyManual() {
            const codeInput = document.getElementById('manual-code');
            const btn = document.getElementById('btn-verify');

            if (!codeInput.value) return;

            btn.disabled = true;
            await verifyCode(codeInput.value, document.getElementById('manual-result'));
            btn.disabled = false;
        }

        function renderResult(el, state, ticket = null, message = '') {
            if (state === 'loading') {
                el.innerHTML =
                    `<div class="p-3 text-center"><div class="spinner-border spinner-border-sm text-primary"></div> Verifikasi...</div>`;
            } else if (state === 'success') {
                el.innerHTML = `
                    <div class="result-success p-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-check-circle-fill fs-2"></i>
                            <div>
                                <div class="fw-bold">TIKET VALID</div>
                                <div class="small">${ticket.name} - ${ticket.category}</div>
                            </div>
                        </div>
                    </div>`;
            } else {
                el.innerHTML = `
                    <div class="result-error p-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-x-circle-fill fs-2"></i>
                            <div>
                                <div class="fw-bold">GAGAL</div>
                                <div class="small">${message}</div>
                            </div>
                        </div>
                    </div>`;
            }
            el.style.display = 'block';
        }
    </script>
</body>

</html>
