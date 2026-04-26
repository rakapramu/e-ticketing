<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Check-in Monitor — {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --primary: #3b82f6;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg-color);
            color: white;
            overflow: hidden;
        }

        /* Container Utama */
        .monitor-wrapper {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            transition: background-color 0.5s ease;
        }

        /* Standby State */
        .standby-content {
            text-align: center;
            animation: fadeIn 1s ease;
        }

        .qr-icon-large {
            font-size: 12rem;
            color: var(--primary);
            margin-bottom: 20px;
            filter: drop-shadow(0 0 20px rgba(59, 130, 246, 0.5));
        }

        .instruction-text {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: -1px;
        }

        /* Fullscreen Overlay Result */
        .fullscreen-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
            visibility: hidden;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .fullscreen-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .success-bg {
            background-color: #059669;
        }

        .error-bg {
            background-color: #dc2626;
        }

        .status-icon {
            font-size: 15rem;
            margin-bottom: 20px;
            animation: popIn 0.5s ease;
        }

        .welcome-label {
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 8px;
            font-weight: 400;
            margin-bottom: 10px;
        }

        .visitor-name {
            font-size: 6rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 30px;
            word-wrap: break-word;
            max-width: 90%;
        }

        .message-badge {
            font-size: 1.8rem;
            background: rgba(0, 0, 0, 0.2);
            padding: 15px 40px;
            border-radius: 100px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        /* Animations */
        @keyframes popIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        #scanner-input {
            position: absolute;
            top: -100px;
            opacity: 0;
        }
    </style>
</head>

<body onclick="focusScanner()">

    <input type="text" id="scanner-input" autocomplete="off">

    <div id="result-overlay" class="fullscreen-overlay">
        <div id="status-icon-box" class="status-icon"></div>
        <div id="welcome-txt" class="welcome-label">Selamat Datang</div>
        <div id="participant-name" class="visitor-name">NAMA PESERTA</div>
        <div id="status-msg" class="message-badge">SILAKAN MASUK</div>
    </div>

    <div class="monitor-wrapper" id="main-wrapper">
        <div class="standby-content">
            <div class="qr-icon-large">
                <i class="bi bi-qr-code-scan"></i>
            </div>
            <div class="instruction-text">
                SILAKAN SCAN TIKET ANDA
            </div>
            <div class="mt-4 opacity-50 fs-4">
                GATE: {{ $gate->nama ?? 'TERMINAL 1' }}
            </div>
        </div>
    </div>
    {{-- <div
        style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 2000; display: flex; gap: 10px;">
        <button onclick="simulateScan('ORD-HXFQEBMN')"
            style="padding: 10px 20px; background: #059669; color: white; border: none; border-radius: 8px; cursor: pointer;">
            Test Sukses
        </button>
        <button onclick="simulateScan('KODE-SALAH')"
            style="padding: 10px 20px; background: #dc2626; color: white; border: none; border-radius: 8px; cursor: pointer;">
            Test Gagal
        </button>
    </div> --}}

    <script>
        // function simulateScan(dummyCode) {
        //     // Anggap saja ini input dari scanner
        //     const input = document.getElementById('scanner-input');
        //     input.value = dummyCode;

        //     // Pemicu tombol Enter manual
        //     const event = new KeyboardEvent('keypress', {
        //         key: 'Enter'
        //     });
        //     input.dispatchEvent(event);
        // }
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content;
        const scannerInput = document.getElementById('scanner-input');
        const overlay = document.getElementById('result-overlay');
        const nameEl = document.getElementById('participant-name');
        const msgEl = document.getElementById('status-msg');
        const welcomeEl = document.getElementById('welcome-txt');
        const iconEl = document.getElementById('status-icon-box');

        let isProcessing = false;

        function focusScanner() {
            if (!isProcessing) scannerInput.focus();
        }
        setInterval(focusScanner, 500);
        window.onload = focusScanner;

        scannerInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const code = this.value.trim();
                if (code && !isProcessing) {
                    verifyTicket(code);
                }
                this.value = '';
            }
        });

        async function verifyTicket(code) {
            isProcessing = true;
            playBeep();

            try {
                const response = await fetch(`/api/tickets/${encodeURIComponent(code)}/verify`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({
                        code: code,
                        gate_id: "{{ $gate->id }}"
                    })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showResult('success', data.ticket.name, 'SILAKAN MASUK VENUE');
                } else {
                    showResult('error', data.message, data.message || 'TIKET TIDAK VALID');
                }
            } catch (err) {
                showResult('error', 'KONEKSI ERROR', 'GAGAL MENGHUBUNGI SERVER');
            }
        }

        function showResult(type, name, msg) {
            // Setup Tampilan
            overlay.className = `fullscreen-overlay active ${type}-bg`;
            iconEl.innerHTML = type === 'success' ? '<i class="bi bi-check-circle-fill"></i>' :
                '<i class="bi bi-x-circle-fill"></i>';
            nameEl.textContent = name;
            msgEl.textContent = msg;
            welcomeEl.style.display = type === 'success' ? 'block' : 'none';

            setTimeout(() => {
                overlay.classList.remove('active');
                setTimeout(() => {
                    isProcessing = false;
                    focusScanner();
                }, 400);
            }, 8000);
        }

        function playBeep() {
            try {
                const ctx = new(window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.frequency.value = 880;
                osc.start();
                gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + 0.2);
                setTimeout(() => {
                    osc.stop();
                    ctx.close();
                }, 200);
            } catch (e) {}
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'f' || e.key === 'F') {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    document.exitFullscreen();
                }
            }
        });
    </script>
</body>

</html>
