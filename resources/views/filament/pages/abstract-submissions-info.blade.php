<x-filament-panels::page>
    <style>
        .custom-page-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            font-family: inherit;
        }

        /* Glassmorphism Hero Card */
        .hero-card {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            background: linear-gradient(135deg, #2563eb 0%, #1e1b4b 100%);
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            color: #ffffff;
        }

        .hero-circle-1 {
            position: absolute;
            right: -2.5rem;
            bottom: -2.5rem;
            height: 10rem;
            width: 10rem;
            border-radius: 9999px;
            background-color: rgba(255, 255, 255, 0.1);
            filter: blur(24px);
            pointer-events: none;
        }

        .hero-circle-2 {
            position: absolute;
            left: -2.5rem;
            top: -2.5rem;
            height: 10rem;
            width: 10rem;
            border-radius: 9999px;
            background-color: rgba(99, 102, 241, 0.2);
            filter: blur(40px);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 9999px;
            background-color: rgba(255, 255, 255, 0.15);
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .hero-title {
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            line-height: 1.25;
        }

        @media (min-width: 768px) {
            .hero-title {
                font-size: 2.25rem;
            }
        }

        .hero-desc {
            color: #dbeafe;
            line-height: 1.625;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            .hero-desc {
                font-size: 1rem;
            }
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 0.75rem;
            background-color: #ffffff;
            padding: 0.75rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: #1e1b4b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .download-btn:hover {
            background-color: #f8fafc;
            transform: scale(1.03);
        }

        .download-btn:active {
            transform: scale(0.97);
        }

        /* Info Cards Grid - side-by-side by default */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem;
        }

        @media (max-width: 640px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        .info-card {
            border-radius: 1rem;
            background-color: #ffffff;
            padding: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        /* Light & Dark adaptive colors */
        .dark .info-card {
            background-color: #111827;
            border-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3);
        }

        .icon-wrapper-blue {
            border-radius: 0.75rem;
            background-color: #eff6ff;
            padding: 0.75rem;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dark .icon-wrapper-blue {
            background-color: rgba(37, 99, 235, 0.2);
            color: #60a5fa;
        }

        .icon-wrapper-green {
            border-radius: 0.75rem;
            background-color: #f0fdf4;
            padding: 0.75rem;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dark .icon-wrapper-green {
            background-color: rgba(22, 163, 74, 0.2);
            color: #4ade80;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .card-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .dark .card-label {
            color: #6b7280;
        }

        .card-val {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
            line-height: 1.25;
        }

        .dark .card-val {
            color: #f3f4f6;
        }

        .card-link {
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            padding-top: 0.25rem;
            transition: color 0.2s;
        }

        .card-link-blue {
            color: #2563eb;
        }

        .card-link-blue:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .dark .card-link-blue {
            color: #60a5fa;
        }

        .dark .card-link-blue:hover {
            color: #93c5fd;
        }

        .card-link-green {
            color: #16a34a;
        }

        .card-link-green:hover {
            color: #15803d;
            text-decoration: underline;
        }

        .dark .card-link-green {
            color: #4ade80;
        }

        .dark .card-link-green:hover {
            color: #86efac;
        }
    </style>

    <div class="custom-page-container">
        <!-- Glassmorphism Hero Card -->
        <div class="hero-card">
            <div class="hero-circle-1"></div>
            <div class="hero-circle-2"></div>
            
            <div style="position: relative; z-index: 10; max-width: 42rem;">
                <div class="hero-badge">
                    📢 Pengumuman Penting
                </div>
                <h1 class="hero-title">
                    Scientific Competition JUF 2026
                </h1>
                <p class="hero-desc">
                    Pengumpulan abstrak untuk kompetisi ilmiah JUF 2026 kini dialihkan langsung melalui email panitia. Silakan unduh panduan penulisan di bawah ini dan ikuti petunjuk pengiriman yang tertera.
                </p>
                
                <div>
                    <a href="{{ asset('files/Scientific_Competition_JUF_2026_Author_Guidelines.pdf') }}" 
                       target="_blank"
                       download
                       class="download-btn">
                        <svg style="height: 1.25rem; width: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Download Author Guidelines (PDF)
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Cards Grid -->
        <div class="info-grid">
            <!-- Email Submission Card -->
            <div class="info-card">
                <div class="icon-wrapper-blue">
                    <svg style="height: 1.5rem; width: 1.5rem;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <div class="card-content">
                    <div class="card-label">
                        Pengumpulan Abstrak
                    </div>
                    <p class="card-val">
                        Melalui Email Resmi
                    </p>
                    <a href="mailto:jufscientific2026@gmail.com" class="card-link card-link-blue">
                        jufscientific2026@gmail.com
                    </a>
                </div>
            </div>

            <!-- Contact Person Card -->
            <div class="info-card">
                <div class="icon-wrapper-green">
                    <svg style="height: 1.5rem; width: 1.5rem;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.187-4.165-7-7l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                </div>
                <div class="card-content">
                    <div class="card-label">
                        Hubungi Panitia (CP)
                    </div>
                    <p class="card-val">
                        David
                    </p>
                    <a href="https://wa.me/628114141120" target="_blank" class="card-link card-link-green">
                        08114141120 (WhatsApp)
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
