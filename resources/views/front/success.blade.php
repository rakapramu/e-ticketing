<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesanan Berhasil — {{ str_replace('-', ' ', config('app.name')) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
</head>

<body>

    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>
    <div class="bg-glow bg-glow-3"></div>

    <!-- THEME TOGGLE -->
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
        <i id="t-icon" class="bi bi-moon-stars-fill t-icon"></i>
        <div class="t-pill"></div>
        <span id="t-label" class="t-label">Dark Mode</span>
    </button>

    <div class="container" style="max-width:760px;position:relative;z-index:1;">

        <!-- SUCCESS HERO -->
        <div class="success-hero">
            <div class="success-icon-wrap">
                <!-- confetti dots -->
                <div class="confetti-dot"
                    style="width:8px;height:8px;background:var(--orange);top:-10px;right:-20px;animation-delay:.2s">
                </div>
                <div class="confetti-dot"
                    style="width:6px;height:6px;background:var(--gold);top:0;left:-25px;animation-delay:.5s"></div>
                <div class="confetti-dot"
                    style="width:10px;height:10px;background:var(--blue-accent);bottom:-5px;right:-30px;animation-delay:.8s">
                </div>
                <div class="confetti-dot"
                    style="width:5px;height:5px;background:var(--green);bottom:5px;left:-15px;animation-delay:.3s">
                </div>
                <div class="success-ring"><i class="bi bi-check-lg"></i></div>
            </div>
            <h1 class="success-title">Pemesanan Berhasil!</h1>
            {{-- <p class="success-sub">Tiket kamu telah dikonfirmasi. Selamat datang di NovaBeat Festival 2025! 🎉</p> --}}
            <div class="order-id" onclick="copyOrderId()">
                <i class="bi bi-hash"></i>
                <span id="order-id-text">NBF-2025-A7K3M9</span>
                <i class="bi bi-copy" style="opacity:.5;font-size:.72rem"></i>
            </div>
        </div>

        <!-- TICKET CARD -->
        <div class="ticket-wrap">
            <div class="ticket-card">

                <!-- BANNER -->
                <div class="ticket-banner">
                    <div class="ticket-banner-inner d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <div class="festival-name">{{ str_replace('-', ' ', config('app.name')) }}</div>
                        </div>
                        <div style="text-align:right">
                            <div
                                style="font-size:.7rem;color:rgba(255,255,255,.5);letter-spacing:1px;text-transform:uppercase">
                                Total Dibayar</div>
                            <div style="font-family:'Playfair Display',serif;font-size:1.6rem;font-weight:900;color:#fff"
                                id="total-paid">Rp 2.525.000</div>
                        </div>
                    </div>
                </div>

                <!-- TEAR LINE -->
                <div class="tear-line"></div>

                <!-- BODY -->
                <div class="ticket-body">
                    <div class="ticket-grid">
                        <div class="ticket-field">
                            <label>Nama Pemesan</label>
                            <span>John Doe</span>
                        </div>
                        <div class="ticket-field">
                            <label>Jumlah Tiket</label>
                            <span id="ticket-qty">2 Tiket</span>
                        </div>
                        <div class="ticket-field">
                            <label>Kategori</label>
                            <span id="ticket-cat">Premium</span>
                        </div>
                        <div class="ticket-field">
                            <label>Tanggal Event</label>
                            <span>15–17 Agt 2025</span>
                        </div>
                        <div class="ticket-field">
                            <label>Status</label>
                            <span style="color:var(--green);display:flex;align-items:center;gap:5px"><i
                                    class="bi bi-circle-fill" style="font-size:.5rem"></i> Confirmed</span>
                        </div>
                    </div>

                    <!-- QR + BARCODE -->
                    <div class="qr-section">
                        <div>
                            <div class="qr-box">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data=NBF-2025-A7K3M9"
                                    alt="QR Code" width="130px" />
                            </div>
                            <div class="scan-hint"><i class="bi bi-qr-code-scan"></i> Scan untuk registrasi</div>
                        </div>
                        <div class="barcode-box">
                            <div class="barcode-lbl">Barcode Tiket</div>
                            {{-- <svg class="barcode-svg" id="barcode-svg" viewBox="0 0 300 56"
                                xmlns="http://www.w3.org/2000/svg"></svg>
                            <div class="barcode-num" id="barcode-num">NBF-2025-A7K3M9-P2</div> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- INFO GRID -->
        <div class="info-grid" style="position:relative;z-index:1;max-width:680px;margin:0 auto 24px;">
            <div class="info-card" style="animation-delay:.1s">
                <div class="info-card-title">Rincian Pembayaran</div>
                <div class="info-row"><span class="ir-lbl">Metode</span><span class="ir-val">Transfer BCA</span>
                </div>
                <div class="info-row"><span class="ir-lbl">Subtotal</span><span class="ir-val" id="info-sub">Rp
                        2.500.000</span></div>
                <div class="info-row"><span class="ir-lbl">Total</span><span class="ir-val orange" id="info-total">Rp
                        2.525.000</span></div>
            </div>
            <div class="info-card" style="animation-delay:.2s">
                <div class="info-card-title">Informasi Pengiriman</div>
                <div class="info-row"><span class="ir-lbl">Email</span><span class="ir-val">john@example.com</span>
                </div>
                <div class="info-row"><span class="ir-lbl">WhatsApp</span><span class="ir-val">+62 812 xxxx
                        xxxx</span></div>
                <div class="info-row"><span class="ir-lbl">E-Ticket</span><span class="ir-val green"><i
                            class="bi bi-check-circle-fill me-1"></i>Terkirim</span></div>
                <div class="info-row"><span class="ir-lbl">Tanggal Order</span><span class="ir-val"
                        id="order-date">—</span></div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="action-row" style="position:relative;z-index:1;max-width:680px;margin:0 auto 28px;">
            <button class="btn-action btn-primary-act" onclick="downloadTicket()">
                <i class="bi bi-download"></i> Download Tiket
            </button>
            <button class="btn-action btn-blue-act" onclick="window.location.href='scan'">
                <i class="bi bi-qr-code-scan"></i> Scan & Registrasi
            </button>
        </div>

        <!-- NEXT STEPS -->
        <div class="next-steps">
            <div class="next-title">Langkah Selanjutnya</div>
            <div class="step-timeline">
                <div class="st-item" style="animation-delay:.1s">
                    <div class="st-dot st-dot-1">1</div>
                    <div class="st-title">Cek Email Konfirmasi</div>
                    <div class="st-desc">E-ticket telah dikirim ke john@example.com. Cek folder spam jika tidak
                        ditemukan.</div>
                </div>
                <div class="st-item" style="animation-delay:.2s">
                    <div class="st-dot st-dot-2">2</div>
                    <div class="st-title">Simpan Barcode / QR Code</div>
                    <div class="st-desc">Download atau screenshot tiket ini. Kamu akan membutuhkannya untuk masuk ke
                        venue.</div>
                </div>
                <div class="st-item" style="animation-delay:.3s">
                    <div class="st-dot st-dot-3">3</div>
                    <div class="st-title">Registrasi di Venue</div>
                    <div class="st-desc">Tunjukkan QR Code atau barcode ke petugas di Gate B untuk scan & registrasi
                        masuk.</div>
                </div>
            </div>
        </div>

        <!-- SHARE -->
        <div class="share-section">
            <div class="share-label">Bagikan keseruan ini</div>
            <div class="share-btns">
                <button class="share-btn"><i class="bi bi-whatsapp" style="color:#25d366"></i> WhatsApp</button>
                <button class="share-btn"><i class="bi bi-instagram" style="color:#e1306c"></i> Instagram</button>
                <button class="share-btn"><i class="bi bi-twitter-x"></i> X / Twitter</button>
                <button class="share-btn"><i class="bi bi-link-45deg"></i> Salin Link</button>
            </div>
        </div>

    </div><!-- /container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /* ── THEME ── */
        const html = document.documentElement;
        const tIcon = document.getElementById('t-icon');
        const tLabel = document.getElementById('t-label');
        const saved = localStorage.getItem('nb-theme');
        const sysDark = window.matchMedia('(prefers-color-scheme:dark)').matches;
        let theme = saved || (sysDark ? 'dark' : 'light');
        applyTheme(theme);

        function applyTheme(t) {
            theme = t;
            html.setAttribute('data-theme', t);
            localStorage.setItem('nb-theme', t);
            tIcon.className = t === 'dark' ? 'bi bi-moon-stars-fill t-icon' : 'bi bi-sun-fill t-icon';
            tLabel.textContent = t === 'dark' ? 'Dark Mode' : 'Light Mode';
            // regenerate QR after theme change so colors stay correct
            setTimeout(generateQR, 100);
        }

        function toggleTheme() {
            applyTheme(theme === 'dark' ? 'light' : 'dark');
        }

        /* ── ORDER DATA (passed from order page, here mocked) ── */
        const order = {
            id: 'NBF-2025-A7K3M9',
            category: 'premium',
            qty: 2,
            unitPrice: 1250000,
            fee: 25000,
            name: 'John Doe',
            email: 'john@example.com',
            payment: 'Transfer BCA'
        };

        // Populate dynamic values
        const sub = order.unitPrice * order.qty;
        const total = sub + order.fee;
        const fmt = n => 'Rp ' + n.toLocaleString('id-ID');
        const catMap = {
            vip: 'VIP Diamond',
            premium: 'Premium',
            regular: 'Regular',
            online: 'Live Stream'
        };

        document.getElementById('ticket-qty').textContent = order.qty + ' Tiket';
        document.getElementById('ticket-cat').textContent = catMap[order.category];
        document.getElementById('total-paid').textContent = fmt(total);
        document.getElementById('info-sub').textContent = fmt(sub);
        document.getElementById('info-total').textContent = fmt(total);
        document.getElementById('order-date').textContent = new Date().toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
        document.getElementById('barcode-num').textContent = order.id + '-P' + order.qty;

        // Cat badge
        const badge = document.getElementById('cat-badge');
        const icons = {
            vip: 'bi-gem',
            premium: 'bi-star-fill',
            regular: 'bi-ticket',
            online: 'bi-play-circle'
        };
        badge.className = 'cat-badge ' + (order.category === 'premium' ? 'prem' : order.category === 'vip' ? 'vip' : order
            .category === 'online' ? 'online' : 'reg');
        badge.innerHTML = `<i class="bi ${icons[order.category]}"></i> ${catMap[order.category]} General Admission`;

        // update barcode color on theme change
        const origApply = applyTheme;

        /* ── COPY ORDER ID ── */
        function copyOrderId() {
            navigator.clipboard.writeText(order.id).then(() => {
                const el = document.getElementById('order-id-text');
                const prev = el.textContent;
                el.textContent = 'Tersalin!';
                setTimeout(() => el.textContent = prev, 1500);
            });
        }

        /* ── DOWNLOAD TICKET (open print dialog) ── */
        function downloadTicket() {
            window.print();
        }
    </script>
</body>

</html>
