<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scan & Registrasi — {{ str_replace('-', ' ', config('app.name')) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- ZXing barcode scanner -->
    <script src="https://cdn.jsdelivr.net/npm/@zxing/browser@0.1.4/umd/index.min.js"></script>
    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
</head>

<body>

    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>

    <!-- THEME TOGGLE -->
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
        <i id="t-icon" class="bi bi-moon-stars-fill t-icon"></i>
        <div class="t-pill"></div>
        <span id="t-label" class="t-label">Dark Mode</span>
    </button>

    <div class="container" style="max-width:680px;position:relative;z-index:1;padding-bottom:60px;">

        <!-- HEADER -->
        <div class="page-header">
            <h1 class="page-title">Scan &amp; Registrasi</h1>
            <p class="page-sub">Scan QR code atau barcode tiket untuk verifikasi dan registrasi masuk venue.</p>
        </div>
        <!-- MODE TABS -->
        <div class="mode-tabs">
            <button class="mode-tab active" id="tab-cam" onclick="switchTab('cam')"> <i class="bi bi-camera"></i>
                Kamera</button>
            <button class="mode-tab" id="tab-manual" onclick="switchTab('manual')"><i class="bi bi-keyboard"></i>
                Manual</button>
        </div>

        <!-- ── PANEL: CAMERA ── -->
        <div id="panel-cam" class="panel active">
            <div class="scan-card">
                <div class="section-label"><i class="bi bi-camera-fill"></i> Kamera Scanner</div>

                <div class="cam-wrapper" id="cam-wrapper">
                    <video id="cam-video" autoplay muted playsinline></video>
                    <div class="cam-overlay"></div>
                    <div class="scan-line" id="scan-line" style="display:none"></div>
                    <div class="corner tl"></div>
                    <div class="corner tr"></div>
                    <div class="corner bl"></div>
                    <div class="corner br"></div>
                    <div class="cam-placeholder" id="cam-placeholder">
                        <i class="bi bi-camera-off"></i>
                        <div>Klik tombol di bawah untuk<br>mengaktifkan kamera</div>
                    </div>
                </div>

                <!-- camera device selector -->
                <div style="margin-top:14px;display:none" id="cam-select-wrap">
                    <label class="form-label">Pilih Kamera</label>
                    <select class="form-control" id="cam-select" onchange="switchCamera()"
                        style="padding:10px 14px !important;border-radius:10px !important;"></select>
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

            <!-- result -->
            <div class="result-card" id="cam-result"></div>
        </div>

        <!-- ── PANEL: MANUAL ── -->
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

                <div class="mb-3">
                    <label class="form-label">Nama Pemesan (Opsional)</label>
                    <div class="input-icon-wrap">
                        <i class="bi bi-person"></i>
                        <input type="text" class="form-control" id="manual-name" placeholder="John Doe" />
                    </div>
                </div>

                <button class="btn-verify" onclick="verifyManual()">
                    <i class="bi bi-shield-check"></i> Verifikasi Tiket
                </button>
            </div>

            <div class="result-card" id="manual-result"></div>
        </div>
    </div><!-- /container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /* ══════════════════════════════════════
               GLOBAL STATE (WAJIB DI ATAS)
            ══════════════════════════════════════ */
        let codeReader = null;
        let camActive = false;
        let scanDone = false;

        /* ══════════════════════════════════════
           THEME
        ══════════════════════════════════════ */
        const html = document.documentElement;
        const tIcon = document.getElementById('t-icon');
        const tLabel = document.getElementById('t-label');

        let theme = localStorage.getItem('nb-theme') || 'dark';
        applyTheme(theme);

        function applyTheme(t) {
            theme = t;
            html.setAttribute('data-theme', t);
            localStorage.setItem('nb-theme', t);
            tIcon.className = t === 'dark' ? 'bi bi-moon-stars-fill t-icon' : 'bi bi-sun-fill t-icon';
            tLabel.textContent = t === 'dark' ? 'Dark Mode' : 'Light Mode';
        }

        function toggleTheme() {
            applyTheme(theme === 'dark' ? 'light' : 'dark');
        }

        /* ══════════════════════════════════════
           TABS (FIX: NO HIST)
        ══════════════════════════════════════ */
        function switchTab(name) {
            ['cam', 'manual'].forEach(t => {
                document.getElementById('tab-' + t).classList.toggle('active', t === name);
                document.getElementById('panel-' + t).classList.toggle('active', t === name);
            });
        }

        /* ══════════════════════════════════════
           MOCK DATABASE
        ══════════════════════════════════════ */
        const db = {
            'NBF-2025-A7K3M9': {
                name: 'John Doe',
                category: 'Premium',
                qty: 2,
                status: 'valid'
            },
            'NBF-2025-B3X9K1': {
                name: 'Siti Rahayu',
                category: 'VIP Diamond',
                qty: 1,
                status: 'valid'
            },
            'NBF-2025-C5Y2L4': {
                name: 'Budi Santoso',
                category: 'Regular',
                qty: 3,
                status: 'valid'
            },
            'NBF-2025-D1Z8M7': {
                name: 'Dewi Anggraini',
                category: 'Premium',
                qty: 1,
                status: 'used'
            },
        };

        /* ══════════════════════════════════════
           VERIFY
        ══════════════════════════════════════ */
        function verifyCode(code, resultEl) {
            code = code.trim().toUpperCase();
            const ticket = db[code];

            if (!ticket) {
                resultEl.innerHTML = `<div style="color:red">Tiket tidak ditemukan</div>`;
                return;
            }

            if (ticket.status === 'used') {
                resultEl.innerHTML = `<div style="color:red">Tiket sudah digunakan</div>`;
                return;
            }

            ticket.status = 'used';

            resultEl.innerHTML = `
                <div style="color:lime">
                    ✔ ${ticket.name} (${ticket.category})<br>
                    ${ticket.qty} tiket
                </div>
            `;
        }

        /* ══════════════════════════════════════
           MANUAL INPUT
        ══════════════════════════════════════ */
        function verifyManual() {
            const code = document.getElementById('manual-code').value;
            verifyCode(code, document.getElementById('manual-result'));
        }

        /* ══════════════════════════════════════
           CAMERA (NO ZXING - SAFE MODE)
        ══════════════════════════════════════ */
        async function toggleCamera() {
            if (camActive) {
                stopCamera();
            } else {
                startCamera();
            }
        }

        async function startCamera() {
            try {
                const video = document.getElementById('cam-video');

                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "environment"
                    }
                });

                video.srcObject = stream;

                camActive = true;

                document.getElementById('cam-placeholder').classList.add('hidden');
                document.getElementById('scan-line').style.display = 'block';
                document.getElementById('cam-status').className = 'cam-status active';
                document.getElementById('cam-status-txt').textContent = 'Kamera aktif';

                document.getElementById('btn-cam-txt').textContent = 'Matikan Kamera';

            } catch (err) {
                console.error(err);
                alert('Kamera tidak bisa diakses: ' + err.message);
            }
        }

        function stopCamera() {
            const video = document.getElementById('cam-video');

            if (video.srcObject) {
                video.srcObject.getTracks().forEach(track => track.stop());
                video.srcObject = null;
            }

            camActive = false;

            document.getElementById('cam-placeholder').classList.remove('hidden');
            document.getElementById('scan-line').style.display = 'none';
            document.getElementById('cam-status').className = 'cam-status';
            document.getElementById('cam-status-txt').textContent = 'Kamera tidak aktif';
            document.getElementById('btn-cam-txt').textContent = 'Aktifkan Kamera';
        }
    </script>
</body>

</html>
