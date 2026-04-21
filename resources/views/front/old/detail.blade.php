<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rock Uprising Live Concert — EventSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
    <script>
        // Prevent flash of wrong theme
        (function() {
            var t = localStorage.getItem('es-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>
</head>

<body>

    <!-- ═══ NAVBAR ═══ -->
    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between w-100">
                <a href="index.html" class="text-decoration-none">
                    <span class="navbar-brand-text">EventSphere</span>
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navMenu2">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-lg-flex align-items-center gap-3 justify-content-end"
                    id="navMenu2">
                    <div class="d-flex flex-column flex-lg-row gap-1 gap-lg-0 mt-3 mt-lg-0">
                        <a href="index.html#events" class="nav-link-custom">Events</a>
                        <a href="index.html#categories" class="nav-link-custom">Kategori</a>
                        <a href="#" class="nav-link-custom">Organizer</a>
                    </div>
                    <div class="d-flex gap-2 mt-2 mt-lg-0 ms-lg-3">
                        <a href="#" class="nav-link-custom">Masuk</a>
                        <a href="#" class="btn-nav nav-link-custom">Daftar</a>
                        <button class="theme-toggle" onclick="toggleTheme()" title="Toggle tema"
                            aria-label="Toggle tema">
                            <i class="bi bi-moon-stars-fill icon-dark"></i>
                            <i class="bi bi-sun-fill icon-light"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- ═══ EVENT HERO ═══ -->
    <div class="event-hero">
        <div class="event-hero-bg">🎸</div>
        <div class="event-hero-overlay"></div>
        <div class="event-hero-content">
            <div class="container">
                <div class="breadcrumb-custom">
                    <a href="index.html">Home</a>
                    <span class="sep">/</span>
                    <a href="#">Musik</a>
                    <span class="sep">/</span>
                    <span class="current">Rock Uprising Live Concert</span>
                </div>
                <div class="category-badge"><i class="bi bi-music-note-beamed"></i> Musik · Konser</div>
                <h1 class="event-title-hero">Rock Uprising Live Concert</h1>
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <div class="urgency-badge">
                        <div class="urgency-dot"></div>
                        Tersisa 120 Tiket — Segera Habis!
                    </div>
                    <div style="font-size:0.8rem;color:var(--mist);">⭐ 4.9 (842 ulasan)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══ DETAIL SECTION ═══ -->
    <section class="detail-section">
        <div class="container">
            <div class="row g-5">

                <!-- MAIN CONTENT -->
                <div class="col-lg-7 col-xl-8">

                    <!-- INFO CHIPS -->
                    <div class="row g-3 mb-4 reveal">
                        <div class="col-6 col-md-3">
                            <div class="info-chip">
                                <div class="info-chip-icon"><i class="bi bi-calendar3"></i></div>
                                <div>
                                    <div class="info-chip-label">Tanggal</div>
                                    <div class="info-chip-value">22 Juli 2025</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="info-chip">
                                <div class="info-chip-icon"><i class="bi bi-clock"></i></div>
                                <div>
                                    <div class="info-chip-label">Waktu</div>
                                    <div class="info-chip-value">19.00 WIB</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="info-chip">
                                <div class="info-chip-icon"><i class="bi bi-geo-alt"></i></div>
                                <div>
                                    <div class="info-chip-label">Lokasi</div>
                                    <div class="info-chip-value">Jakarta</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="info-chip">
                                <div class="info-chip-icon"><i class="bi bi-people"></i></div>
                                <div>
                                    <div class="info-chip-label">Kapasitas</div>
                                    <div class="info-chip-value">5.000 Orang</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GALLERY -->
                    <div class="gallery-grid mb-4 reveal">
                        <div class="gallery-item" style="background:linear-gradient(135deg,#1a0533,#2d0b4e);">🎸</div>
                        <div class="gallery-item" style="background:linear-gradient(135deg,#2d0b4e,#1a0533);">🎵</div>
                        <div class="gallery-item" style="background:linear-gradient(135deg,#0d0033,#1a0533);">🎤</div>
                    </div>

                    <!-- ORGANIZER -->
                    <div class="organizer-box reveal">
                        <div class="org-logo">🎭</div>
                        <div>
                            <div class="org-label">Diselenggarakan oleh</div>
                            <div class="org-name">Nada Semesta Entertainment</div>
                            <div style="font-size:0.75rem;color:var(--mist);">Verified Organizer · 47 Events · ⭐ 4.8
                            </div>
                        </div>
                        <a href="#"
                            style="margin-left:auto;font-size:0.8rem;color:var(--gold);text-decoration:none;white-space:nowrap;">Lihat
                            Profil →</a>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="content-section reveal">
                        <h3 class="content-heading">Tentang Event</h3>
                        <div class="content-text">
                            <p style="margin-bottom:1rem;">
                                <strong style="color:var(--cream);">Rock Uprising Live Concert</strong> adalah pesta
                                musik terbesar tahun ini yang menghadirkan energi, semangat, dan suara menggelegar dari
                                band-band terbaik tanah air. Nikmati malam penuh adrenalin dengan penampilan live dari
                                artis-artis papan atas yang akan membuat Kamu merinding!
                            </p>
                            <p style="margin-bottom:1rem;">
                                Event ini akan berlangsung di Jakarta Convention Center — venue iconic yang dirancang
                                untuk menghadirkan pengalaman akustik terbaik. Didukung sistem sound kelas dunia dan
                                tata cahaya LED spektakuler yang akan memanjakan mata.
                            </p>
                            <p>
                                Siapkan dirimu untuk malam yang tidak akan pernah kamu lupakan. Dari lagu-lagu hits
                                hingga penampilan spesial yang belum pernah ada sebelumnya — ini bukan sekadar konser,
                                ini adalah sebuah <em style="color:var(--gold-light);">pengalaman</em>.
                            </p>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- LINEUP -->
                    <div class="content-section reveal">
                        <h3 class="content-heading">Line-up Artis</h3>
                        <div class="d-flex flex-column gap-2">
                            <div class="lineup-card">
                                <div class="lineup-avatar">BB</div>
                                <div>
                                    <div class="lineup-name">Black Beetle</div>
                                    <div class="lineup-role">Headliner · Rock</div>
                                </div>
                                <div class="lineup-time">21.00 – 23.00</div>
                            </div>
                            <div class="lineup-card">
                                <div class="lineup-avatar">SR</div>
                                <div>
                                    <div class="lineup-name">Sunset Riders</div>
                                    <div class="lineup-role">Main Act · Alternative Rock</div>
                                </div>
                                <div class="lineup-time">19.30 – 21.00</div>
                            </div>
                            <div class="lineup-card">
                                <div class="lineup-avatar">TF</div>
                                <div>
                                    <div class="lineup-name">The Foundry</div>
                                    <div class="lineup-role">Opening Act · Indie Rock</div>
                                </div>
                                <div class="lineup-time">19.00 – 19.30</div>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- SCHEDULE -->
                    <div class="content-section reveal">
                        <h3 class="content-heading">Jadwal Acara</h3>
                        <div class="d-flex flex-column gap-2">
                            <div style="display:flex;gap:1rem;align-items:flex-start;">
                                <div
                                    style="min-width:80px;font-size:0.8rem;color:var(--gold);font-weight:500;padding-top:0.2rem;">
                                    17.00</div>
                                <div>
                                    <div style="font-weight:500;font-size:0.9rem;">Pintu dibuka & registrasi</div>
                                    <div style="font-size:0.8rem;color:var(--mist);">Cek-in tiket & wristband</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:1rem;align-items:flex-start;">
                                <div
                                    style="min-width:80px;font-size:0.8rem;color:var(--gold);font-weight:500;padding-top:0.2rem;">
                                    19.00</div>
                                <div>
                                    <div style="font-weight:500;font-size:0.9rem;">Opening Performance — The Foundry
                                    </div>
                                    <div style="font-size:0.8rem;color:var(--mist);">Pembukaan dengan lagu-lagu hits
                                        indie</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:1rem;align-items:flex-start;">
                                <div
                                    style="min-width:80px;font-size:0.8rem;color:var(--gold);font-weight:500;padding-top:0.2rem;">
                                    19.30</div>
                                <div>
                                    <div style="font-weight:500;font-size:0.9rem;">Main Act — Sunset Riders</div>
                                    <div style="font-size:0.8rem;color:var(--mist);">1.5 jam penampilan epik</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:1rem;align-items:flex-start;">
                                <div
                                    style="min-width:80px;font-size:0.8rem;color:var(--gold);font-weight:500;padding-top:0.2rem;">
                                    21.00</div>
                                <div>
                                    <div style="font-weight:500;font-size:0.9rem;">Headliner — Black Beetle</div>
                                    <div style="font-size:0.8rem;color:var(--mist);">2 jam penuh keajaiban rock!</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:1rem;align-items:flex-start;">
                                <div
                                    style="min-width:80px;font-size:0.8rem;color:var(--gold);font-weight:500;padding-top:0.2rem;">
                                    23.00</div>
                                <div>
                                    <div style="font-weight:500;font-size:0.9rem;">Selesai</div>
                                    <div style="font-size:0.8rem;color:var(--mist);">Event berakhir</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- VENUE -->
                    <div class="content-section reveal">
                        <h3 class="content-heading">Lokasi & Venue</h3>
                        <div class="d-flex gap-2 align-items-center mb-3">
                            <i class="bi bi-geo-alt-fill" style="color:var(--gold);"></i>
                            <div>
                                <div style="font-weight:500;font-size:0.9rem;">Jakarta Convention Center (JCC)</div>
                                <div style="font-size:0.8rem;color:var(--mist);">Jl. Gatot Subroto, Senayan, Jakarta
                                    Selatan 10270</div>
                            </div>
                        </div>
                        <div class="map-placeholder">
                            <i class="bi bi-map"></i>
                            <span>Klik untuk membuka Google Maps</span>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- FAQ -->
                    <div class="content-section reveal">
                        <h3 class="content-heading">FAQ</h3>
                        <div class="accordion" id="faqAccordion">
                            <div
                                style="border:1px solid rgba(255,255,255,0.08);border-radius:6px;margin-bottom:0.5rem;overflow:hidden;">
                                <div class="accordion-item" style="background:transparent;border:none;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq1"
                                            style="background:rgba(255,255,255,0.03);color:var(--cream);font-size:0.9rem;padding:1rem 1.25rem;">
                                            Apakah tiket bisa direfund?
                                        </button>
                                    </h2>
                                    <div id="faq1" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body"
                                            style="color:var(--mist);font-size:0.875rem;background:rgba(255,255,255,0.02);">
                                            Tiket dapat direfund hingga 7 hari sebelum tanggal event. Refund akan
                                            diproses dalam 5-7 hari kerja.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                style="border:1px solid rgba(255,255,255,0.08);border-radius:6px;margin-bottom:0.5rem;overflow:hidden;">
                                <div class="accordion-item" style="background:transparent;border:none;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq2"
                                            style="background:rgba(255,255,255,0.03);color:var(--cream);font-size:0.9rem;padding:1rem 1.25rem;">
                                            Apakah ada batas usia?
                                        </button>
                                    </h2>
                                    <div id="faq2" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body"
                                            style="color:var(--mist);font-size:0.875rem;background:rgba(255,255,255,0.02);">
                                            Event terbuka untuk semua usia. Namun pengunjung di bawah 17 tahun wajib
                                            didampingi orang tua/wali.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="border:1px solid rgba(255,255,255,0.08);border-radius:6px;overflow:hidden;">
                                <div class="accordion-item" style="background:transparent;border:none;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq3"
                                            style="background:rgba(255,255,255,0.03);color:var(--cream);font-size:0.9rem;padding:1rem 1.25rem;">
                                            Bagaimana cara masuk ke venue?
                                        </button>
                                    </h2>
                                    <div id="faq3" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body"
                                            style="color:var(--mist);font-size:0.875rem;background:rgba(255,255,255,0.02);">
                                            Tunjukkan QR code tiket (di app atau email) di pintu masuk. Wristband akan
                                            diberikan sebagai tanda masuk.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /MAIN CONTENT -->

                <!-- SIDEBAR -->
                <div class="col-lg-5 col-xl-4">
                    <div class="ticket-sidebar">

                        <!-- COUNTDOWN -->
                        <div class="ticket-box mb-3 reveal" style="border:1px solid rgba(255,255,255,0.08);">
                            <div style="padding:1rem 1.5rem;">
                                <div
                                    style="font-size:0.7rem;color:var(--mist);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.75rem;">
                                    Event Dimulai Dalam</div>
                                <div class="countdown-row">
                                    <div class="countdown-item">
                                        <div class="countdown-num" id="cd-days">45</div>
                                        <div class="countdown-label">Hari</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-num" id="cd-hours">12</div>
                                        <div class="countdown-label">Jam</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-num" id="cd-mins">33</div>
                                        <div class="countdown-label">Menit</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-num" id="cd-secs">07</div>
                                        <div class="countdown-label">Detik</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ACTION ROW -->
                        <div class="action-row mb-3 reveal">
                            <button class="action-btn"><i class="bi bi-heart"></i> Wishlist</button>
                            <button class="action-btn"><i class="bi bi-share"></i> Bagikan</button>
                            <button class="action-btn"><i class="bi bi-bell"></i> Ingatkan</button>
                        </div>

                        <!-- TICKET BOX -->
                        <div class="ticket-box reveal">
                            <div class="ticket-box-header">
                                <div class="ticket-box-title">Pilih Tiket</div>
                                <div class="ticket-box-sub">Pilih jenis tiket yang sesuai untukmu</div>
                            </div>
                            <div class="ticket-box-body">

                                <!-- Ticket Types -->
                                <div id="ticket-regular" class="ticket-type selected"
                                    onclick="selectTicket(this,'250000','REGULAR')">
                                    <div style="padding-right:2rem;">
                                        <div class="ticket-type-name">REGULAR</div>
                                        <div class="ticket-type-desc">Area berdiri, akses umum</div>
                                        <div class="ticket-type-price">Rp 250.000</div>
                                        <div class="ticket-available low">⚠ Tersisa 80 tiket</div>
                                    </div>
                                    <div class="ticket-type-radio"></div>
                                </div>

                                <div id="ticket-vip" class="ticket-type" onclick="selectTicket(this,'500000','VIP')">
                                    <div style="padding-right:2rem;">
                                        <div class="ticket-type-name">VIP</div>
                                        <div class="ticket-type-desc">Area prioritas + merchandise exclusive</div>
                                        <div class="ticket-type-price">Rp 500.000</div>
                                        <div class="ticket-available">Tersisa 40 tiket</div>
                                    </div>
                                    <div class="ticket-type-radio"></div>
                                </div>

                                <div id="ticket-vvip" class="ticket-type"
                                    onclick="selectTicket(this,'1200000','VVIP')">
                                    <div style="padding-right:2rem;">
                                        <div class="ticket-type-name">VVIP</div>
                                        <div class="ticket-type-desc">Meet & greet + kursi terdepan + lounge akses
                                        </div>
                                        <div class="ticket-type-price">Rp 1.200.000</div>
                                        <div class="ticket-available">Tersisa 10 tiket</div>
                                    </div>
                                    <div class="ticket-type-radio"></div>
                                </div>

                                <!-- Quantity -->
                                <div class="mt-1 mb-1">
                                    <div class="qty-label">Jumlah Tiket</div>
                                    <div class="qty-selector">
                                        <button class="qty-btn" onclick="changeQty(-1)">−</button>
                                        <input class="qty-value" id="qty-input" type="text" value="1"
                                            readonly />
                                        <button class="qty-btn" onclick="changeQty(1)">+</button>
                                    </div>
                                    <div style="font-size:0.7rem;color:var(--mist);margin-top:0.4rem;">Maks. 5 tiket
                                        per transaksi</div>
                                </div>

                                <!-- Summary -->
                                <div class="ticket-summary">
                                    <div class="summary-row">
                                        <span class="label" id="sum-type">REGULAR × 1</span>
                                        <span class="value" id="sum-subtotal">Rp 250.000</span>
                                    </div>
                                    <div class="summary-row">
                                        <span class="label">Biaya Layanan</span>
                                        <span class="value" id="sum-fee">Rp 12.500</span>
                                    </div>
                                    <div class="summary-row total">
                                        <span class="label" style="color:var(--cream);font-weight:600;">Total</span>
                                        <span class="value" id="sum-total">Rp 262.500</span>
                                    </div>
                                </div>

                                <!-- CTA -->
                                <a href="checkout.html" class="btn-primary-gold mt-3" id="btn-checkout">
                                    Beli Sekarang <i class="bi bi-arrow-right"></i>
                                </a>

                                <!-- Trust Badges -->
                                <div class="trust-badges">
                                    <div class="trust-badge"><i class="bi bi-shield-check"></i> Pembayaran aman</div>
                                    <div class="trust-badge"><i class="bi bi-phone"></i> E-Ticket instan</div>
                                    <div class="trust-badge"><i class="bi bi-arrow-counterclockwise"></i> Refund
                                        tersedia</div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div><!-- /SIDEBAR -->

            </div>
        </div>
    </section>

    <!-- ═══ RELATED EVENTS ═══ -->
    <section class="section-related">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col">
                    <div class="section-eyebrow">Rekomendasi</div>
                    <div class="gold-divider"></div>
                    <h2 class="section-title" style="font-size:1.75rem;">Event Serupa</h2>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="detail.html" class="event-card-mini">
                        <div class="event-card-mini-img" style="background:linear-gradient(135deg,#1a1200,#332800);">
                            🎵</div>
                        <div class="event-card-mini-body">
                            <div class="event-card-mini-cat">Musik · Festival</div>
                            <div class="event-card-mini-title">Grand Music Festival Nusantara</div>
                            <div class="event-card-mini-date"><i class="bi bi-calendar3"
                                    style="color:var(--gold);"></i> 15 Agustus 2025 · Jakarta</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="detail.html" class="event-card-mini">
                        <div class="event-card-mini-img" style="background:linear-gradient(135deg,#1a001a,#330033);">
                            🎤</div>
                        <div class="event-card-mini-body">
                            <div class="event-card-mini-cat">Musik · Konser</div>
                            <div class="event-card-mini-title">Acoustic Night: Melodi Jiwa</div>
                            <div class="event-card-mini-date"><i class="bi bi-calendar3"
                                    style="color:var(--gold);"></i> 30 Juli 2025 · Bandung</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="detail.html" class="event-card-mini">
                        <div class="event-card-mini-img" style="background:linear-gradient(135deg,#001a00,#003300);">
                            🎶</div>
                        <div class="event-card-mini-body">
                            <div class="event-card-mini-cat">Musik · Pop</div>
                            <div class="event-card-mini-title">Pop Gala Night 2025</div>
                            <div class="event-card-mini-date"><i class="bi bi-calendar3"
                                    style="color:var(--gold);"></i> 5 September 2025 · Surabaya</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <div class="container">
            <div class="footer-bottom">
                <div class="footer-logo">EventSphere</div>
                <div class="footer-copy">© 2025 EventSphere. All rights reserved.</div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ticket selection
        let selectedPrice = 250000;
        let selectedType = 'REGULAR';
        let qty = 1;
        const serviceFeeRate = 0.05;

        function selectTicket(el, price, type) {
            document.querySelectorAll('.ticket-type').forEach(t => t.classList.remove('selected'));
            el.classList.add('selected');
            selectedPrice = parseInt(price);
            selectedType = type;
            updateSummary();
        }

        function changeQty(delta) {
            qty = Math.min(5, Math.max(1, qty + delta));
            document.getElementById('qty-input').value = qty;
            updateSummary();
        }

        function formatRp(n) {
            return 'Rp ' + n.toLocaleString('id-ID');
        }

        function updateSummary() {
            const subtotal = selectedPrice * qty;
            const fee = Math.round(subtotal * serviceFeeRate);
            const total = subtotal + fee;
            document.getElementById('sum-type').textContent = `${selectedType} × ${qty}`;
            document.getElementById('sum-subtotal').textContent = formatRp(subtotal);
            document.getElementById('sum-fee').textContent = formatRp(fee);
            document.getElementById('sum-total').textContent = formatRp(total);
        }

        // Countdown
        const eventDate = new Date('2025-07-22T19:00:00');

        function updateCountdown() {
            const now = new Date();
            let diff = eventDate - now;
            if (diff < 0) diff = 0;
            const d = Math.floor(diff / 86400000);
            const h = Math.floor((diff % 86400000) / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            document.getElementById('cd-days').textContent = String(d).padStart(2, '0');
            document.getElementById('cd-hours').textContent = String(h).padStart(2, '0');
            document.getElementById('cd-mins').textContent = String(m).padStart(2, '0');
            document.getElementById('cd-secs').textContent = String(s).padStart(2, '0');
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();

        // Scroll reveal
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 60);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        reveals.forEach(el => observer.observe(el));

        // Accordion styling fix
        document.querySelectorAll('.accordion-button').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.accordion-button').forEach(b => {
                    b.style.boxShadow = 'none';
                    b.style.color = 'var(--mist)';
                });
                this.style.color = 'var(--gold-light)';
            });
        });
    </script>
    <script>
        // ─ THEME SYSTEM ─
        (function() {
            var t = localStorage.getItem('es-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();

        function toggleTheme() {
            var h = document.documentElement;
            var next = h.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            h.setAttribute('data-theme', next);
            localStorage.setItem('es-theme', next);
        }
    </script>
</body>

</html>
