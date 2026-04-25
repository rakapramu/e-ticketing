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

        .scan-overlay-result {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            z-index: 10;
            text-align: center;
            padding: 20px;
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
        }

        .overlay-success {
            background: rgba(25, 135, 84, 0.9);
            color: white;
        }

        .overlay-error {
            background: rgba(220, 53, 69, 0.9);
            color: white;
        }

        .welcome-text {
            font-size: 1.2rem;
            font-weight: 300;
            opacity: 0.9;
        }

        .participant-name {
            font-size: 2rem;
            font-weight: 800;
            margin: 10px 0;
            text-transform: uppercase;
        }

        .status-msg {
            font-size: 1rem;
            opacity: 0.8;
        }

        .icon-large {
            font-size: 4rem;
            margin-bottom: 10px;
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

        <div id="panel-cam" class="panel active">
            <div class="scan-card position-relative">
                <div class="section-label"><i class="bi bi-camera-fill"></i> Kamera Scanner</div>

                <div id="scan-feedback" class="scan-overlay-result hidden">
                    <div id="feedback-icon" class="icon-large"></div>
                    <div id="feedback-welcome" class="welcome-text">Selamat Datang!</div>
                    <div id="feedback-name" class="participant-name">NAMA PESERTA</div>
                    <div id="feedback-msg" class="status-msg">Silakan Masuk Venue</div>
                </div>

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
        </div>
    </div>

    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content;
        let html5QrCode = null;
        let camActive = false;
        let isProcessing = false; // Mencegah scan ganda saat proses verifikasi

        function applyTheme(t) {
            document.documentElement.setAttribute('data-theme', t);
            localStorage.setItem('nb-theme', t);
            const tIcon = document.getElementById('t-icon');
            const tLabel = document.getElementById('t-label');
            tIcon.className = t === 'dark' ? 'bi bi-moon-stars-fill t-icon' : 'bi bi-sun-fill t-icon';
            tLabel.textContent = t === 'dark' ? 'Dark Mode' : 'Light Mode';
        }
        applyTheme(localStorage.getItem('nb-theme') || 'dark');

        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme');
            applyTheme(current === 'dark' ? 'light' : 'dark');
        }

        async function toggleCamera() {
            camActive ? stopCamera() : await startCamera();
        }

        async function startCamera() {
            html5QrCode = new Html5Qrcode("reader");
            const config = {
                fps: 15,
                qrbox: {
                    width: 250,
                    height: 250
                },
                aspectRatio: 1.0,
                disableFlip: true
            };

            try {
                document.getElementById('cam-placeholder').classList.add('hidden');
                await html5QrCode.start({
                    facingMode: "environment"
                }, config, onScanSuccess);
                camActive = true;
                updateCameraUI(true);
            } catch (err) {
                console.error(err);
                alert("Kamera tidak dapat diakses.");
                document.getElementById('cam-placeholder').classList.remove('hidden');
            }
        }

        function stopCamera() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode = null;
                    camActive = false;
                    updateCameraUI(false);
                    document.getElementById('cam-placeholder').classList.remove('hidden');
                });
            }
        }

        function updateCameraUI(isActive) {
            const statusDiv = document.getElementById('cam-status');
            const statusTxt = document.getElementById('cam-status-txt');
            const btnIcon = document.getElementById('btn-cam-icon');
            const btnTxt = document.getElementById('btn-cam-txt');

            statusDiv.className = isActive ? 'cam-status active' : 'cam-status';
            statusTxt.textContent = isActive ? "Kamera aktif — arahkan ke tiket" : "Kamera tidak aktif";
            btnIcon.className = isActive ? "bi bi-camera-video-off-fill" : "bi bi-camera-fill";
            btnTxt.textContent = isActive ? "Matikan Kamera" : "Aktifkan Kamera";
        }

        async function onScanSuccess(decodedText) {
            if (isProcessing) return;
            isProcessing = true;

            if (html5QrCode) {
                html5QrCode.pause();
            }

            playBeep();
            if (navigator.vibrate) navigator.vibrate(100);

            await verifyCode(decodedText);
        }

        async function verifyCode(code) {
            try {
                const response = await fetch(`/api/tickets/${encodeURIComponent(code)}/verify`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        code: code,
                        gate_id: "{{ $gate->id }}"
                    })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showFeedback('success', data.ticket.name, 'Tiket Berhasil Diverifikasi');
                } else {
                    showFeedback('error', 'GAGAL', data.message || 'Tiket Tidak Valid');
                }
            } catch (err) {
                showFeedback('error', 'KONEKSI ERROR', 'Gagal menghubungi server');
            }
        }

        function showFeedback(type, name, msg) {
            const el = document.getElementById('scan-feedback');
            const icon = document.getElementById('feedback-icon');
            const nameEl = document.getElementById('feedback-name');
            const msgEl = document.getElementById('feedback-msg');
            const welcomeEl = document.getElementById('feedback-welcome');

            el.className = `scan-feedback scan-overlay-result overlay-${type}`;
            icon.className = `icon-large bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-shield-fill-x'}`;
            nameEl.textContent = name;
            msgEl.textContent = msg;
            welcomeEl.style.display = type === 'success' ? 'block' : 'none';

            el.classList.remove('hidden');

            setTimeout(() => {
                el.classList.add('hidden');
                if (html5QrCode && camActive) {
                    html5QrCode.resume();
                }

                isProcessing = false;
            }, 10000);
        }

        function playBeep() {
            try {
                const ctx = new(window.AudioContext || window.webkitAudioContext)();
                const oscillator = ctx.createOscillator();
                const gainNode = audioCtx.createGain();
                oscillator.connect(gainNode);
                gainNode.connect(ctx.destination);
                oscillator.type = 'sine';
                oscillator.frequency.value = 880;
                oscillator.start();
                gainNode.gain.setValueAtTime(1, ctx.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + 0.2);
                setTimeout(() => oscillator.stop(), 200);
            } catch (e) {}
        }
    </script>
</body>

</html>
