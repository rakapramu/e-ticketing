<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout — EventSphere</title>
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
            --error: #EF4444;
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
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* NAVBAR — minimal checkout */
        .navbar-checkout {
            background: rgba(13, 13, 13, 0.95);
            border-bottom: 1px solid var(--glass-border);
            padding: 1rem 0;
        }

        .navbar-brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .checkout-steps {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: var(--mist);
        }

        .step-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 600;
            flex-shrink: 0;
        }

        .step.active .step-num {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--ink);
        }

        .step.active {
            color: var(--cream);
        }

        .step.done .step-num {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .step.done {
            color: var(--mist);
        }

        .step-line {
            width: 40px;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        /* LAYOUT */
        .checkout-main {
            padding: 2.5rem 0 5rem;
        }

        /* SECTIONS */
        .form-section {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .form-section-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.02);
        }

        .form-section-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(201, 168, 76, 0.15);
            border: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gold);
            flex-shrink: 0;
        }

        .form-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
        }

        .form-section-body {
            padding: 1.5rem;
        }

        /* FORM FIELDS */
        .form-label-custom {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--mist);
            margin-bottom: 0.5rem;
        }

        .form-control-custom {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            padding: 0.85rem 1rem;
            transition: all 0.3s;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: var(--gold);
            background: rgba(201, 168, 76, 0.04);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.08);
        }

        .form-control-custom::placeholder {
            color: var(--mist);
            opacity: 0.6;
        }

        .form-control-custom option {
            background: var(--charcoal);
            color: var(--cream);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        /* RADIO / PAYMENT METHOD */
        .payment-method {
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 1rem 1.25rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.75rem;
            position: relative;
        }

        .payment-method:hover {
            border-color: var(--glass-border);
        }

        .payment-method.selected {
            border-color: var(--gold);
            background: rgba(201, 168, 76, 0.05);
        }

        .payment-method-icon {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .payment-method-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--cream);
        }

        .payment-method-desc {
            font-size: 0.75rem;
            color: var(--mist);
            margin-top: 0.1rem;
        }

        .payment-radio {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
            margin-left: auto;
            flex-shrink: 0;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-method.selected .payment-radio {
            border-color: var(--gold);
            background: var(--gold);
        }

        .payment-method.selected .payment-radio::after {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--ink);
        }

        .payment-badge {
            position: absolute;
            top: -8px;
            right: 12px;
            background: var(--gold);
            color: var(--ink);
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            padding: 0.15rem 0.5rem;
            border-radius: 100px;
            text-transform: uppercase;
        }

        /* BANK DETAIL BOX */
        .bank-detail-box {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 8px;
            padding: 1.25rem;
            margin-top: 1rem;
            display: none;
        }

        .bank-detail-box.show {
            display: block;
        }

        .bank-detail-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .bank-detail-label {
            font-size: 0.75rem;
            color: var(--mist);
        }

        .bank-detail-value {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--cream);
        }

        .copy-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--mist);
            font-size: 0.7rem;
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .copy-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* CARD INPUT */
        .card-input-group {
            position: relative;
        }

        .card-icons {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            gap: 0.3rem;
            align-items: center;
            font-size: 1.25rem;
            pointer-events: none;
        }

        /* ORDER SUMMARY */
        .order-summary {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            overflow: hidden;
            position: sticky;
            top: 90px;
        }

        .order-summary-header {
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.15), rgba(201, 168, 76, 0.05));
            border-bottom: 1px solid var(--glass-border);
            padding: 1.25rem 1.5rem;
        }

        .order-summary-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .order-summary-body {
            padding: 1.5rem;
        }

        /* EVENT MINI CARD */
        .event-mini {
            display: flex;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 8px;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .event-mini-img {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            background: linear-gradient(135deg, #1a0533, #2d0b4e);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .event-mini-name {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--cream);
            line-height: 1.3;
        }

        .event-mini-meta {
            font-size: 0.75rem;
            color: var(--mist);
            margin-top: 0.25rem;
        }

        /* SUMMARY ROWS */
        .sum-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
            padding: 0.4rem 0;
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

        .sum-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .sum-total-lbl {
            font-size: 1rem;
            font-weight: 600;
            color: var(--cream);
        }

        .sum-total-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--gold-light);
        }

        /* TICKET BADGE */
        .ticket-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(201, 168, 76, 0.1);
            border: 1px solid var(--glass-border);
            color: var(--gold);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.3rem 0.75rem;
            border-radius: 100px;
            margin-bottom: 1rem;
        }

        /* BUTTONS */
        .btn-primary-gold {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: var(--ink);
            border: none;
            padding: 1rem 2rem;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s;
            width: 100%;
            cursor: pointer;
        }

        .btn-primary-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(201, 168, 76, 0.4);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--mist);
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.3s;
            margin-bottom: 1.5rem;
        }

        .btn-back:hover {
            color: var(--gold-light);
        }

        /* PROMO CODE */
        .promo-row {
            display: flex;
            gap: 0.5rem;
        }

        .promo-input {
            flex: 1;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .promo-input:focus {
            border-color: var(--gold);
        }

        .promo-input::placeholder {
            color: var(--mist);
            opacity: 0.6;
        }

        .promo-btn {
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            padding: 0.75rem 1.25rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .promo-btn:hover {
            background: rgba(201, 168, 76, 0.1);
        }

        /* SECURITY BADGES */
        .security-strip {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .security-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.7rem;
            color: var(--mist);
        }

        .security-item i {
            color: var(--gold);
        }

        /* TERMS CHECKBOX */
        .custom-check {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            cursor: pointer;
            margin-bottom: 1.25rem;
        }

        .custom-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--gold);
            flex-shrink: 0;
            margin-top: 2px;
            cursor: pointer;
        }

        .custom-check-label {
            font-size: 0.8rem;
            color: var(--mist);
            line-height: 1.6;
        }

        .custom-check-label a {
            color: var(--gold);
            text-decoration: none;
        }

        .custom-check-label a:hover {
            text-decoration: underline;
        }

        /* SUCCESS MODAL */
        .modal-success .modal-content {
            background: var(--ink-soft);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.15);
            border: 2px solid rgba(16, 185, 129, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
            color: var(--success);
        }

        .success-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        /* TOOLTIP */
        .input-hint {
            font-size: 0.7rem;
            color: var(--mist);
            margin-top: 0.35rem;
        }

        /* ATTENDEE ROW */
        .attendee-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .attendee-num {
            font-size: 0.75rem;
            color: var(--gold);
            font-weight: 600;
            background: rgba(201, 168, 76, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 100px;
        }

        /* FIELD GROUP */
        .field-group-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0 1.25rem;
        }

        .field-group-divider span {
            font-size: 0.75rem;
            color: var(--mist);
            white-space: nowrap;
        }

        .field-group-divider::before,
        .field-group-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.07);
        }

        footer {
            background: rgba(0, 0, 0, 0.5);
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding: 1.5rem 0;
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

        @media (max-width: 768px) {
            .checkout-steps {
                display: none;
            }

            .order-summary {
                position: relative;
                top: auto;
                margin-top: 2rem;
            }
        }

        /* Spinner */
        .spinner {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(13, 13, 13, 0.3);
            border-top-color: var(--ink);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Promo success */
        .promo-success {
            font-size: 0.75rem;
            color: var(--success);
            margin-top: 0.4rem;
            display: none;
        }

        .promo-success.show {
            display: block;
        }

        /* Field validation */
        .form-control-custom.invalid {
            border-color: var(--error);
        }

        .field-error {
            font-size: 0.7rem;
            color: #FCA5A5;
            margin-top: 0.3rem;
            display: none;
        }

        .field-error.show {
            display: block;
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

    <!-- ═══ NAVBAR CHECKOUT ═══ -->
    <nav class="navbar-checkout">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="text-decoration-none">
                    <span class="navbar-brand-text">EventSphere</span>
                </a>
                <div class="checkout-steps">
                    <div class="step done">
                        <div class="step-num"><i class="bi bi-check" style="font-size:0.65rem;"></i></div>
                        <span>Pilih Tiket</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step active">
                        <div class="step-num">2</div>
                        <span>Data Pesanan</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-num">3</div>
                        <span>Pembayaran</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-num">4</div>
                        <span>Konfirmasi</span>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    <div style="font-size:0.8rem;color:var(--mist);display:flex;align-items:center;gap:0.35rem;">
                        <i class="bi bi-lock-fill" style="color:var(--gold);"></i> Checkout Aman
                    </div>
                    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle tema" aria-label="Toggle tema">
                        <i class="bi bi-moon-stars-fill icon-dark"></i>
                        <i class="bi bi-sun-fill icon-light"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- ═══ CHECKOUT MAIN ═══ -->
    <div class="checkout-main">
        <div class="container">
            <a href="detail.html" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Detail Event
            </a>

            <div class="row g-5">

                <!-- FORM COLUMN -->
                <div class="col-lg-7">

                    <!-- 1. DATA PEMESAN -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <div class="form-section-num">1</div>
                            <div>
                                <div class="form-section-title">Data Pemesan</div>
                                <div style="font-size:0.75rem;color:var(--mist);">Informasi akun kamu sebagai pemesan
                                </div>
                            </div>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label-custom">Nama Lengkap *</label>
                                        <input type="text" class="form-control-custom" id="buyer-name"
                                            placeholder="Masukkan nama lengkap" />
                                        <div class="field-error" id="err-buyer-name">Nama tidak boleh kosong</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label-custom">Email *</label>
                                        <input type="email" class="form-control-custom" id="buyer-email"
                                            placeholder="email@contoh.com" />
                                        <div class="field-error" id="err-buyer-email">Email tidak valid</div>
                                        <div class="input-hint">E-ticket akan dikirim ke email ini</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label-custom">No. WhatsApp *</label>
                                        <input type="tel" class="form-control-custom" id="buyer-phone"
                                            placeholder="08xx xxxx xxxx" />
                                        <div class="field-error" id="err-buyer-phone">Nomor tidak valid</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label-custom">Kota</label>
                                        <input type="text" class="form-control-custom"
                                            placeholder="Kota domisili" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. DATA PESERTA -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <div class="form-section-num">2</div>
                            <div>
                                <div class="form-section-title">Data Peserta</div>
                                <div style="font-size:0.75rem;color:var(--mist);">Isi data untuk setiap tiket yang
                                    dipesan</div>
                            </div>
                        </div>
                        <div class="form-section-body" id="attendee-forms">
                            <!-- Attendee 1 -->
                            <div class="attendee-block">
                                <div class="attendee-header">
                                    <div style="font-weight:600;font-size:0.875rem;">Peserta 1</div>
                                    <div class="attendee-num">REGULAR</div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label-custom">Nama Lengkap *</label>
                                            <input type="text" class="form-control-custom att-name"
                                                placeholder="Nama peserta" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label-custom">Nomor Identitas *</label>
                                            <input type="text" class="form-control-custom"
                                                placeholder="KTP / SIM / Paspor" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label-custom">Email Peserta</label>
                                            <input type="email" class="form-control-custom"
                                                placeholder="email peserta" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label-custom">Tipe Kelamin</label>
                                            <select class="form-control-custom">
                                                <option value="" disabled selected>Pilih...</option>
                                                <option>Laki-laki</option>
                                                <option>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <label class="custom-check mt-1">
                                    <input type="checkbox" id="same-as-buyer" onchange="fillSameAsBuyer(this)">
                                    <span class="custom-check-label">Sama dengan data pemesan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- 3. KODE PROMO -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <div class="form-section-num">3</div>
                            <div>
                                <div class="form-section-title">Kode Promo</div>
                                <div style="font-size:0.75rem;color:var(--mist);">Punya kode promo? Masukkan di sini
                                </div>
                            </div>
                        </div>
                        <div class="form-section-body">
                            <div class="promo-row">
                                <input type="text" class="promo-input" id="promo-code"
                                    placeholder="Masukkan kode promo..." style="text-transform:uppercase;" />
                                <button class="promo-btn" onclick="applyPromo()">Terapkan</button>
                            </div>
                            <div class="promo-success" id="promo-success"><i class="bi bi-check-circle-fill"></i>
                                Kode ROCK25 berhasil! Diskon Rp 25.000 diterapkan</div>
                            <div style="font-size:0.7rem;color:var(--mist);margin-top:0.5rem;">Coba kode: <strong
                                    style="color:var(--gold);">ROCK25</strong></div>
                        </div>
                    </div>

                    <!-- 4. METODE PEMBAYARAN -->
                    <div class="form-section">
                        <div class="form-section-header">
                            <div class="form-section-num">4</div>
                            <div>
                                <div class="form-section-title">Metode Pembayaran</div>
                                <div style="font-size:0.75rem;color:var(--mist);">Pilih metode pembayaran favoritmu
                                </div>
                            </div>
                        </div>
                        <div class="form-section-body">

                            <!-- Transfer Bank -->
                            <div class="payment-method selected" onclick="selectPayment(this,'transfer')"
                                id="pay-transfer">
                                <div class="payment-method-icon">🏦</div>
                                <div>
                                    <div class="payment-method-name">Transfer Bank</div>
                                    <div class="payment-method-desc">BCA, Mandiri, BNI, BRI</div>
                                </div>
                                <div class="payment-radio"></div>
                            </div>

                            <!-- QRIS -->
                            <div class="payment-method" onclick="selectPayment(this,'qris')" id="pay-qris">
                                <div class="payment-badge">Rekomendasi</div>
                                <div class="payment-method-icon">📲</div>
                                <div>
                                    <div class="payment-method-name">QRIS / QR Code</div>
                                    <div class="payment-method-desc">GoPay, OVO, Dana, LinkAja, ShopeePay</div>
                                </div>
                                <div class="payment-radio"></div>
                            </div>

                            <!-- Kartu Kredit -->
                            <div class="payment-method" onclick="selectPayment(this,'card')" id="pay-card">
                                <div class="payment-method-icon">💳</div>
                                <div>
                                    <div class="payment-method-name">Kartu Kredit / Debit</div>
                                    <div class="payment-method-desc">Visa, Mastercard, JCB</div>
                                </div>
                                <div class="payment-radio"></div>
                            </div>

                            <!-- Indomaret/Alfamart -->
                            <div class="payment-method" onclick="selectPayment(this,'retail')" id="pay-retail">
                                <div class="payment-method-icon">🏪</div>
                                <div>
                                    <div class="payment-method-name">Minimarket</div>
                                    <div class="payment-method-desc">Indomaret, Alfamart</div>
                                </div>
                                <div class="payment-radio"></div>
                            </div>

                            <!-- Dynamic Payment Detail -->
                            <div id="payment-detail">

                                <!-- Transfer Detail -->
                                <div id="detail-transfer" class="bank-detail-box show">
                                    <div style="font-size:0.8rem;color:var(--mist);margin-bottom:1rem;">Pilih bank
                                        tujuan transfer:</div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6 col-md-3">
                                            <button class="w-100 bank-select selected"
                                                onclick="selectBank(this,'BCA')"
                                                style="background:rgba(0,70,160,0.2);border:1px solid rgba(0,70,160,0.4);border-radius:6px;padding:0.75rem 0.5rem;color:var(--cream);font-size:0.8rem;font-weight:600;cursor:pointer;transition:all 0.2s;">BCA</button>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <button class="w-100 bank-select" onclick="selectBank(this,'Mandiri')"
                                                style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:6px;padding:0.75rem 0.5rem;color:var(--mist);font-size:0.8rem;font-weight:600;cursor:pointer;transition:all 0.2s;">Mandiri</button>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <button class="w-100 bank-select" onclick="selectBank(this,'BNI')"
                                                style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:6px;padding:0.75rem 0.5rem;color:var(--mist);font-size:0.8rem;font-weight:600;cursor:pointer;transition:all 0.2s;">BNI</button>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <button class="w-100 bank-select" onclick="selectBank(this,'BRI')"
                                                style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:6px;padding:0.75rem 0.5rem;color:var(--mist);font-size:0.8rem;font-weight:600;cursor:pointer;transition:all 0.2s;">BRI</button>
                                        </div>
                                    </div>
                                    <div class="bank-detail-row">
                                        <div>
                                            <div class="bank-detail-label">Nomor Rekening</div>
                                            <div class="bank-detail-value" id="bank-number">1234 5678 9012</div>
                                        </div>
                                        <button class="copy-btn" onclick="copyText('bank-number')"><i
                                                class="bi bi-clipboard"></i> Salin</button>
                                    </div>
                                    <div class="bank-detail-row">
                                        <div>
                                            <div class="bank-detail-label">Nama Pemilik</div>
                                            <div class="bank-detail-value">PT Nada Semesta Entertainment</div>
                                        </div>
                                    </div>
                                    <div
                                        style="background:rgba(201,168,76,0.08);border:1px solid var(--glass-border);border-radius:6px;padding:0.75rem;font-size:0.75rem;color:var(--mist);">
                                        <i class="bi bi-info-circle" style="color:var(--gold);"></i> Transfer sesuai
                                        total yang tertera. Pembayaran akan dikonfirmasi dalam 1×24 jam.
                                    </div>
                                </div>

                                <!-- QRIS Detail -->
                                <div id="detail-qris" class="bank-detail-box">
                                    <div style="text-align:center;">
                                        <div
                                            style="width:160px;height:160px;background:white;border-radius:8px;margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;font-size:0.75rem;color:#333;border:4px solid var(--gold);">
                                            <div style="text-align:center;">
                                                <div style="font-size:2rem;">📱</div>
                                                <div>QR Code</div>
                                                <div style="font-size:0.65rem;color:#666;">Scan via e-wallet</div>
                                            </div>
                                        </div>
                                        <div style="font-size:0.8rem;color:var(--mist);">Scan QR ini menggunakan
                                            aplikasi e-wallet kamu</div>
                                        <div style="font-size:0.75rem;color:var(--mist);margin-top:0.25rem;">Berlaku
                                            selama <strong style="color:var(--gold);">15 menit</strong></div>
                                    </div>
                                </div>

                                <!-- Card Detail -->
                                <div id="detail-card" class="bank-detail-box">
                                    <div class="form-group">
                                        <label class="form-label-custom">Nomor Kartu</label>
                                        <div class="card-input-group">
                                            <input type="text" class="form-control-custom"
                                                placeholder="1234 5678 9012 3456" maxlength="19"
                                                oninput="formatCard(this)" />
                                            <div class="card-icons">💳</div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label-custom">Tanggal Kadaluarsa</label>
                                                <input type="text" class="form-control-custom"
                                                    placeholder="MM / YY" maxlength="7"
                                                    oninput="formatExpiry(this)" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label-custom">CVV</label>
                                                <input type="password" class="form-control-custom" placeholder="•••"
                                                    maxlength="3" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label-custom">Nama di Kartu</label>
                                        <input type="text" class="form-control-custom"
                                            placeholder="Nama sesuai kartu" />
                                    </div>
                                </div>

                                <!-- Retail Detail -->
                                <div id="detail-retail" class="bank-detail-box">
                                    <div style="font-size:0.8rem;color:var(--mist);margin-bottom:0.75rem;">Kode
                                        pembayaran akan dikirim ke WhatsApp setelah kamu klik "Bayar Sekarang"</div>
                                    <div
                                        style="background:rgba(201,168,76,0.08);border:1px solid var(--glass-border);border-radius:6px;padding:0.75rem;font-size:0.75rem;color:var(--mist);">
                                        <i class="bi bi-info-circle" style="color:var(--gold);"></i> Tunjukkan kode ke
                                        kasir. Batas pembayaran 2 jam setelah order dibuat.
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- 5. SYARAT & KETENTUAN -->
                    <div style="padding: 0.5rem 0;">
                        <label class="custom-check">
                            <input type="checkbox" id="agree-terms">
                            <span class="custom-check-label">Saya setuju dengan <a href="#">Syarat &
                                    Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> EventSphere</span>
                        </label>
                        <label class="custom-check">
                            <input type="checkbox" id="agree-refund">
                            <span class="custom-check-label">Saya memahami <a href="#">kebijakan refund</a> yang
                                berlaku untuk event ini</span>
                        </label>
                    </div>

                </div><!-- /FORM COLUMN -->

                <!-- ORDER SUMMARY -->
                <div class="col-lg-5">
                    <div class="order-summary">
                        <div class="order-summary-header">
                            <div class="order-summary-title">Ringkasan Pesanan</div>
                        </div>
                        <div class="order-summary-body">

                            <!-- Event Mini -->
                            <div class="event-mini">
                                <div class="event-mini-img">🎸</div>
                                <div>
                                    <div class="event-mini-name">Rock Uprising Live Concert</div>
                                    <div class="event-mini-meta"><i class="bi bi-calendar3"
                                            style="color:var(--gold);"></i> 22 Juli 2025, 19.00 WIB</div>
                                    <div class="event-mini-meta"><i class="bi bi-geo-alt"
                                            style="color:var(--gold);"></i> Jakarta Convention Center</div>
                                </div>
                            </div>

                            <div class="ticket-badge"><i class="bi bi-ticket-perforated"></i> 1× REGULAR</div>

                            <!-- Summary Rows -->
                            <div class="sum-row">
                                <span class="lbl">REGULAR × 1</span>
                                <span class="val">Rp 250.000</span>
                            </div>
                            <div class="sum-row">
                                <span class="lbl">Biaya layanan (5%)</span>
                                <span class="val">Rp 12.500</span>
                            </div>
                            <div class="sum-row" id="discount-row" style="display:none;">
                                <span class="lbl" style="color:#6EE7B7;">Diskon Promo</span>
                                <span class="val" style="color:#6EE7B7;">−Rp 25.000</span>
                            </div>

                            <hr class="sum-divider" />

                            <div class="sum-total-row">
                                <span class="sum-total-lbl">Total Pembayaran</span>
                                <span class="sum-total-val" id="grand-total">Rp 262.500</span>
                            </div>

                            <!-- Timer -->
                            <div
                                style="background:rgba(220,38,38,0.1);border:1px solid rgba(220,38,38,0.2);border-radius:6px;padding:0.75rem;margin:1rem 0;text-align:center;">
                                <div
                                    style="font-size:0.7rem;color:#FCA5A5;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:0.25rem;">
                                    Selesaikan pembayaran dalam</div>
                                <div style="font-family:'Playfair Display',serif;font-size:1.5rem;color:#FCA5A5;font-weight:700;"
                                    id="order-timer">14:59</div>
                            </div>

                            <!-- Pay Button -->
                            <button class="btn-primary-gold" onclick="submitOrder()">
                                <i class="bi bi-lock-fill"></i> Bayar Sekarang
                            </button>

                            <!-- Security -->
                            <div class="security-strip">
                                <div class="security-item"><i class="bi bi-shield-check"></i> SSL Terenkripsi</div>
                                <div class="security-item"><i class="bi bi-award"></i> PCI DSS</div>
                                <div class="security-item"><i class="bi bi-headset"></i> 24/7 Support</div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ═══ SUCCESS MODAL ═══ -->
    <div class="modal fade modal-success" id="successModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="success-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <h3 class="success-title">Pembayaran Berhasil!</h3>
                    <p style="color:var(--mist);font-size:0.9rem;margin-bottom:1.5rem;line-height:1.7;">
                        E-ticket telah dikirim ke email kamu. Tunjukkan QR code di pintu masuk event.
                    </p>

                    <!-- Ticket Preview -->
                    <div
                        style="background:rgba(201,168,76,0.08);border:1px solid var(--glass-border);border-radius:10px;padding:1.25rem;margin-bottom:1.5rem;">
                        <div
                            style="font-size:0.7rem;color:var(--mist);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.75rem;">
                            Order ID</div>
                        <div
                            style="font-family:'Playfair Display',serif;font-size:1.25rem;font-weight:700;color:var(--gold-light);margin-bottom:1rem;">
                            EVS-2025-07-4829</div>

                        <div style="display:flex;gap:1rem;align-items:center;">
                            <div
                                style="width:80px;height:80px;background:white;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:0.6rem;color:#333;flex-shrink:0;">
                                QR Code
                            </div>
                            <div style="text-align:left;">
                                <div
                                    style="font-family:'Playfair Display',serif;font-size:0.95rem;font-weight:600;color:var(--cream);">
                                    Rock Uprising Live Concert</div>
                                <div style="font-size:0.75rem;color:var(--mist);margin-top:0.25rem;">22 Juli 2025 ·
                                    19.00 WIB</div>
                                <div style="font-size:0.75rem;color:var(--mist);">Jakarta Convention Center</div>
                                <div
                                    style="margin-top:0.5rem;background:rgba(201,168,76,0.15);border:1px solid var(--glass-border);color:var(--gold);font-size:0.65rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:100px;display:inline-block;letter-spacing:0.08em;">
                                    REGULAR</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-center">
                        <button
                            style="background:var(--gold);border:none;color:var(--ink);padding:0.75rem 1.5rem;border-radius:6px;font-weight:700;font-size:0.875rem;cursor:pointer;"
                            onclick="window.location='index.html'">
                            <i class="bi bi-download"></i> Unduh Tiket
                        </button>
                        <button
                            style="background:transparent;border:1px solid rgba(255,255,255,0.15);color:var(--mist);padding:0.75rem 1.5rem;border-radius:6px;font-size:0.875rem;cursor:pointer;"
                            onclick="window.location='index.html'">
                            Kembali ke Beranda
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-bottom">
                <div class="footer-logo">EventSphere</div>
                <div class="footer-copy">© 2025 EventSphere. Transaksi aman & terenkripsi</div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Payment selection
        let currentPayment = 'transfer';

        function selectPayment(el, type) {
            document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
            el.classList.add('selected');
            currentPayment = type;

            // Hide all details
            document.querySelectorAll('.bank-detail-box').forEach(d => d.classList.remove('show'));

            // Show selected
            const detail = document.getElementById('detail-' + type);
            if (detail) detail.classList.add('show');
        }

        // Bank selection
        function selectBank(el, bank) {
            document.querySelectorAll('.bank-select').forEach(b => {
                b.style.background = 'rgba(255,255,255,0.04)';
                b.style.borderColor = 'rgba(255,255,255,0.1)';
                b.style.color = 'var(--mist)';
            });
            el.style.background = 'rgba(201,168,76,0.15)';
            el.style.borderColor = 'var(--gold)';
            el.style.color = 'var(--gold-light)';

            const numbers = {
                BCA: '1234 5678 9012',
                Mandiri: '9876 5432 1098',
                BNI: '4567 8901 2345',
                BRI: '2345 6789 0123'
            };
            document.getElementById('bank-number').textContent = numbers[bank] || '-';
        }

        // Copy to clipboard
        function copyText(id) {
            const text = document.getElementById(id).textContent;
            navigator.clipboard.writeText(text.replace(/\s/g, '')).then(() => {
                const btn = event.target.closest('.copy-btn');
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check"></i> Disalin!';
                btn.style.color = 'var(--gold)';
                setTimeout(() => {
                    btn.innerHTML = orig;
                    btn.style.color = '';
                }, 2000);
            });
        }

        // Card number formatting
        function formatCard(el) {
            let v = el.value.replace(/\D/g, '').slice(0, 16);
            el.value = v.replace(/(.{4})/g, '$1 ').trim();
        }

        function formatExpiry(el) {
            let v = el.value.replace(/\D/g, '').slice(0, 4);
            if (v.length >= 3) v = v.slice(0, 2) + ' / ' + v.slice(2);
            el.value = v;
        }

        // Promo code
        function applyPromo() {
            const code = document.getElementById('promo-code').value.trim().toUpperCase();
            const success = document.getElementById('promo-success');
            const discRow = document.getElementById('discount-row');
            const total = document.getElementById('grand-total');

            if (code === 'ROCK25') {
                success.classList.add('show');
                discRow.style.display = 'flex';
                total.textContent = 'Rp 237.500';
            } else {
                success.classList.remove('show');
                discRow.style.display = 'none';
                total.textContent = 'Rp 262.500';
                if (code) alert('Kode promo tidak valid. Coba: ROCK25');
            }
        }

        // Fill same as buyer
        function fillSameAsBuyer(checkbox) {
            const name = document.getElementById('buyer-name').value;
            const attName = document.querySelector('.att-name');
            if (checkbox.checked && name) {
                attName.value = name;
            } else {
                attName.value = '';
            }
        }

        // Order timer
        let totalSeconds = 15 * 60 - 1;

        function updateTimer() {
            const m = Math.floor(totalSeconds / 60);
            const s = totalSeconds % 60;
            document.getElementById('order-timer').textContent =
                String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
            if (totalSeconds > 0) totalSeconds--;
        }

        setInterval(updateTimer, 1000);
        updateTimer();

        // Validation & submit
        function validate() {
            let ok = true;

            const buyerName = document.getElementById('buyer-name');
            const buyerEmail = document.getElementById('buyer-email');
            const buyerPhone = document.getElementById('buyer-phone');

            document.querySelectorAll('.form-control-custom').forEach(f => f.classList.remove('invalid'));
            document.querySelectorAll('.field-error').forEach(f => f.classList.remove('show'));

            if (!buyerName.value.trim()) {
                buyerName.classList.add('invalid');
                document.getElementById('err-buyer-name').classList.add('show');
                ok = false;
            }

            if (!buyerEmail.value.includes('@')) {
                buyerEmail.classList.add('invalid');
                document.getElementById('err-buyer-email').classList.add('show');
                ok = false;
            }

            if (!buyerPhone.value.trim() || buyerPhone.value.length < 10) {
                buyerPhone.classList.add('invalid');
                document.getElementById('err-buyer-phone').classList.add('show');
                ok = false;
            }

            if (!document.getElementById('agree-terms').checked) {
                alert('Harap setujui Syarat & Ketentuan terlebih dahulu.');
                ok = false;
            }

            return ok;
        }

        function submitOrder() {
            if (!validate()) return;

            const btn = document.querySelector('.btn-primary-gold');
            const orig = btn.innerHTML;
            btn.innerHTML = '<span class="spinner"></span> Memproses...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = orig;
                btn.disabled = false;
                const modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();
            }, 2200);
        }
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
