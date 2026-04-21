<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EventSphere — Premium Event Ticketing</title>
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
                <a href="index.html" class="text-decoration-none d-flex align-items-center gap-2">
                    <span class="navbar-brand-text">EventSphere</span>
                </a>

                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse d-lg-flex align-items-center gap-3 justify-content-end"
                    id="navMenu">
                    <div class="d-flex flex-column flex-lg-row gap-1 gap-lg-0 mt-3 mt-lg-0">
                        <a href="#events" class="nav-link-custom">Events</a>
                        <a href="#categories" class="nav-link-custom">Kategori</a>
                        <a href="#" class="nav-link-custom">Organizer</a>
                        <a href="#" class="nav-link-custom">Tentang</a>
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

    <!-- ═══ HERO ═══ -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-grid"></div>
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-eyebrow">
                        <span></span> Platform Tiket Premium <span></span>
                    </div>
                    <h1 class="hero-title">
                        Temukan Event<br /><span class="accent">Terbaik</span> di<br />Sekitarmu
                    </h1>
                    <p class="hero-subtitle">
                        Dari konser megah hingga seminar eksklusif — temukan, pesan, dan nikmati pengalaman tak
                        terlupakan bersama EventSphere.
                    </p>
                    <div class="hero-actions">
                        <a href="#events" class="btn-primary-gold">
                            Jelajahi Events <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="#" class="btn-ghost-gold">
                            <i class="bi bi-play-circle"></i> Cara Kerja
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div>
                            <div class="hero-stat-number">1.2K+</div>
                            <div class="hero-stat-label">Event Aktif</div>
                        </div>
                        <div>
                            <div class="hero-stat-number">85K+</div>
                            <div class="hero-stat-label">Tiket Terjual</div>
                        </div>
                        <div>
                            <div class="hero-stat-number">340+</div>
                            <div class="hero-stat-label">Organizer</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="hero-visual">
                        <div class="hero-img-placeholder">
                            <i class="bi bi-calendar-event" style="font-size:4rem;opacity:0.3"></i>
                            <span style="font-size:1rem;opacity:0.5">Featured Event</span>
                        </div>
                        <!-- Float Card 1 -->
                        <div class="hero-card-float card-1">
                            <div class="d-flex align-items-center gap-2">
                                <div
                                    style="width:36px;height:36px;border-radius:50%;background:rgba(201,168,76,0.2);display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-ticket-perforated" style="color:var(--gold);font-size:1rem;"></i>
                                </div>
                                <div>
                                    <div style="font-size:0.75rem;font-weight:600;color:var(--cream);">Tiket Habis!
                                    </div>
                                    <div style="font-size:0.65rem;color:var(--mist);">Jazz Night 2025</div>
                                </div>
                            </div>
                        </div>
                        <!-- Float Card 2 -->
                        <div class="hero-card-float card-2">
                            <div
                                style="font-size:0.65rem;color:var(--gold);font-weight:600;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.4rem;">
                                Pembelian Terakhir</div>
                            <div style="font-size:0.8rem;font-weight:500;color:var(--cream);">Rina M. baru saja membeli
                            </div>
                            <div style="font-size:0.75rem;color:var(--mist);">Tech Summit Jakarta 2025</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ SEARCH BAR ═══ -->
    <section class="search-bar-section">
        <div class="container">
            <div class="row g-3 align-items-center">
                <div class="col-lg-5">
                    <div class="search-input-wrap">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Cari nama event, artis, atau tempat..." />
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="search-input-wrap">
                        <i class="bi bi-geo-alt"></i>
                        <input type="text" placeholder="Lokasi" />
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-input-wrap">
                        <i class="bi bi-calendar3"></i>
                        <input type="text" placeholder="Tanggal" />
                    </div>
                </div>
                <div class="col-lg-2">
                    <a href="#events" class="btn-primary-gold w-100 justify-content-center" style="padding:0.75rem;">
                        Cari <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap mt-3">
                <button class="filter-chip active">Semua</button>
                <button class="filter-chip">Musik</button>
                <button class="filter-chip">Teknologi</button>
                <button class="filter-chip">Seni & Budaya</button>
                <button class="filter-chip">Bisnis</button>
                <button class="filter-chip">Olahraga</button>
                <button class="filter-chip">Pendidikan</button>
            </div>
        </div>
    </section>

    <!-- ═══ FEATURED EVENT ═══ -->
    <section style="padding:5rem 0 3rem;">
        <div class="container reveal">
            <div class="featured-banner">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <div class="featured-tag"><i class="bi bi-star-fill"></i> Featured Event</div>
                        <h2
                            style="font-family:'Playfair Display',serif;font-size:clamp(1.75rem,4vw,2.75rem);font-weight:700;line-height:1.15;margin-bottom:1rem;">
                            Grand Music Festival<br /><span
                                style="background:linear-gradient(135deg,var(--gold-light),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-style:italic;">Nusantara
                                2025</span>
                        </h2>
                        <p
                            style="color:var(--mist);font-size:0.95rem;line-height:1.7;margin-bottom:1.5rem;max-width:500px;">
                            Rayakan keberagaman musik Indonesia dengan 30+ artis nasional dan internasional dalam 3 hari
                            penuh keajaiban. Bergabunglah bersama 50.000 penonton!
                        </p>
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            <div class="event-meta-item"><i class="bi bi-calendar-event"></i> 15–17 Agustus 2025</div>
                            <div class="event-meta-item"><i class="bi bi-geo-alt"></i> Stadion GBK, Jakarta</div>
                            <div class="event-meta-item"><i class="bi bi-people"></i> 50.000 Kapasitas</div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mt-2">
                            <div>
                                <div class="event-price-label">Mulai dari</div>
                                <div class="event-price">Rp 350.000</div>
                            </div>
                            <a href="detail.html" class="btn-primary-gold">Lihat Detail <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div
                            style="aspect-ratio:16/9;background:linear-gradient(135deg,rgba(201,168,76,0.15),rgba(44,44,62,0.8));border-radius:8px;border:1px solid var(--glass-border);display:flex;align-items:center;justify-content:center;font-size:4rem;opacity:0.4;">
                            🎵
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ EVENTS GRID ═══ -->
    <section class="section-events" id="events">
        <div class="container">
            <div class="row align-items-end mb-5 reveal">
                <div class="col">
                    <div class="section-eyebrow">Upcoming Events</div>
                    <div class="gold-divider"></div>
                    <h2 class="section-title">Event yang Akan Datang</h2>
                </div>
                <div class="col-auto">
                    <a href="#" class="btn-ghost-gold">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="row g-4">

                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4 reveal">
                    <a href="detail.html" class="event-card">
                        <div class="event-card-img-placeholder"
                            style="background:linear-gradient(135deg,#1a0533,#2d0b4e);">
                            <span>🎸</span>
                            <div class="event-card-img-overlay"></div>
                            <div class="event-card-badge">Segera Habis</div>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-category">Musik · Konser</div>
                            <h3 class="event-card-title">Rock Uprising Live Concert</h3>
                            <div class="event-card-meta">
                                <div class="event-meta-item"><i class="bi bi-calendar3"></i> 22 Juli 2025</div>
                                <div class="event-meta-item"><i class="bi bi-geo-alt"></i> Jakarta Convention Center
                                </div>
                                <div class="event-meta-item"><i class="bi bi-person-check"></i> Tersisa 120 Tiket
                                </div>
                            </div>
                            <div class="event-card-footer">
                                <div>
                                    <div class="event-price-label">Mulai dari</div>
                                    <div class="event-price">Rp 250.000</div>
                                </div>
                                <span class="btn-card">Beli Tiket</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4 reveal">
                    <a href="detail.html" class="event-card">
                        <div class="event-card-img-placeholder"
                            style="background:linear-gradient(135deg,#001a33,#003366);">
                            <span>💻</span>
                            <div class="event-card-img-overlay"></div>
                            <div class="event-card-badge">Featured</div>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-category">Teknologi · Konferensi</div>
                            <h3 class="event-card-title">Indonesia Tech Summit 2025</h3>
                            <div class="event-card-meta">
                                <div class="event-meta-item"><i class="bi bi-calendar3"></i> 5–6 Agustus 2025</div>
                                <div class="event-meta-item"><i class="bi bi-geo-alt"></i> Bali Nusa Dua Convention
                                </div>
                                <div class="event-meta-item"><i class="bi bi-person-check"></i> 2.500 Kapasitas</div>
                            </div>
                            <div class="event-card-footer">
                                <div>
                                    <div class="event-price-label">Mulai dari</div>
                                    <div class="event-price">Rp 500.000</div>
                                </div>
                                <span class="btn-card">Beli Tiket</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4 reveal">
                    <a href="detail.html" class="event-card">
                        <div class="event-card-img-placeholder"
                            style="background:linear-gradient(135deg,#1a1200,#332800);">
                            <span>🎨</span>
                            <div class="event-card-img-overlay"></div>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-category">Seni · Pameran</div>
                            <h3 class="event-card-title">Pameran Seni Rupa Kontemporer Nusantara</h3>
                            <div class="event-card-meta">
                                <div class="event-meta-item"><i class="bi bi-calendar3"></i> 1–31 Agustus 2025</div>
                                <div class="event-meta-item"><i class="bi bi-geo-alt"></i> Galeri Nasional Indonesia
                                </div>
                                <div class="event-meta-item"><i class="bi bi-person-check"></i> 500/hari Kapasitas
                                </div>
                            </div>
                            <div class="event-card-footer">
                                <div>
                                    <div class="event-price-label">Mulai dari</div>
                                    <div class="event-price">Rp 75.000</div>
                                </div>
                                <span class="btn-card">Beli Tiket</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card 4 -->
                <div class="col-md-6 col-lg-4 reveal">
                    <a href="detail.html" class="event-card">
                        <div class="event-card-img-placeholder"
                            style="background:linear-gradient(135deg,#001a00,#003300);">
                            <span>🏃</span>
                            <div class="event-card-img-overlay"></div>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-category">Olahraga · Marathon</div>
                            <h3 class="event-card-title">Jakarta International Marathon 2025</h3>
                            <div class="event-card-meta">
                                <div class="event-meta-item"><i class="bi bi-calendar3"></i> 20 September 2025</div>
                                <div class="event-meta-item"><i class="bi bi-geo-alt"></i> Monas, Jakarta Pusat</div>
                                <div class="event-meta-item"><i class="bi bi-person-check"></i> 10.000 Peserta</div>
                            </div>
                            <div class="event-card-footer">
                                <div>
                                    <div class="event-price-label">Mulai dari</div>
                                    <div class="event-price">Rp 150.000</div>
                                </div>
                                <span class="btn-card">Beli Tiket</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card 5 -->
                <div class="col-md-6 col-lg-4 reveal">
                    <a href="detail.html" class="event-card">
                        <div class="event-card-img-placeholder"
                            style="background:linear-gradient(135deg,#1a001a,#330033);">
                            <span>🎭</span>
                            <div class="event-card-img-overlay"></div>
                            <div class="event-card-badge">Baru</div>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-category">Seni · Teater</div>
                            <h3 class="event-card-title">Teater Musikal: Sangkuriang Reborn</h3>
                            <div class="event-card-meta">
                                <div class="event-meta-item"><i class="bi bi-calendar3"></i> 10–12 Oktober 2025</div>
                                <div class="event-meta-item"><i class="bi bi-geo-alt"></i> Gedung Kesenian Jakarta
                                </div>
                                <div class="event-meta-item"><i class="bi bi-person-check"></i> 800 Kapasitas</div>
                            </div>
                            <div class="event-card-footer">
                                <div>
                                    <div class="event-price-label">Mulai dari</div>
                                    <div class="event-price">Rp 200.000</div>
                                </div>
                                <span class="btn-card">Beli Tiket</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card 6 -->
                <div class="col-md-6 col-lg-4 reveal">
                    <a href="detail.html" class="event-card">
                        <div class="event-card-img-placeholder"
                            style="background:linear-gradient(135deg,#001a1a,#003333);">
                            <span>📚</span>
                            <div class="event-card-img-overlay"></div>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-category">Pendidikan · Workshop</div>
                            <h3 class="event-card-title">Workshop AI & Future of Work 2025</h3>
                            <div class="event-card-meta">
                                <div class="event-meta-item"><i class="bi bi-calendar3"></i> 18 Oktober 2025</div>
                                <div class="event-meta-item"><i class="bi bi-geo-alt"></i> Digital Hub Surabaya</div>
                                <div class="event-meta-item"><i class="bi bi-person-check"></i> 300 Peserta</div>
                            </div>
                            <div class="event-card-footer">
                                <div>
                                    <div class="event-price-label">Mulai dari</div>
                                    <div class="event-price">Rp 450.000</div>
                                </div>
                                <span class="btn-card">Beli Tiket</span>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══ CATEGORIES ═══ -->
    <section class="section-categories" id="categories">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <div class="section-eyebrow">Browse Categories</div>
                <div class="gold-divider mx-auto"></div>
                <h2 class="section-title">Temukan Event Favoritmu</h2>
            </div>
            <div class="row g-3 reveal">
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon">🎵</div>
                        <div class="category-name">Musik</div>
                        <div class="category-count">234 Events</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon">💻</div>
                        <div class="category-name">Teknologi</div>
                        <div class="category-count">187 Events</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon">🎨</div>
                        <div class="category-name">Seni</div>
                        <div class="category-count">142 Events</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon">💼</div>
                        <div class="category-name">Bisnis</div>
                        <div class="category-count">98 Events</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon">🏃</div>
                        <div class="category-name">Olahraga</div>
                        <div class="category-count">76 Events</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon">📚</div>
                        <div class="category-name">Pendidikan</div>
                        <div class="category-count">115 Events</div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ TESTIMONIALS ═══ -->
    <section class="section-testimonials">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <div class="section-eyebrow">Testimonials</div>
                <div class="gold-divider mx-auto"></div>
                <h2 class="section-title">Apa Kata Mereka?</h2>
            </div>
            <div class="row g-4 reveal">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">"Platform paling mudah untuk beli tiket event. Prosesnya cepat,
                            aman, dan tiket digital langsung dikirim ke email. Highly recommended!"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">RK</div>
                            <div>
                                <div class="testimonial-name">Reza Kurniawan</div>
                                <div class="testimonial-role">Music Enthusiast</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">"Saya sudah pakai EventSphere untuk 5 event berbeda. Selalu
                            memuaskan! Customer service-nya juga sangat responsif dan membantu."</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">SA</div>
                            <div>
                                <div class="testimonial-name">Siti Aisyah</div>
                                <div class="testimonial-role">Event Organizer</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-text">"Desainnya premium banget, dan fiturnya lengkap. Bisa pilih kursi,
                            pilih paket tiket, dan bayar dengan berbagai metode. Top!"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">DP</div>
                            <div>
                                <div class="testimonial-name">Dimas Pratama</div>
                                <div class="testimonial-role">Tech Professional</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ CTA ═══ -->
    <section class="section-cta">
        <div class="container">
            <div class="cta-box reveal">
                <div class="section-eyebrow">Jadi Organizer</div>
                <h2 class="section-title mb-3">Punya Event? Jual Tiketnya di Sini</h2>
                <p style="color:var(--mist);max-width:500px;margin:0 auto 2rem;font-size:0.95rem;line-height:1.7;">
                    Bergabung bersama 340+ organizer dan raih lebih dari 85.000 pembeli potensial. Mudah, aman, dan
                    profesional.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="#" class="btn-primary-gold">Mulai Sekarang <i class="bi bi-arrow-right"></i></a>
                    <a href="#" class="btn-ghost-gold">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo">EventSphere</div>
                    <p class="footer-desc">Platform tiket event premium di Indonesia. Temukan, pesan, dan nikmati
                        ribuan pengalaman tak terlupakan.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-heading">Jelajahi</div>
                    <ul class="footer-links">
                        <li><a href="#">Semua Events</a></li>
                        <li><a href="#">Musik</a></li>
                        <li><a href="#">Teknologi</a></li>
                        <li><a href="#">Olahraga</a></li>
                        <li><a href="#">Seni & Budaya</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-heading">Akun</div>
                    <ul class="footer-links">
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Daftar</a></li>
                        <li><a href="#">Tiket Saya</a></li>
                        <li><a href="#">Profil</a></li>
                        <li><a href="#">Wishlist</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-heading">Organizer</div>
                    <ul class="footer-links">
                        <li><a href="#">Buat Event</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Harga</a></li>
                        <li><a href="#">Panduan</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-heading">Bantuan</div>
                    <ul class="footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            <hr class="footer-divider" />
            <div class="footer-bottom">
                <div class="footer-copy">© 2025 EventSphere. All rights reserved.</div>
                <div class="footer-copy">Dibuat dengan ❤️ di Indonesia</div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter chips
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
            });
        });

        // Scroll reveal
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        reveals.forEach(el => observer.observe(el));
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
