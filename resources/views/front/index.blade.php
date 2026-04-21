<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ str_replace('-', ' ', config('app.name')) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
</head>

<body>

    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>

    <!-- ── THEME TOGGLE ── -->
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
        <i id="t-icon" class="bi bi-moon-stars-fill t-icon"></i>
        <div class="t-pill"></div>
        <span id="t-label" class="t-label">Dark Mode</span>
    </button>

    <div class="container" style="max-width:1100px;position:relative;z-index:1;">

        <!-- HERO -->
        <div class="hero animate-up">
            <div class="hero-badge"><i class="bi bi-lightning-charge-fill"></i> Pemesanan Terbuka</div>
            <h1 class="hero-title">{{ str_replace('-', ' ', config('app.name')) }}</h1>
            <p class="hero-sub">Living Urology: Integrating Future Treatments into the Professional Journey
            </p>
        </div>

        <!-- STEPS -->
        <div class="steps animate-up delay-1">
            <div class="step active">
                <div class="step-dot">1</div>
                <div class="step-label">Pilih Tiket</div>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-dot">2</div>
                <div class="step-label">Data Diri</div>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-dot">3</div>
                <div class="step-label">Pembayaran</div>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-dot">4</div>
                <div class="step-label">Konfirmasi</div>
            </div>
        </div>

        <div class="row g-4 pb-5">

            <!-- LEFT: FORM -->
            <div class="col-lg-7">

                <!-- TICKET SELECTION -->
                <div class="form-card animate-up delay-2">
                    <div class="section-label"><i class="bi bi-ticket-perforated-fill"></i> Pilih Kategori Tiket</div>

                    @foreach ($data as $item)
                        <input type="radio" name="ticket" id="ticket-{{ $item->id }}" class="ticket-option"
                            value="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}"
                            onchange="updateSummary()" />

                        <label for="ticket-{{ $item->id }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div style="flex:1">
                                    <div class="ticket-name">{{ ucwords($item->name) }}</div>
                                    <div class="ticket-desc">{!! $item->description !!}</div>
                                </div>
                                <div class="d-flex flex-column align-items-end gap-2">
                                    <div class="check-circle"><i class="bi bi-check"></i></div>
                                    <div class="ticket-price">
                                        <span class="currency">Rp</span>
                                        {{ number_format($item->price, 0, ',', '.') }}
                                        <span class="period">/orang</span>
                                    </div>
                                </div>
                            </div>
                        </label>
                    @endforeach

                    <div style="margin-top:20px">
                        <label class="form-label">Jumlah Tiket</label>
                        <div class="d-flex align-items-center">
                            <div class="qty-stepper">
                                <button class="qty-btn" type="button" onclick="changeQty(-1)"><i
                                        class="bi bi-dash"></i></button>
                                <div class="qty-display" id="qty-display">1</div>
                                <button class="qty-btn" type="button" onclick="changeQty(1)"><i
                                        class="bi bi-plus"></i></button>
                            </div>
                            {{-- <span style="font-size:.8rem;color:var(--txt-muted);margin-left:14px">Maks. 10 tiket per
                                transaksi</span> --}}
                        </div>
                    </div>
                </div>

                <!-- DATA DIRI -->
                <div class="form-card animate-up delay-3">
                    <div class="section-label"><i class="bi bi-person-fill"></i> Data Pemesan</div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Nama Depan</label>
                            <div class="input-icon-wrap"><i class="bi bi-person"></i><input type="text"
                                    class="form-control" placeholder="John" /></div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Nama Belakang</label>
                            <div class="input-icon-wrap"><i class="bi bi-person"></i><input type="text"
                                    class="form-control" placeholder="Doe" /></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat Email</label>
                            <div class="input-icon-wrap"><i class="bi bi-envelope"></i><input type="email"
                                    class="form-control" placeholder="john@example.com" /></div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Nomor HP / WhatsApp</label>
                            <div class="input-icon-wrap"><i class="bi bi-phone"></i><input type="tel"
                                    class="form-control" placeholder="+62 812 xxxx xxxx" /></div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <div class="input-icon-wrap"><i class="bi bi-calendar"></i><input type="date"
                                    class="form-control" /></div>
                        </div>
                    </div>
                </div>
            </div><!-- /col-lg-7 -->

            <!-- RIGHT: SUMMARY -->
            <div class="col-lg-5">
                <div class="summary-card animate-up delay-2">
                    <div class="summary-title">
                        <span>Ringkasan Pesanan</span>
                        <i class="bi bi-receipt" style="color:var(--orange)"></i>
                    </div>

                    <div class="event-box">
                        <div class="ev-lbl">Event</div>
                        <div class="ev-name">{{ str_replace('-', ' ', config('app.name')) }}</div>
                        <div class="ev-meta">
                        </div>

                        <div class="summary-row">
                            <span class="s-lbl">Kategori Tiket</span>
                            <span class="s-val" id="sum-ticket">-</span>
                        </div>

                        <div class="summary-row">
                            <span class="s-lbl">Jumlah</span>
                            <span class="s-val" id="sum-qty">-</span>
                        </div>

                        <div class="summary-row">
                            <span class="s-lbl">Harga satuan</span>
                            <span class="s-val" id="sum-unit">-</span>
                        </div>

                        <div class="summary-row">
                            <span class="s-lbl">Subtotal</span>
                            <span class="s-val" id="sum-sub">-</span>
                        </div>

                        <div class="summary-row" id="promo-row" style="display:none">
                            <span class="s-lbl" style="color:#4ade80">Diskon Promo</span>
                            <span class="s-val" style="color:#4ade80" id="sum-disc"></span>
                        </div>

                        {{-- <div class="summary-row">
                            <span class="s-lbl">Biaya layanan</span>
                            <span class="s-val">Rp 25.000</span>
                        </div> --}}

                        <div class="summary-total">
                            <div class="tot-lbl">Total Pembayaran</div>
                            <div class="amount" id="sum-total">-</div>
                        </div>

                        <button class="btn-submit" id="btn-submit" onclick="handleSubmit()" disabled>
                            <i class="bi bi-lock-fill me-2"></i>Pilih Tiket Terlebih Dahulu
                        </button>

                        <div id="empty-summary" style="font-size:.85rem;color:var(--txt-muted);margin-top:10px">
                            Silakan pilih kategori tiket terlebih dahulu
                        </div>

                        <div class="guarantee">
                            <span><i class="bi bi-shield-check"></i> SSL Terenkripsi</span>
                            <span><i class="bi bi-arrow-counterclockwise"></i> Refund Policy</span>
                            <span><i class="bi bi-headset"></i> 24/7 Support</span>
                        </div>
                    </div>
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
            const sysDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            let theme = saved || (sysDark ? 'dark' : 'light');
            applyTheme(theme);

            function applyTheme(t) {
                theme = t;
                html.setAttribute('data-theme', t);
                localStorage.setItem('nb-theme', t);
                if (t === 'dark') {
                    tIcon.className = 'bi bi-moon-stars-fill t-icon';
                    tLabel.textContent = 'Dark Mode';
                } else {
                    tIcon.className = 'bi bi-sun-fill t-icon';
                    tLabel.textContent = 'Light Mode';
                }
            }

            function toggleTheme() {
                applyTheme(theme === 'dark' ? 'light' : 'dark');
            }

            let qty = 1;
            let promoApplied = false;
            const FEE = 0;

            const fmt = n => 'Rp ' + n.toLocaleString('id-ID');

            function getSelectedTicket() {
                return document.querySelector('input[name="ticket"]:checked');
            }

            function updateSummary() {
                const selected = getSelectedTicket();
                const btn = document.getElementById('btn-submit');
                const emptyMsg = document.getElementById('empty-summary');

                if (!selected) {
                    // RESET
                    document.getElementById('sum-ticket').textContent = '-';
                    document.getElementById('sum-qty').textContent = '-';
                    document.getElementById('sum-unit').textContent = '-';
                    document.getElementById('sum-sub').textContent = '-';
                    document.getElementById('sum-total').textContent = '-';

                    btn.disabled = true;
                    btn.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Pilih Tiket Terlebih Dahulu';

                    emptyMsg.style.display = 'block';
                    return;
                }

                const name = selected.dataset.name;
                const price = parseInt(selected.dataset.price);

                const sub = price * qty;
                const disc = promoApplied ? Math.round(sub * 0.1) : 0;

                document.getElementById('sum-ticket').textContent = name;
                document.getElementById('sum-qty').textContent = qty + ' tiket';
                document.getElementById('sum-unit').textContent = fmt(price);
                document.getElementById('sum-sub').textContent = fmt(sub);
                document.getElementById('sum-total').textContent = fmt(sub - disc + FEE);

                if (promoApplied) {
                    document.getElementById('sum-disc').textContent = '−' + fmt(disc);
                    document.getElementById('promo-row').style.display = '';
                } else {
                    document.getElementById('promo-row').style.display = 'none';
                }

                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Pesan Sekarang — Aman & Terenkripsi';

                emptyMsg.style.display = 'none';
            }

            function changeQty(d) {
                qty = Math.min(10, Math.max(1, qty + d));
                document.getElementById('qty-display').textContent = qty;
                updateSummary();
            }

            function handleSubmit() {
                const selected = getSelectedTicket();
                if (!selected) return;

                const btn = document.getElementById('btn-submit');

                btn.innerHTML =
                    '<i class="bi bi-arrow-repeat me-2" style="animation:spin .7s linear infinite"></i>Memproses…';
                btn.disabled = true;

                setTimeout(() => {
                    btn.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Pesanan Berhasil!';
                    btn.style.background = 'linear-gradient(135deg,#22c55e,#16a34a)';
                }, 2000);

                window.location.href = '/success';
            }

            updateSummary();
        </script>
</body>

</html>
