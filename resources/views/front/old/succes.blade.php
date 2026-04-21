<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran Berhasil — EventSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --gold-dark: #9B7A2F;
            --ink: #0D0D0D;
            --ink-soft: #1A1A2E;
            --cream: #F8F4ED;
            --charcoal: #2C2C3E;
            --mist: #8A8A9A;
            --glass: rgba(255, 255, 255, 0.06);
            --glass-border: rgba(201, 168, 76, 0.2);
            --success: #10B981;
            --success-dim: rgba(16, 185, 129, 0.12);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--ink);
            color: var(--cream);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* NOISE TEXTURE */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* CONFETTI CANVAS */
        #confetti-canvas {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 999;
        }

        /* NAVBAR */
        .navbar-custom {
            background: rgba(13, 13, 13, 0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            background: linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ══════════════════════════════
       SUCCESS HERO
    ══════════════════════════════ */
        .success-hero {
            position: relative;
            padding: 5rem 0 3rem;
            text-align: center;
            overflow: hidden;
        }

        .success-hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 50% 0%, rgba(16, 185, 129, 0.1) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 20% 80%, rgba(201, 168, 76, 0.06) 0%, transparent 60%),
                linear-gradient(180deg, #0d0d0d 0%, #1a1a2e 100%);
        }

        .success-hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(16, 185, 129, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* CHECK ICON ANIMATION */
        .success-check-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .success-rings {
            position: absolute;
            inset: -20px;
        }

        .ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 1px solid rgba(16, 185, 129, 0.3);
            animation: ring-expand 2.5s ease-out infinite;
        }

        .ring:nth-child(2) {
            animation-delay: 0.8s;
        }

        .ring:nth-child(3) {
            animation-delay: 1.6s;
        }

        @keyframes ring-expand {
            0% {
                transform: scale(0.8);
                opacity: 0.6;
            }

            100% {
                transform: scale(2.2);
                opacity: 0;
            }
        }

        .check-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.05));
            border: 2px solid rgba(16, 185, 129, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            animation: checkPop 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.3s both;
        }

        @keyframes checkPop {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .check-icon {
            font-size: 2.5rem;
            color: var(--success);
            animation: iconDraw 0.4s ease 0.7s both;
        }

        @keyframes iconDraw {
            from {
                opacity: 0;
                transform: scale(0.5) rotate(-20deg);
            }

            to {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        .success-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--success-dim);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6EE7B7;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            padding: 0.35rem 1.1rem;
            border-radius: 100px;
            margin-bottom: 1rem;
            opacity: 0;
            animation: fadeUp 0.6s 0.9s forwards;
        }

        .success-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3.25rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 0.75rem;
            opacity: 0;
            animation: fadeUp 0.6s 1.1s forwards;
        }

        .success-title .accent {
            font-style: italic;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .success-subtitle {
            font-size: 1rem;
            color: var(--mist);
            max-width: 480px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
            font-weight: 300;
            opacity: 0;
            animation: fadeUp 0.6s 1.3s forwards;
        }

        /* ORDER ID BADGE */
        .order-id-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            color: var(--mist);
            opacity: 0;
            animation: fadeUp 0.6s 1.5s forwards;
        }

        .order-id-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gold-light);
            letter-spacing: 0.05em;
        }

        .copy-id-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--mist);
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .copy-id-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ══════════════════════════════
       E-TICKET CARD
    ══════════════════════════════ */
        .section-ticket {
            padding: 3rem 0;
        }

        .ticket-wrapper {
            max-width: 680px;
            margin: 0 auto;
            opacity: 0;
            animation: fadeUp 0.7s 1.6s forwards;
        }

        .eticket {
            background: var(--ink-soft);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(201, 168, 76, 0.1);
        }

        /* TOP GOLD LINE */
        .eticket::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .eticket-header {
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.12), rgba(44, 44, 62, 0.6));
            padding: 2rem 2rem 1.75rem;
            border-bottom: 1px solid var(--glass-border);
            position: relative;
            overflow: hidden;
        }

        .eticket-header::after {
            content: '🎸';
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 6rem;
            opacity: 0.08;
            pointer-events: none;
        }

        .eticket-event-cat {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.4rem;
        }

        .eticket-event-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .eticket-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
        }

        .eticket-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.825rem;
            color: var(--mist);
        }

        .eticket-meta-item i {
            color: var(--gold);
            font-size: 0.8rem;
        }

        /* TEAR LINE */
        .tear-line {
            display: flex;
            align-items: center;
            position: relative;
            background: var(--ink);
        }

        .tear-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--ink);
            border: 1px solid var(--glass-border);
            flex-shrink: 0;
        }

        .tear-circle.left {
            margin-left: -14px;
        }

        .tear-circle.right {
            margin-right: -14px;
        }

        .tear-dashes {
            flex: 1;
            border-top: 2px dashed rgba(255, 255, 255, 0.1);
            margin: 0 0.5rem;
        }

        /* TICKET BODY */
        .eticket-body {
            padding: 2rem;
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }

        /* QR CODE AREA */
        .qr-area {
            flex-shrink: 0;
            text-align: center;
        }

        .qr-box {
            width: 130px;
            height: 130px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--gold);
            position: relative;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        /* Fake QR pattern */
        .qr-pattern {
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            grid-template-rows: repeat(10, 1fr);
            gap: 1px;
            padding: 10px;
        }

        .qr-cell {
            background: #1a1a1a;
            border-radius: 1px;
        }

        .qr-cell.w {
            background: white;
        }

        .qr-scan-line {
            position: absolute;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(201, 168, 76, 0.8), transparent);
            animation: scan 2s ease-in-out infinite;
        }

        @keyframes scan {
            0% {
                top: 10%;
            }

            50% {
                top: 85%;
            }

            100% {
                top: 10%;
            }
        }

        .qr-label {
            font-size: 0.65rem;
            color: var(--mist);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        /* TICKET DETAILS */
        .ticket-details {
            flex: 1;
            min-width: 0;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .detail-item {}

        .detail-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--mist);
            margin-bottom: 0.25rem;
        }

        .detail-val {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--cream);
        }

        .detail-val.highlight {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--gold-light);
        }

        /* TICKET TYPE PILL */
        .ticket-type-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(201, 168, 76, 0.15);
            border: 1px solid var(--gold);
            color: var(--gold);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.3rem 0.9rem;
            border-radius: 100px;
        }

        /* BARCODE FOOTER */
        .eticket-footer {
            padding: 1.5rem 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .barcode-wrap {
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .barcode-bar {
            width: 2px;
            background: rgba(201, 168, 76, 0.6);
            border-radius: 1px;
        }

        .eticket-serial {
            font-size: 0.7rem;
            color: var(--mist);
            letter-spacing: 0.15em;
            font-family: monospace;
        }

        /* ══════════════════════════════
       ACTION BUTTONS
    ══════════════════════════════ */
        .action-section {
            max-width: 680px;
            margin: 0 auto 4rem;
            opacity: 0;
            animation: fadeUp 0.6s 2s forwards;
        }

        .btn-primary-gold {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: var(--ink);
            border: none;
            padding: 1rem 2rem;
            font-size: 0.875rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .btn-primary-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(201, 168, 76, 0.4);
            color: var(--ink);
        }

        .btn-ghost {
            background: transparent;
            color: var(--mist);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 1rem 2rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .btn-ghost:hover {
            border-color: var(--gold);
            color: var(--gold-light);
        }

        .btn-outline-gold {
            background: transparent;
            color: var(--gold);
            border: 1px solid var(--gold);
            padding: 1rem 2rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .btn-outline-gold:hover {
            background: rgba(201, 168, 76, 0.1);
            color: var(--gold-light);
        }

        /* ══════════════════════════════
       SHARE SECTION
    ══════════════════════════════ */
        .share-section {
            max-width: 680px;
            margin: 0 auto 3rem;
            opacity: 0;
            animation: fadeUp 0.6s 2.1s forwards;
        }

        .share-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            padding: 1.75rem 2rem;
            text-align: center;
        }

        .share-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
        }

        .share-sub {
            font-size: 0.85rem;
            color: var(--mist);
            margin-bottom: 1.25rem;
        }

        .share-btns {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .share-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--mist);
            padding: 0.6rem 1.25rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .share-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .share-btn.whatsapp:hover {
            border-color: #25D366;
            color: #25D366;
        }

        .share-btn.twitter:hover {
            border-color: #1DA1F2;
            color: #1DA1F2;
        }

        .share-btn.instagram:hover {
            border-color: #E1306C;
            color: #E1306C;
        }

        /* ══════════════════════════════
       WHAT'S NEXT STEPS
    ══════════════════════════════ */
        .next-steps-section {
            padding: 3rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .steps-heading {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .next-step-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 10px;
            padding: 1.5rem;
            height: 100%;
            transition: border-color 0.3s;
        }

        .next-step-card:hover {
            border-color: var(--glass-border);
        }

        .step-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .step-title {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.4rem;
            color: var(--cream);
        }

        .step-desc {
            font-size: 0.825rem;
            color: var(--mist);
            line-height: 1.6;
        }

        /* ══════════════════════════════
       SUMMARY BOX
    ══════════════════════════════ */
        .summary-sidebar {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            overflow: hidden;
            position: sticky;
            top: 90px;
            opacity: 0;
            animation: fadeRight 0.7s 1.8s forwards;
        }

        @keyframes fadeRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .summary-header {
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.12), rgba(201, 168, 76, 0.04));
            border-bottom: 1px solid var(--glass-border);
            padding: 1.25rem 1.5rem;
        }

        .summary-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
        }

        .summary-body {
            padding: 1.5rem;
        }

        .sum-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            padding: 0.35rem 0;
        }

        .sum-row .lbl {
            color: var(--mist);
        }

        .sum-row .val {
            color: var(--cream);
            font-weight: 500;
        }

        .sum-divider {
            border-color: rgba(255, 255, 255, 0.07);
            margin: 0.75rem 0;
        }

        .sum-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .sum-total-lbl {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .sum-total-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--gold-light);
        }

        .payment-method-used {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 6px;
            padding: 0.75rem 1rem;
            margin-top: 1rem;
        }

        .payment-method-used i {
            color: var(--gold);
        }

        .payment-method-used .pm-name {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .payment-method-used .pm-sub {
            font-size: 0.7rem;
            color: var(--mist);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--success-dim);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6EE7B7;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.3rem 0.8rem;
            border-radius: 100px;
            margin-top: 1rem;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background: var(--success);
            border-radius: 50%;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.2
            }
        }

        /* TIMELINE */
        .timeline {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .timeline-title {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1rem;
        }

        .timeline-item {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .timeline-dot-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
        }

        .t-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-top: 3px;
        }

        .t-dot.done {
            background: var(--success);
        }

        .t-dot.active {
            background: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.2);
        }

        .t-dot.pending {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .t-line {
            width: 1px;
            flex: 1;
            background: rgba(255, 255, 255, 0.07);
            margin: 3px 0;
        }

        .t-label {
            font-size: 0.775rem;
            color: var(--cream);
            font-weight: 500;
        }

        .t-time {
            font-size: 0.7rem;
            color: var(--mist);
            margin-top: 0.1rem;
        }

        .t-label.pending {
            color: var(--mist);
        }

        /* FOOTER */
        footer {
            background: rgba(0, 0, 0, 0.5);
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding: 2rem 0;
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-copy {
            font-size: 0.8rem;
            color: var(--mist);
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* REVEAL */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s, transform 0.6s;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        @media (max-width: 992px) {
            .eticket-body {
                flex-direction: column;
                gap: 1.5rem;
            }

            .qr-area {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .detail-grid {
                grid-template-columns: 1fr 1fr;
            }

            .summary-sidebar {
                position: relative;
                top: auto;
                margin-top: 2rem;
            }
        }

        @media (max-width: 576px) {
            .eticket-header {
                padding: 1.5rem;
            }

            .eticket-body {
                padding: 1.5rem;
            }

            .eticket-footer {
                padding: 1rem 1.5rem;
            }

            .detail-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
        }

        /* ═══════════════════════════════════
     THEME SYSTEM — DARK & LIGHT MODE
  ═══════════════════════════════════ */
        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --gold-dark: #9B7A2F;
        }

        [data-theme="dark"] {
            --bg-base: #0D0D0D;
            --bg-soft: #1A1A2E;
            --bg-card: rgba(255, 255, 255, 0.03);
            --bg-card-hover: rgba(255, 255, 255, 0.06);
            --bg-input: rgba(255, 255, 255, 0.05);
            --bg-overlay: rgba(13, 13, 13, 0.92);
            --bg-featured: linear-gradient(135deg, rgba(201, 168, 76, .12), rgba(44, 44, 62, .6));
            --text-primary: #F8F4ED;
            --text-secondary: #8A8A9A;
            --text-tertiary: #5A5A6A;
            --border-subtle: rgba(255, 255, 255, 0.07);
            --border-medium: rgba(255, 255, 255, 0.12);
            --border-gold: rgba(201, 168, 76, 0.2);
            --shadow-card: 0 16px 48px rgba(0, 0, 0, .5);
            --shadow-hover: 0 24px 60px rgba(0, 0, 0, .65);
            --navbar-bg: rgba(13, 13, 13, 0.92);
            --section-alt: rgba(255, 255, 255, 0.018);
            --filter-bg: rgba(13, 13, 13, 0.65);
            --eticket-bg: #1A1A2E;
            --tear-bg: #0D0D0D;
            --footer-bg: rgba(0, 0, 0, .5);
            --grid-line: rgba(201, 168, 76, 0.04);
            --accordion-bg: rgba(255, 255, 255, 0.03);
            --noise-op: 0.4;
        }

        [data-theme="light"] {
            --bg-base: #F7F2E9;
            --bg-soft: #EDE8DC;
            --bg-card: rgba(255, 255, 255, 0.9);
            --bg-card-hover: rgba(255, 255, 255, 1);
            --bg-input: rgba(255, 255, 255, 0.92);
            --bg-overlay: rgba(247, 242, 233, 0.94);
            --bg-featured: linear-gradient(135deg, rgba(201, 168, 76, .13), rgba(240, 234, 218, .85));
            --text-primary: #1C1408;
            --text-secondary: #6B5E4A;
            --text-tertiary: #9A8E7C;
            --border-subtle: rgba(0, 0, 0, 0.07);
            --border-medium: rgba(0, 0, 0, 0.12);
            --border-gold: rgba(201, 168, 76, 0.35);
            --shadow-card: 0 4px 24px rgba(0, 0, 0, .07);
            --shadow-hover: 0 16px 48px rgba(0, 0, 0, .13);
            --navbar-bg: rgba(247, 242, 233, 0.96);
            --section-alt: rgba(0, 0, 0, 0.025);
            --filter-bg: rgba(237, 232, 220, 0.93);
            --eticket-bg: #FFFFFF;
            --tear-bg: #F7F2E9;
            --footer-bg: rgba(20, 15, 8, 0.06);
            --grid-line: rgba(201, 168, 76, 0.07);
            --accordion-bg: rgba(0, 0, 0, 0.025);
            --noise-op: 0.12;
        }

        body {
            background: var(--bg-base) !important;
            color: var(--text-primary) !important;
            transition: background .35s, color .35s;
        }

        body::before {
            opacity: var(--noise-op) !important;
        }

        /* Toggle button */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid var(--border-gold);
            background: var(--bg-card);
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            transition: all .3s;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .theme-toggle:hover {
            background: rgba(201, 168, 76, .12);
            border-color: var(--gold);
            transform: rotate(15deg) scale(1.06);
            box-shadow: 0 0 16px rgba(201, 168, 76, .25);
        }

        .theme-toggle .icon-dark,
        .theme-toggle .icon-light {
            position: absolute;
            transition: opacity .3s, transform .35s;
        }

        [data-theme="dark"] .theme-toggle .icon-dark {
            opacity: 1;
            transform: scale(1) rotate(0);
        }

        [data-theme="dark"] .theme-toggle .icon-light {
            opacity: 0;
            transform: scale(.4) rotate(90deg);
        }

        [data-theme="light"] .theme-toggle .icon-dark {
            opacity: 0;
            transform: scale(.4) rotate(-90deg);
        }

        [data-theme="light"] .theme-toggle .icon-light {
            opacity: 1;
            transform: scale(1) rotate(0);
        }

        /* Navbar */
        .navbar-custom,
        .navbar-checkout {
            background: var(--navbar-bg) !important;
            border-bottom-color: var(--border-gold) !important;
        }

        .nav-link-custom {
            color: var(--text-secondary) !important;
        }

        .nav-link-custom:hover {
            color: var(--gold-light) !important;
        }

        [data-theme="light"] .nav-link-custom:hover {
            color: var(--gold-dark) !important;
        }

        /* Cards */
        .event-card,
        .category-card,
        .testimonial-card,
        .form-section,
        .ticket-box,
        .order-summary,
        .profile-card,
        .order-card,
        .summary-sidebar,
        .info-chip,
        .next-step-card,
        .share-box,
        .featured-banner,
        .cta-box {
            background: var(--bg-card) !important;
            border-color: var(--border-subtle) !important;
            transition: background .35s, border-color .35s, box-shadow .3s, transform .3s;
        }

        .featured-banner,
        .cta-box {
            background: var(--bg-featured) !important;
            border-color: var(--border-gold) !important;
        }

        .event-card:hover,
        .order-card:hover {
            border-color: var(--border-gold) !important;
            box-shadow: var(--shadow-hover) !important;
        }

        /* Inputs */
        .form-control-custom,
        .promo-input {
            background: var(--bg-input) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-medium) !important;
        }

        .search-input-wrap,
        .search-wrap {
            background: var(--bg-input) !important;
            border-color: var(--border-medium) !important;
        }

        .search-input-wrap input,
        .search-wrap input,
        .qty-value {
            background: transparent !important;
            color: var(--text-primary) !important;
        }

        .sort-select {
            background: var(--bg-input) !important;
            color: var(--text-secondary) !important;
            border-color: var(--border-medium) !important;
        }

        /* Filters */
        .search-bar-section,
        .filter-bar {
            background: var(--filter-bg) !important;
            border-color: var(--border-gold) !important;
        }

        .filter-chip {
            border-color: var(--border-medium) !important;
            color: var(--text-secondary) !important;
        }

        .filter-chip.active,
        .filter-chip:hover {
            border-color: var(--gold) !important;
            color: var(--gold) !important;
            background: rgba(201, 168, 76, .08) !important;
        }

        .filter-tab {
            color: var(--text-secondary) !important;
        }

        .filter-tab:hover {
            color: var(--text-primary) !important;
            border-color: var(--border-medium) !important;
        }

        .filter-tab.active {
            color: var(--gold) !important;
            border-color: var(--gold) !important;
            background: rgba(201, 168, 76, .1) !important;
        }

        /* Secondary text */
        .content-text,
        .hero-subtitle,
        .event-meta-item,
        .event-card-category,
        .testimonial-text,
        .footer-desc,
        .footer-copy,
        .page-sub,
        .qr-label,
        .eticket-serial,
        .order-price-label,
        .sum-row .lbl,
        .detail-label,
        .info-chip-label,
        .ticket-box-sub,
        .lineup-role,
        .attendee-num,
        .ticket-available,
        .input-hint,
        .qty-label,
        .timeline-title,
        .order-detail-item,
        .success-subtitle,
        .stat-chip-lbl,
        .profile-stat-lbl,
        .profile-email,
        .footer-links a,
        .testimonial-role,
        .bank-detail-label,
        .pm-sub,
        .t-time,
        .empty-sub,
        .category-count,
        .step-desc,
        .expand-row .el,
        .order-price-label,
        .share-sub,
        .order-summary-title,
        .qr-scan-label,
        .nav-link-sm {
            color: var(--text-secondary) !important;
        }

        /* Primary text */
        .event-card-title,
        .order-event-name,
        .eticket-event-name,
        .testimonial-name,
        .profile-name,
        .lineup-name,
        .ticket-type-name,
        .detail-val,
        .expand-row .ev,
        .bank-detail-value,
        .step-title,
        .pm-name,
        .t-label,
        .empty-title,
        .category-name,
        .form-section-title,
        .order-summary-title,
        .ticket-box-title,
        .content-heading,
        .sum-total-lbl,
        .success-title,
        .stat-chip-val {
            color: var(--text-primary) !important;
        }

        /* Section alt */
        .section-categories {
            background: var(--section-alt) !important;
        }

        /* Footer */
        footer {
            background: var(--footer-bg) !important;
        }

        [data-theme="light"] .footer-links a {
            color: var(--text-secondary) !important;
        }

        [data-theme="light"] .footer-links a:hover {
            color: var(--gold-dark) !important;
        }

        /* E-ticket */
        .eticket {
            background: var(--eticket-bg) !important;
        }

        .eticket-header {
            background: var(--bg-featured) !important;
        }

        .tear-line,
        .tear-circle {
            background: var(--tear-bg) !important;
        }

        /* Misc */
        .ticket-summary {
            background: rgba(0, 0, 0, .18) !important;
        }

        [data-theme="light"] .ticket-summary {
            background: rgba(0, 0, 0, .04) !important;
        }

        .bank-detail-box {
            background: rgba(0, 0, 0, .2) !important;
        }

        [data-theme="light"] .bank-detail-box {
            background: rgba(0, 0, 0, .03) !important;
        }

        .order-actions {
            background: rgba(0, 0, 0, .15) !important;
        }

        [data-theme="light"] .order-actions {
            background: rgba(0, 0, 0, .03) !important;
        }

        .accordion-button {
            background: var(--accordion-bg) !important;
            color: var(--text-primary) !important;
        }

        .accordion-body {
            background: var(--accordion-bg) !important;
            color: var(--text-secondary) !important;
        }

        /* Payment method */
        .payment-method {
            border-color: var(--border-medium) !important;
        }

        .payment-method.selected {
            border-color: var(--gold) !important;
            background: rgba(201, 168, 76, .05) !important;
        }

        .ticket-type {
            border-color: var(--border-medium) !important;
        }

        .ticket-type.selected {
            border-color: var(--gold) !important;
            background: rgba(201, 168, 76, .05) !important;
        }

        .lineup-card {
            border-color: var(--border-subtle) !important;
        }

        .map-placeholder {
            border-color: var(--border-gold) !important;
            color: var(--text-secondary) !important;
        }

        .organizer-box {
            background: var(--bg-card) !important;
            border-color: var(--border-subtle) !important;
        }

        .event-card-mini {
            background: var(--bg-card) !important;
            border-color: var(--border-subtle) !important;
        }

        .event-card-mini:hover {
            border-color: var(--border-gold) !important;
        }

        .event-card-mini-title {
            color: var(--text-primary) !important;
        }

        .event-card-mini-date {
            color: var(--text-secondary) !important;
        }

        /* Hero grid lines */
        [data-theme="light"] .hero-grid {
            background-image:
                linear-gradient(var(--grid-line) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid-line) 1px, transparent 1px) !important;
        }

        /* Profile */
        .profile-card-header {
            background: var(--bg-featured) !important;
        }

        .profile-stat+.profile-stat {
            border-left-color: var(--border-subtle) !important;
        }

        .profile-menu-item {
            color: var(--text-secondary) !important;
        }

        .profile-menu-item:hover {
            color: var(--text-primary) !important;
            background: var(--section-alt) !important;
        }

        .profile-menu-item.active {
            color: var(--gold) !important;
            background: rgba(201, 168, 76, .06) !important;
        }

        [data-theme="light"] .profile-menu-item.active {
            color: var(--gold-dark) !important;
        }

        /* Year divider */
        [data-theme="light"] .year-divider::before,
        [data-theme="light"] .year-divider::after {
            background: rgba(0, 0, 0, .08) !important;
        }

        /* Buttons */
        .btn-ghost,
        .btn-ghost-gold,
        .act-btn.outline,
        .action-btn,
        .share-btn {
            color: var(--text-secondary) !important;
            border-color: var(--border-medium) !important;
        }

        .btn-ghost:hover,
        .btn-ghost-gold:hover,
        .act-btn.outline:hover,
        .action-btn:hover,
        .share-btn:hover {
            border-color: var(--border-gold) !important;
            color: var(--gold) !important;
        }

        [data-theme="light"] .btn-ghost:hover,[data-theme="light"] .btn-ghost-gold:hover,
        [data-theme="light"] .act-btn.outline:hover {
            color: var(--gold-dark) !important;
        }

        /* btn-nav */
        [data-theme="light"] .btn-nav {
            color: var(--gold-dark) !important;
            border-color: var(--gold-dark) !important;
        }

        [data-theme="light"] .btn-nav:hover {
            background: var(--gold-dark) !important;
            color: #fff !important;
        }

        /* nav-link-sm */
        .nav-link-sm {
            color: var(--text-secondary) !important;
        }

        .nav-link-sm:hover,
        .nav-link-sm.active {
            color: var(--gold) !important;
        }

        [data-theme="light"] .nav-link-sm.active {
            color: var(--gold-dark) !important;
        }

        /* Light toggler icon */
        [data-theme="light"] .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28155%2C122%2C47%2C0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px
        }

        ::-webkit-scrollbar-track {
            background: transparent
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-gold);
            border-radius: 3px
        }

        /* Hero stat label in light mode */
        [data-theme="light"] .hero-stat-label {
            color: var(--text-secondary) !important;
        }

        /* Social links */
        .social-link {
            color: var(--text-secondary) !important;
            border-color: var(--border-subtle) !important;
        }

        .social-link:hover {
            color: var(--gold) !important;
            border-color: var(--border-gold) !important;
        }
    </style>
    <script>
        // Prevent flash of wrong theme
        (function() {
            var t = localStorage.getItem('es-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>
</head>

<body>

    <canvas id="confetti-canvas"></canvas>

    <!-- ═══ NAVBAR ═══ -->
    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="text-decoration-none">
                    <span class="navbar-brand-text">EventSphere</span>
                </a>
                <div style="display:flex;align-items:center;gap:1rem;">
                    <a href="history.html" class="nav-link-sm"><i class="bi bi-receipt"></i> Riwayat</a>
                    <a href="index.html" class="nav-link-sm"><i class="bi bi-grid"></i> Beranda</a>
                    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle tema" aria-label="Toggle tema">
                        <i class="bi bi-moon-stars-fill icon-dark"></i>
                        <i class="bi bi-sun-fill icon-light"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- ═══ SUCCESS HERO ═══ -->
    <section class="success-hero">
        <div class="success-hero-bg"></div>
        <div class="success-hero-grid"></div>
        <div class="container position-relative">
            <div class="success-check-wrap">
                <div class="success-rings">
                    <div class="ring"></div>
                    <div class="ring"></div>
                    <div class="ring"></div>
                </div>
                <div class="check-circle">
                    <i class="bi bi-check-lg check-icon"></i>
                </div>
            </div>

            <div class="success-label">
                <div class="status-dot"></div>
                Pembayaran Dikonfirmasi
            </div>
            <h1 class="success-title">Selamat,<br />Tiketmu <span class="accent">Sudah Siap!</span></h1>
            <p class="success-subtitle">
                E-ticket telah dikirim ke <strong style="color:var(--cream);">reza@email.com</strong><br />
                Simpan QR code di bawah untuk masuk ke venue.
            </p>
            <div class="order-id-badge">
                <span>Order ID</span>
                <span class="order-id-val" id="order-id-text">EVS-2025-07-4829</span>
                <button class="copy-id-btn" onclick="copyOrderId()">
                    <i class="bi bi-clipboard"></i> Salin
                </button>
            </div>
        </div>
    </section>

    <!-- ═══ E-TICKET + SIDEBAR ═══ -->
    <section class="section-ticket">
        <div class="container">
            <div class="row g-4 justify-content-center">

                <!-- TICKET + ACTIONS -->
                <div class="col-lg-7">

                    <!-- E-TICKET -->
                    <div class="ticket-wrapper">
                        <div class="eticket">

                            <!-- Header -->
                            <div class="eticket-header">
                                <div class="eticket-event-cat">Musik · Konser</div>
                                <div class="eticket-event-name">Rock Uprising Live Concert</div>
                                <div class="eticket-meta-row">
                                    <div class="eticket-meta-item"><i class="bi bi-calendar3"></i> Selasa, 22 Juli
                                        2025</div>
                                    <div class="eticket-meta-item"><i class="bi bi-clock"></i> 19.00 – 23.00 WIB</div>
                                    <div class="eticket-meta-item"><i class="bi bi-geo-alt"></i> Jakarta Convention
                                        Center</div>
                                </div>
                            </div>

                            <!-- Tear Line -->
                            <div class="tear-line">
                                <div class="tear-circle left"></div>
                                <div class="tear-dashes"></div>
                                <div class="tear-circle right"></div>
                            </div>

                            <!-- Body -->
                            <div class="eticket-body">
                                <!-- QR Code -->
                                <div class="qr-area">
                                    <div class="qr-box">
                                        <!-- Fake QR Pattern -->
                                        <div
                                            style="position:absolute;inset:10px;display:grid;grid-template-columns:repeat(9,1fr);gap:2px;">
                                            <script>
                                                // will be rendered via JS
                                            </script>
                                        </div>
                                        <canvas id="qr-canvas" width="110" height="110"></canvas>
                                        <div class="qr-scan-line"></div>
                                    </div>
                                    <div class="qr-label">Scan to Enter</div>
                                </div>

                                <!-- Details -->
                                <div class="ticket-details">
                                    <div class="detail-grid">
                                        <div class="detail-item">
                                            <div class="detail-label">Nama Pemegang</div>
                                            <div class="detail-val">Reza Kurniawan</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Tipe Tiket</div>
                                            <div class="ticket-type-pill"><i class="bi bi-ticket-perforated"></i>
                                                REGULAR</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Tanggal Pembelian</div>
                                            <div class="detail-val">10 Jun 2025, 14:32</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Jumlah Tiket</div>
                                            <div class="detail-val highlight">1 Tiket</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Nomor Kursi</div>
                                            <div class="detail-val highlight">Standing — GA</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Total Bayar</div>
                                            <div class="detail-val highlight">Rp 262.500</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Barcode -->
                            <div class="eticket-footer">
                                <div class="barcode-wrap" id="barcode"></div>
                                <div class="eticket-serial">EVS · 4829 · REG · 0001</div>
                                <div style="font-size:0.65rem;color:var(--mist);">Berlaku 1 orang</div>
                            </div>

                        </div>
                    </div>

                    <!-- ACTIONS -->
                    <div class="action-section mt-3">
                        <div class="row g-2">
                            <div class="col-12 col-sm-5">
                                <a href="#" class="btn-primary-gold" onclick="printTicket()">
                                    <i class="bi bi-download"></i> Unduh E-Ticket
                                </a>
                            </div>
                            <div class="col-6 col-sm-4">
                                <a href="#" class="btn-outline-gold" onclick="printTicket()">
                                    <i class="bi bi-printer"></i> Cetak
                                </a>
                            </div>
                            <div class="col-6 col-sm-3">
                                <a href="history.html" class="btn-ghost">
                                    <i class="bi bi-receipt"></i> Riwayat
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- SHARE -->
                    <div class="share-section">
                        <div class="share-box">
                            <div class="share-title">Bagikan Momenmu! 🎉</div>
                            <div class="share-sub">Ceritakan ke teman bahwa kamu akan hadir di event ini</div>
                            <div class="share-btns">
                                <a href="#" class="share-btn whatsapp"><i class="bi bi-whatsapp"></i>
                                    WhatsApp</a>
                                <a href="#" class="share-btn twitter"><i class="bi bi-twitter-x"></i>
                                    Twitter/X</a>
                                <a href="#" class="share-btn instagram"><i class="bi bi-instagram"></i>
                                    Instagram</a>
                                <button class="share-btn"
                                    onclick="navigator.clipboard.writeText(window.location.href)"><i
                                        class="bi bi-link-45deg"></i> Salin Link</button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- SIDEBAR SUMMARY -->
                <div class="col-lg-4">
                    <div class="summary-sidebar">
                        <div class="summary-header">
                            <div class="summary-title">Detail Transaksi</div>
                        </div>
                        <div class="summary-body">

                            <div class="status-pill">
                                <div class="status-dot"></div>
                                Pembayaran Berhasil
                            </div>

                            <div class="timeline">
                                <div class="timeline-title">Riwayat Status</div>
                                <div class="timeline-item">
                                    <div class="timeline-dot-wrap">
                                        <div class="t-dot done"></div>
                                        <div class="t-line"></div>
                                    </div>
                                    <div>
                                        <div class="t-label">Order dibuat</div>
                                        <div class="t-time">10 Jun 2025, 14:30</div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot-wrap">
                                        <div class="t-dot done"></div>
                                        <div class="t-line"></div>
                                    </div>
                                    <div>
                                        <div class="t-label">Pembayaran diterima</div>
                                        <div class="t-time">10 Jun 2025, 14:32</div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot-wrap">
                                        <div class="t-dot active"></div>
                                        <div class="t-line"></div>
                                    </div>
                                    <div>
                                        <div class="t-label">E-Ticket dikirim ke email</div>
                                        <div class="t-time">10 Jun 2025, 14:33</div>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot-wrap">
                                        <div class="t-dot pending"></div>
                                    </div>
                                    <div>
                                        <div class="t-label pending">Hari H — Scan & Masuk</div>
                                        <div class="t-time">22 Jul 2025, 17.00</div>
                                    </div>
                                </div>
                            </div>

                            <hr class="sum-divider" />

                            <div class="sum-row"><span class="lbl">Subtotal (1 tiket)</span><span
                                    class="val">Rp 250.000</span></div>
                            <div class="sum-row"><span class="lbl">Biaya layanan</span><span class="val">Rp
                                    12.500</span></div>
                            <div class="sum-row" style="color:#6EE7B7;"><span class="lbl"
                                    style="color:#6EE7B7;">Diskon ROCK25</span><span class="val"
                                    style="color:#6EE7B7;">−Rp 25.000</span></div>

                            <hr class="sum-divider" />
                            <div class="sum-total">
                                <span class="sum-total-lbl">Total Dibayar</span>
                                <span class="sum-total-val">Rp 237.500</span>
                            </div>

                            <div class="payment-method-used">
                                <i class="bi bi-bank"></i>
                                <div>
                                    <div class="pm-name">Transfer Bank BCA</div>
                                    <div class="pm-sub">Dibayar 10 Jun 2025, 14:32</div>
                                </div>
                            </div>

                            <hr class="sum-divider" />

                            <a href="index.html"
                                style="display:flex;align-items:center;justify-content:center;gap:0.5rem;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:6px;padding:0.75rem;color:var(--mist);text-decoration:none;font-size:0.825rem;transition:all 0.2s;"
                                onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold-light)'"
                                onmouseout="this.style.borderColor='rgba(255,255,255,0.08)';this.style.color='var(--mist)'">
                                <i class="bi bi-grid"></i> Jelajahi Event Lainnya
                            </a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══ WHAT'S NEXT ═══ -->
    <section class="next-steps-section reveal">
        <div class="container">
            <div class="steps-heading">Apa yang Perlu Kamu Lakukan?</div>
            <div class="row g-3 justify-content-center">
                <div class="col-md-3 col-sm-6">
                    <div class="next-step-card">
                        <div class="step-icon-wrap" style="background:rgba(16,185,129,0.1);">📧</div>
                        <div class="step-title">Cek Email</div>
                        <div class="step-desc">E-ticket telah dikirim ke emailmu. Cek folder spam jika tidak ditemukan.
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="next-step-card">
                        <div class="step-icon-wrap" style="background:rgba(201,168,76,0.1);">📱</div>
                        <div class="step-title">Simpan Tiket</div>
                        <div class="step-desc">Screenshot atau download QR code. Pastikan bisa ditampilkan saat masuk
                            venue.</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="next-step-card">
                        <div class="step-icon-wrap" style="background:rgba(59,130,246,0.1);">🗺️</div>
                        <div class="step-title">Cek Lokasi</div>
                        <div class="step-desc">Jakarta Convention Center, Senayan. Rencanakan perjalananmu lebih awal.
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="next-step-card">
                        <div class="step-icon-wrap" style="background:rgba(168,85,247,0.1);">🎉</div>
                        <div class="step-title">Datang & Nikmati</div>
                        <div class="step-desc">Hadir 30 menit sebelum mulai untuk registrasi dan pengambilan wristband.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
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
        // ── CONFETTI ──
        const canvas = document.getElementById('confetti-canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const colors = ['#C9A84C', '#E8C97A', '#10B981', '#F8F4ED', '#9B7A2F', '#6EE7B7'];
        const particles = [];

        for (let i = 0; i < 120; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height - canvas.height,
                w: Math.random() * 10 + 4,
                h: Math.random() * 6 + 3,
                color: colors[Math.floor(Math.random() * colors.length)],
                speed: Math.random() * 3 + 1.5,
                angle: Math.random() * Math.PI * 2,
                spin: (Math.random() - 0.5) * 0.2,
                opacity: Math.random() * 0.8 + 0.2,
            });
        }

        let animFrame;
        let confettiActive = true;
        let fadeStart = null;

        function drawConfetti(ts) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (!fadeStart && ts > 3500) fadeStart = ts;

            let globalAlpha = 1;
            if (fadeStart) {
                globalAlpha = Math.max(0, 1 - (ts - fadeStart) / 1500);
            }

            if (globalAlpha <= 0) {
                canvas.style.display = 'none';
                return;
            }

            particles.forEach(p => {
                p.y += p.speed;
                p.angle += p.spin;
                if (p.y > canvas.height + 20) {
                    p.y = -20;
                    p.x = Math.random() * canvas.width;
                }
                ctx.save();
                ctx.globalAlpha = p.opacity * globalAlpha;
                ctx.translate(p.x, p.y);
                ctx.rotate(p.angle);
                ctx.fillStyle = p.color;
                ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
                ctx.restore();
            });

            animFrame = requestAnimationFrame(drawConfetti);
        }

        requestAnimationFrame(drawConfetti);

        // ── FAKE QR CODE ──
        const qrCanvas = document.getElementById('qr-canvas');
        const qrCtx = qrCanvas.getContext('2d');
        const size = 9;
        const cell = Math.floor(qrCanvas.width / size);

        // Corner markers
        function drawCorner(x, y) {
            qrCtx.fillStyle = '#1a1a1a';
            qrCtx.fillRect(x, y, cell * 3, cell * 3);
            qrCtx.fillStyle = 'white';
            qrCtx.fillRect(x + cell * 0.5, y + cell * 0.5, cell * 2, cell * 2);
            qrCtx.fillStyle = '#1a1a1a';
            qrCtx.fillRect(x + cell, y + cell, cell, cell);
        }

        qrCtx.fillStyle = 'white';
        qrCtx.fillRect(0, 0, qrCanvas.width, qrCanvas.height);

        // Random data cells
        for (let r = 0; r < size; r++) {
            for (let c = 0; c < size; c++) {
                if ((r < 3 && c < 3) || (r < 3 && c > size - 4) || (r > size - 4 && c < 3)) continue;
                if (Math.random() > 0.5) {
                    qrCtx.fillStyle = '#1a1a1a';
                    qrCtx.fillRect(c * cell + 1, r * cell + 1, cell - 2, cell - 2);
                }
            }
        }

        drawCorner(0, 0);
        drawCorner((size - 3) * cell, 0);
        drawCorner(0, (size - 3) * cell);

        // ── BARCODE ──
        const barcode = document.getElementById('barcode');
        const heights = [18, 10, 16, 8, 20, 12, 18, 6, 14, 20, 8, 16, 10, 18, 12, 6, 20, 14, 8, 18, 10, 16];
        heights.forEach(h => {
            const bar = document.createElement('div');
            bar.className = 'barcode-bar';
            bar.style.height = h + 'px';
            barcode.appendChild(bar);
        });

        // ── COPY ORDER ID ──
        function copyOrderId() {
            const text = document.getElementById('order-id-text').textContent;
            navigator.clipboard.writeText(text);
            const btn = document.querySelector('.copy-id-btn');
            btn.innerHTML = '<i class="bi bi-check"></i> Tersalin!';
            btn.style.color = 'var(--gold)';
            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-clipboard"></i> Salin';
                btn.style.color = '';
            }, 2000);
        }

        function printTicket() {
            alert('Fitur unduh/cetak e-ticket akan membuka halaman print-friendly tiket Anda.');
        }

        // ── SCROLL REVEAL ──
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1
        });
        reveals.forEach(el => observer.observe(el));

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
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
