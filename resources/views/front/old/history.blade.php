<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Pemesanan — EventSphere</title>
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
            --warning: #F59E0B;
            --danger: #EF4444;
            --info: #3B82F6;
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

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* ── NAVBAR ── */
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

        .nav-link-sm {
            font-size: 0.825rem;
            color: var(--mist);
            text-decoration: none;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .nav-link-sm:hover {
            color: var(--gold-light);
        }

        .nav-link-sm.active {
            color: var(--gold);
        }

        .navbar-toggler {
            border: 1px solid rgba(201, 168, 76, 0.3);
            padding: 0.4rem 0.6rem;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28201%2C168%2C76%2C0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ── PAGE HEADER ── */
        .page-header {
            background: linear-gradient(180deg, rgba(26, 26, 46, 0.8) 0%, transparent 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 3rem 0 2rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .page-eyebrow {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.4rem;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.75rem, 3vw, 2.5rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 0.4rem;
        }

        .page-sub {
            font-size: 0.9rem;
            color: var(--mist);
        }

        /* STAT CHIPS */
        .stat-chips {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        .stat-chip {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            padding: 0.75rem 1.1rem;
            transition: border-color 0.3s;
        }

        .stat-chip:hover {
            border-color: var(--glass-border);
        }

        .stat-chip-icon {
            font-size: 1.1rem;
        }

        .stat-chip-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--gold-light);
            line-height: 1;
        }

        .stat-chip-lbl {
            font-size: 0.65rem;
            color: var(--mist);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 0.1rem;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            background: rgba(13, 13, 13, 0.6);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 1rem 0;
            position: sticky;
            top: 73px;
            z-index: 90;
            backdrop-filter: blur(16px);
        }

        .filter-tabs {
            display: flex;
            gap: 0.25rem;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .filter-tabs::-webkit-scrollbar {
            display: none;
        }

        .filter-tab {
            background: transparent;
            border: 1px solid transparent;
            color: var(--mist);
            padding: 0.5rem 1.1rem;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .filter-tab:hover {
            color: var(--cream);
            border-color: rgba(255, 255, 255, 0.15);
        }

        .filter-tab.active {
            background: rgba(201, 168, 76, 0.12);
            border-color: var(--gold);
            color: var(--gold);
        }

        .tab-count {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.1rem 0.45rem;
            line-height: 1.4;
        }

        .filter-tab.active .tab-count {
            background: rgba(201, 168, 76, 0.25);
            color: var(--gold-light);
        }

        /* SEARCH + SORT */
        .search-sort-row {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-wrap {
            flex: 1;
            min-width: 200px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            display: flex;
            align-items: center;
            padding: 0.6rem 1rem;
            gap: 0.6rem;
            transition: border-color 0.3s;
        }

        .search-wrap:focus-within {
            border-color: var(--gold);
        }

        .search-wrap i {
            color: var(--mist);
            font-size: 0.85rem;
        }

        .search-wrap input {
            background: transparent;
            border: none;
            outline: none;
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            flex: 1;
        }

        .search-wrap input::placeholder {
            color: var(--mist);
            opacity: 0.6;
        }

        .sort-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: var(--mist);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            padding: 0.6rem 1rem;
            outline: none;
            cursor: pointer;
        }

        .sort-select option {
            background: var(--charcoal);
            color: var(--cream);
        }

        /* ── MAIN CONTENT ── */
        .history-main {
            padding: 2rem 0 5rem;
        }

        /* ── ORDER CARD ── */
        .order-card {
            background: rgba(255, 255, 255, 0.025);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.25rem;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
        }

        .order-card:hover {
            border-color: var(--glass-border);
            transform: translateY(-2px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.4);
        }

        .order-card.expanded {
            border-color: var(--gold);
        }

        .order-card-header {
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* EVENT THUMB */
        .order-thumb {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* ORDER META */
        .order-meta {
            flex: 1;
            min-width: 0;
        }

        .order-event-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--cream);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.25rem;
        }

        .order-event-details {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .order-detail-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.78rem;
            color: var(--mist);
        }

        .order-detail-item i {
            color: var(--gold);
            font-size: 0.7rem;
        }

        /* STATUS */
        .order-status {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.3rem 0.85rem;
            border-radius: 100px;
            flex-shrink: 0;
        }

        .order-status.success {
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6EE7B7;
        }

        .order-status.pending {
            background: rgba(245, 158, 11, 0.12);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #FCD34D;
        }

        .order-status.cancelled {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #FCA5A5;
        }

        .order-status.used {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--mist);
        }

        .order-status.refunded {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: #93C5FD;
        }

        .status-dot-sm {
            width: 5px;
            height: 5px;
            border-radius: 50%;
        }

        .success .status-dot-sm {
            background: var(--success);
            animation: blink 1.5s infinite;
        }

        .pending .status-dot-sm {
            background: var(--warning);
            animation: blink 1.5s infinite;
        }

        .cancelled .status-dot-sm {
            background: var(--danger);
        }

        .used .status-dot-sm {
            background: var(--mist);
        }

        .refunded .status-dot-sm {
            background: var(--info);
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.3
            }
        }

        /* ORDER PRICE */
        .order-price-col {
            text-align: right;
            flex-shrink: 0;
        }

        .order-price {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--gold-light);
        }

        .order-price-label {
            font-size: 0.68rem;
            color: var(--mist);
            margin-top: 0.1rem;
        }

        .order-chevron {
            color: var(--mist);
            font-size: 0.875rem;
            flex-shrink: 0;
            transition: transform 0.3s;
        }

        .order-card.expanded .order-chevron {
            transform: rotate(180deg);
        }

        /* ── ORDER DETAIL EXPAND ── */
        .order-detail-expand {
            display: none;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .order-card.expanded .order-detail-expand {
            display: block;
        }

        .order-detail-body {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        @media (max-width: 640px) {
            .order-detail-body {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
        }

        /* TICKET MINI in expand */
        .ticket-mini-expand {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .ticket-mini-qr {
            width: 52px;
            height: 52px;
            background: white;
            border-radius: 6px;
            border: 2px solid var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.5rem;
            color: #333;
            flex-shrink: 0;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-align: center;
            line-height: 1.2;
        }

        .ticket-mini-info .t-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--cream);
        }

        .ticket-mini-info .t-type {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: rgba(201, 168, 76, 0.1);
            border: 1px solid var(--glass-border);
            color: var(--gold);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.15rem 0.6rem;
            border-radius: 100px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 0.25rem;
        }

        .ticket-mini-info .t-code {
            font-size: 0.7rem;
            color: var(--mist);
            margin-top: 0.2rem;
            font-family: monospace;
            letter-spacing: 0.08em;
        }

        /* DETAIL EXPAND ROWS */
        .expand-section-title {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.75rem;
        }

        .expand-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.825rem;
            padding: 0.35rem 0;
        }

        .expand-row .el {
            color: var(--mist);
        }

        .expand-row .ev {
            color: var(--cream);
            font-weight: 500;
            text-align: right;
        }

        .expand-divider {
            border-color: rgba(255, 255, 255, 0.06);
            margin: 0.6rem 0;
        }

        /* ACTION BUTTONS EXPAND */
        .order-actions {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .act-btn {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.55rem 1.1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .act-btn.primary {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: var(--ink);
        }

        .act-btn.primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(201, 168, 76, 0.3);
        }

        .act-btn.outline {
            background: transparent;
            border-color: rgba(255, 255, 255, 0.12);
            color: var(--mist);
        }

        .act-btn.outline:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .act-btn.danger {
            background: transparent;
            border-color: rgba(239, 68, 68, 0.2);
            color: #FCA5A5;
        }

        .act-btn.danger:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.4);
        }

        /* ── SIDEBAR / PROFILE ── */
        .profile-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 12px;
            overflow: hidden;
            position: sticky;
            top: 130px;
        }

        .profile-card-header {
            background: linear-gradient(135deg, rgba(201, 168, 76, 0.12), rgba(201, 168, 76, 0.03));
            border-bottom: 1px solid var(--glass-border);
            padding: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .profile-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--ink);
            margin: 0 auto 0.75rem;
            border: 2px solid rgba(201, 168, 76, 0.4);
            box-shadow: 0 0 0 4px rgba(201, 168, 76, 0.08);
        }

        .profile-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--cream);
        }

        .profile-email {
            font-size: 0.8rem;
            color: var(--mist);
            margin-top: 0.2rem;
        }

        .member-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background: rgba(201, 168, 76, 0.12);
            border: 1px solid var(--glass-border);
            color: var(--gold);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.25rem 0.75rem;
            border-radius: 100px;
            margin-top: 0.75rem;
        }

        .profile-stats {
            display: flex;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .profile-stat {
            flex: 1;
            text-align: center;
        }

        .profile-stat+.profile-stat {
            border-left: 1px solid rgba(255, 255, 255, 0.06);
        }

        .profile-stat-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gold-light);
        }

        .profile-stat-lbl {
            font-size: 0.65rem;
            color: var(--mist);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 0.1rem;
        }

        .profile-menu {
            padding: 0.75rem 0;
        }

        .profile-menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1.5rem;
            font-size: 0.875rem;
            color: var(--mist);
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .profile-menu-item:hover {
            background: rgba(255, 255, 255, 0.03);
            color: var(--cream);
        }

        .profile-menu-item.active {
            background: rgba(201, 168, 76, 0.06);
            color: var(--gold);
            border-left: 2px solid var(--gold);
            padding-left: calc(1.5rem - 2px);
        }

        .profile-menu-item i {
            width: 16px;
            text-align: center;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            display: none;
        }

        .empty-state.show {
            display: block;
        }

        .empty-icon {
            font-size: 4rem;
            opacity: 0.2;
            margin-bottom: 1.5rem;
        }

        .empty-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-sub {
            font-size: 0.9rem;
            color: var(--mist);
            margin-bottom: 1.5rem;
        }

        /* ── PAGINATION ── */
        .pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            margin-top: 2.5rem;
        }

        .page-btn {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--mist);
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .page-btn.active {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--ink);
            font-weight: 700;
        }

        /* ── BTN PRIMARY GOLD ── */
        .btn-primary-gold {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: var(--ink);
            border: none;
            padding: 0.75rem 1.75rem;
            font-size: 0.875rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .btn-primary-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(201, 168, 76, 0.3);
            color: var(--ink);
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

        /* YEAR DIVIDER */
        .year-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0 1rem;
        }

        .year-divider span {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gold);
            white-space: nowrap;
        }

        .year-divider::before,
        .year-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.07);
        }

        /* TOOLTIP for refund */
        .tooltip-hint {
            font-size: 0.7rem;
            color: var(--mist);
            display: flex;
            align-items: center;
            gap: 0.3rem;
            margin-top: 0.5rem;
        }

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

        @media (max-width: 992px) {
            .profile-card {
                position: relative;
                top: auto;
                margin-bottom: 1.5rem;
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

    <!-- ═══ NAVBAR ═══ -->
    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between w-100">
                <a href="index.html" class="text-decoration-none">
                    <span class="navbar-brand-text">EventSphere</span>
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navMenuH">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-lg-flex align-items-center gap-3 justify-content-end"
                    id="navMenuH">
                    <div class="d-flex flex-column flex-lg-row gap-2 gap-lg-3 mt-3 mt-lg-0">
                        <a href="index.html" class="nav-link-sm"><i class="bi bi-grid"></i> Events</a>
                        <a href="history.html" class="nav-link-sm active"><i class="bi bi-receipt"></i> Riwayat</a>
                        <a href="#" class="nav-link-sm"><i class="bi bi-person"></i> Profil</a>
                    </div>
                    <button class="theme-toggle mt-3 mt-lg-0" onclick="toggleTheme()" title="Toggle tema"
                        aria-label="Toggle tema">
                        <i class="bi bi-moon-stars-fill icon-dark"></i>
                        <i class="bi bi-sun-fill icon-light"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- ═══ PAGE HEADER ═══ -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-end g-4">
                <div class="col-lg-7">
                    <nav aria-label="breadcrumb" style="margin-bottom:0.75rem;">
                        <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.78rem;color:var(--mist);">
                            <a href="index.html" style="color:var(--mist);text-decoration:none;transition:color 0.2s;"
                                onmouseover="this.style.color='var(--gold-light)'"
                                onmouseout="this.style.color='var(--mist)'">Home</a>
                            <span style="color:rgba(255,255,255,0.2);">/</span>
                            <span style="color:var(--cream);">Riwayat Pemesanan</span>
                        </div>
                    </nav>
                    <div class="page-eyebrow">My Orders</div>
                    <h1 class="page-title">Riwayat<br /><span
                            style="font-style:italic;background:linear-gradient(135deg,var(--gold-light),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Pemesanan</span>
                    </h1>
                    <p class="page-sub">Kelola semua tiket dan transaksi eventmu di satu tempat</p>

                    <div class="stat-chips">
                        <div class="stat-chip">
                            <div class="stat-chip-icon">🎫</div>
                            <div>
                                <div class="stat-chip-val">12</div>
                                <div class="stat-chip-lbl">Total Pesanan</div>
                            </div>
                        </div>
                        <div class="stat-chip">
                            <div class="stat-chip-icon">✅</div>
                            <div>
                                <div class="stat-chip-val">9</div>
                                <div class="stat-chip-lbl">Berhasil</div>
                            </div>
                        </div>
                        <div class="stat-chip">
                            <div class="stat-chip-icon">⏳</div>
                            <div>
                                <div class="stat-chip-val">2</div>
                                <div class="stat-chip-lbl">Akan Datang</div>
                            </div>
                        </div>
                        <div class="stat-chip">
                            <div class="stat-chip-icon">💰</div>
                            <div>
                                <div class="stat-chip-val">Rp 3,8jt</div>
                                <div class="stat-chip-lbl">Total Dibelanjakan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ FILTER BAR ═══ -->
    <div class="filter-bar">
        <div class="container">
            <div class="d-flex align-items-center gap-3 flex-wrap gap-md-4">
                <div class="filter-tabs" id="status-tabs">
                    <button class="filter-tab active" onclick="filterOrders(this,'all')">Semua <span
                            class="tab-count">12</span></button>
                    <button class="filter-tab" onclick="filterOrders(this,'upcoming')">Akan Datang <span
                            class="tab-count">2</span></button>
                    <button class="filter-tab" onclick="filterOrders(this,'success')">Berhasil <span
                            class="tab-count">7</span></button>
                    <button class="filter-tab" onclick="filterOrders(this,'used')">Sudah Dipakai <span
                            class="tab-count">2</span></button>
                    <button class="filter-tab" onclick="filterOrders(this,'cancelled')">Dibatalkan <span
                            class="tab-count">1</span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══ MAIN CONTENT ═══ -->
    <div class="history-main">
        <div class="container">
            <div class="row g-4">

                <!-- ORDER LIST -->
                <div class="col-lg-8">

                    <!-- SEARCH + SORT -->
                    <div class="search-sort-row mb-3">
                        <div class="search-wrap">
                            <i class="bi bi-search"></i>
                            <input type="text" id="search-input" placeholder="Cari nama event atau order ID..."
                                oninput="searchOrders(this.value)" />
                        </div>
                        <select class="sort-select" onchange="sortOrders(this.value)">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="highest">Harga Tertinggi</option>
                            <option value="lowest">Harga Terendah</option>
                        </select>
                    </div>

                    <!-- ── YEAR 2025 ── -->
                    <div class="year-divider reveal"><span>2025</span></div>

                    <!-- ORDER 1: SUCCESS + UPCOMING -->
                    <div class="order-card reveal" id="order-1" data-status="upcoming"
                        data-name="Rock Uprising Live Concert" onclick="toggleOrder(this)">
                        <div class="order-card-header">
                            <div class="order-thumb" style="background:linear-gradient(135deg,#1a0533,#2d0b4e);">🎸
                            </div>
                            <div class="order-meta">
                                <div class="order-event-name">Rock Uprising Live Concert</div>
                                <div class="order-event-details">
                                    <div class="order-detail-item"><i class="bi bi-calendar3"></i> 22 Juli 2025</div>
                                    <div class="order-detail-item"><i class="bi bi-geo-alt"></i> Jakarta Convention
                                        Center</div>
                                    <div class="order-detail-item"><i class="bi bi-ticket-perforated"></i> 1× REGULAR
                                    </div>
                                </div>
                            </div>
                            <div class="order-status success">
                                <div class="status-dot-sm"></div> Aktif
                            </div>
                            <div class="order-price-col">
                                <div class="order-price">Rp 237.500</div>
                                <div class="order-price-label">EVS-2025-07-4829</div>
                            </div>
                            <i class="bi bi-chevron-down order-chevron"></i>
                        </div>
                        <!-- EXPAND -->
                        <div class="order-detail-expand">
                            <div class="order-detail-body">
                                <div>
                                    <div class="expand-section-title">E-Ticket</div>
                                    <div class="ticket-mini-expand">
                                        <div class="ticket-mini-qr">QR<br />Code</div>
                                        <div class="ticket-mini-info">
                                            <div class="t-name">Rock Uprising Live Concert</div>
                                            <div class="t-type"><i class="bi bi-ticket-perforated"></i> REGULAR</div>
                                            <div class="t-code">EVS · 4829 · REG · 0001</div>
                                        </div>
                                    </div>
                                    <div class="expand-section-title">Info Event</div>
                                    <div class="expand-row"><span class="el">Tanggal</span><span
                                            class="ev">22 Juli 2025</span></div>
                                    <div class="expand-row"><span class="el">Waktu</span><span
                                            class="ev">19.00 – 23.00 WIB</span></div>
                                    <div class="expand-row"><span class="el">Venue</span><span
                                            class="ev">Jakarta Convention Center</span></div>
                                    <div class="expand-row"><span class="el">Pintu Masuk</span><span
                                            class="ev">Gate A — Standing</span></div>
                                </div>
                                <div>
                                    <div class="expand-section-title">Detail Pembayaran</div>
                                    <div class="expand-row"><span class="el">Harga Tiket</span><span
                                            class="ev">Rp 250.000</span></div>
                                    <div class="expand-row"><span class="el">Biaya Layanan</span><span
                                            class="ev">Rp 12.500</span></div>
                                    <div class="expand-row" style="color:#6EE7B7;"><span class="el"
                                            style="color:#6EE7B7;">Diskon ROCK25</span><span class="ev"
                                            style="color:#6EE7B7;">−Rp 25.000</span></div>
                                    <hr class="expand-divider" />
                                    <div class="expand-row"><span class="el"
                                            style="font-weight:600;color:var(--cream);">Total</span><span
                                            class="ev"
                                            style="color:var(--gold-light);font-family:'Playfair Display',serif;font-size:1rem;">Rp
                                            237.500</span></div>
                                    <div class="expand-row"><span class="el">Metode Bayar</span><span
                                            class="ev">Transfer BCA</span></div>
                                    <div class="expand-row"><span class="el">Tanggal Beli</span><span
                                            class="ev">10 Jun 2025, 14:32</span></div>
                                </div>
                            </div>
                            <div class="order-actions">
                                <a href="success.html" class="act-btn primary"><i class="bi bi-download"></i> Unduh
                                    Tiket</a>
                                <button class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-qr-code"></i> Lihat QR</button>
                                <button class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-calendar-plus"></i> Tambah ke Kalender</button>
                                <button class="act-btn danger ms-auto" onclick="event.stopPropagation()"><i
                                        class="bi bi-arrow-counterclockwise"></i> Minta Refund</button>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER 2: UPCOMING -->
                    <div class="order-card reveal" id="order-2" data-status="upcoming"
                        data-name="Indonesia Tech Summit 2025" onclick="toggleOrder(this)">
                        <div class="order-card-header">
                            <div class="order-thumb" style="background:linear-gradient(135deg,#001a33,#003366);">💻
                            </div>
                            <div class="order-meta">
                                <div class="order-event-name">Indonesia Tech Summit 2025</div>
                                <div class="order-event-details">
                                    <div class="order-detail-item"><i class="bi bi-calendar3"></i> 5–6 Agustus 2025
                                    </div>
                                    <div class="order-detail-item"><i class="bi bi-geo-alt"></i> Bali Nusa Dua
                                        Convention</div>
                                    <div class="order-detail-item"><i class="bi bi-ticket-perforated"></i> 2× VIP
                                    </div>
                                </div>
                            </div>
                            <div class="order-status success">
                                <div class="status-dot-sm"></div> Aktif
                            </div>
                            <div class="order-price-col">
                                <div class="order-price">Rp 1.050.000</div>
                                <div class="order-price-label">EVS-2025-08-1102</div>
                            </div>
                            <i class="bi bi-chevron-down order-chevron"></i>
                        </div>
                        <div class="order-detail-expand">
                            <div class="order-detail-body">
                                <div>
                                    <div class="expand-section-title">E-Ticket (2 tiket)</div>
                                    <div class="ticket-mini-expand">
                                        <div class="ticket-mini-qr">QR<br />Code</div>
                                        <div class="ticket-mini-info">
                                            <div class="t-name">Indonesia Tech Summit 2025</div>
                                            <div class="t-type"><i class="bi bi-ticket-perforated"></i> VIP — Tiket 1
                                            </div>
                                            <div class="t-code">EVS · 1102 · VIP · 0001</div>
                                        </div>
                                    </div>
                                    <div class="ticket-mini-expand">
                                        <div class="ticket-mini-qr">QR<br />Code</div>
                                        <div class="ticket-mini-info">
                                            <div class="t-name">Indonesia Tech Summit 2025</div>
                                            <div class="t-type"><i class="bi bi-ticket-perforated"></i> VIP — Tiket 2
                                            </div>
                                            <div class="t-code">EVS · 1102 · VIP · 0002</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="expand-section-title">Detail Pembayaran</div>
                                    <div class="expand-row"><span class="el">VIP × 2</span><span
                                            class="ev">Rp 1.000.000</span></div>
                                    <div class="expand-row"><span class="el">Biaya Layanan</span><span
                                            class="ev">Rp 50.000</span></div>
                                    <hr class="expand-divider" />
                                    <div class="expand-row"><span class="el"
                                            style="font-weight:600;color:var(--cream);">Total</span><span
                                            class="ev"
                                            style="color:var(--gold-light);font-family:'Playfair Display',serif;font-size:1rem;">Rp
                                            1.050.000</span></div>
                                    <div class="expand-row"><span class="el">Metode Bayar</span><span
                                            class="ev">QRIS GoPay</span></div>
                                    <div class="expand-row"><span class="el">Tanggal Beli</span><span
                                            class="ev">2 Jul 2025, 09:15</span></div>
                                </div>
                            </div>
                            <div class="order-actions">
                                <a href="success.html" class="act-btn primary"><i class="bi bi-download"></i> Unduh 2
                                    Tiket</a>
                                <button class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-share"></i> Bagikan</button>
                                <button class="act-btn danger ms-auto" onclick="event.stopPropagation()"><i
                                        class="bi bi-arrow-counterclockwise"></i> Minta Refund</button>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER 3: PENDING PAYMENT -->
                    <div class="order-card reveal" id="order-3" data-status="pending"
                        data-name="Pameran Seni Rupa Kontemporer Nusantara" onclick="toggleOrder(this)">
                        <div class="order-card-header">
                            <div class="order-thumb" style="background:linear-gradient(135deg,#1a1200,#332800);">🎨
                            </div>
                            <div class="order-meta">
                                <div class="order-event-name">Pameran Seni Rupa Kontemporer Nusantara</div>
                                <div class="order-event-details">
                                    <div class="order-detail-item"><i class="bi bi-calendar3"></i> 1 Agustus 2025
                                    </div>
                                    <div class="order-detail-item"><i class="bi bi-geo-alt"></i> Galeri Nasional,
                                        Jakarta</div>
                                    <div class="order-detail-item"><i class="bi bi-ticket-perforated"></i> 3× REGULAR
                                    </div>
                                </div>
                            </div>
                            <div class="order-status pending">
                                <div class="status-dot-sm"></div> Menunggu Bayar
                            </div>
                            <div class="order-price-col">
                                <div class="order-price">Rp 236.250</div>
                                <div class="order-price-label">EVS-2025-08-3341</div>
                            </div>
                            <i class="bi bi-chevron-down order-chevron"></i>
                        </div>
                        <div class="order-detail-expand">
                            <div class="order-detail-body">
                                <div>
                                    <div class="expand-section-title">Info Pembayaran</div>
                                    <div
                                        style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.2);border-radius:8px;padding:1rem;margin-bottom:1rem;">
                                        <div
                                            style="font-size:0.8rem;color:#FCD34D;font-weight:600;margin-bottom:0.5rem;">
                                            ⚠ Selesaikan pembayaran dalam</div>
                                        <div style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700;color:#FCD34D;"
                                            id="pending-timer">01:42:18</div>
                                        <div style="font-size:0.75rem;color:var(--mist);margin-top:0.3rem;">Order akan
                                            otomatis dibatalkan jika tidak dibayar</div>
                                    </div>
                                    <div class="expand-row"><span class="el">Bank</span><span
                                            class="ev">BNI</span></div>
                                    <div class="expand-row"><span class="el">Nomor Rekening</span><span
                                            class="ev" style="font-family:monospace;">4567 8901 2345</span></div>
                                    <div class="expand-row"><span class="el">Total Transfer</span><span
                                            class="ev" style="color:var(--gold-light);font-weight:700;">Rp
                                            236.250</span></div>
                                </div>
                                <div>
                                    <div class="expand-section-title">Detail Pesanan</div>
                                    <div class="expand-row"><span class="el">REGULAR × 3</span><span
                                            class="ev">Rp 225.000</span></div>
                                    <div class="expand-row"><span class="el">Biaya Layanan</span><span
                                            class="ev">Rp 11.250</span></div>
                                    <hr class="expand-divider" />
                                    <div class="expand-row"><span class="el"
                                            style="font-weight:600;color:var(--cream);">Total</span><span
                                            class="ev"
                                            style="color:var(--gold-light);font-family:'Playfair Display',serif;font-size:1rem;">Rp
                                            236.250</span></div>
                                    <div class="expand-row"><span class="el">Tanggal Order</span><span
                                            class="ev">8 Jul 2025, 20:00</span></div>
                                </div>
                            </div>
                            <div class="order-actions">
                                <button class="act-btn primary" onclick="event.stopPropagation()"><i
                                        class="bi bi-credit-card"></i> Bayar Sekarang</button>
                                <button class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-clipboard"></i> Salin No. Rekening</button>
                                <button class="act-btn danger ms-auto" onclick="event.stopPropagation()"><i
                                        class="bi bi-x-circle"></i> Batalkan Order</button>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER 4: USED -->
                    <div class="order-card reveal" id="order-4" data-status="used"
                        data-name="Jakarta International Marathon 2025" onclick="toggleOrder(this)">
                        <div class="order-card-header">
                            <div class="order-thumb" style="background:linear-gradient(135deg,#001a00,#003300);">🏃
                            </div>
                            <div class="order-meta">
                                <div class="order-event-name">Jakarta International Marathon 2025</div>
                                <div class="order-event-details">
                                    <div class="order-detail-item"><i class="bi bi-calendar3"></i> 20 Sep 2024</div>
                                    <div class="order-detail-item"><i class="bi bi-geo-alt"></i> Monas, Jakarta</div>
                                    <div class="order-detail-item"><i class="bi bi-ticket-perforated"></i> 1× REGULAR
                                    </div>
                                </div>
                            </div>
                            <div class="order-status used">
                                <div class="status-dot-sm"></div> Selesai
                            </div>
                            <div class="order-price-col">
                                <div class="order-price">Rp 157.500</div>
                                <div class="order-price-label">EVS-2024-09-8812</div>
                            </div>
                            <i class="bi bi-chevron-down order-chevron"></i>
                        </div>
                        <div class="order-detail-expand">
                            <div class="order-detail-body">
                                <div>
                                    <div class="expand-section-title">Tiket Sudah Digunakan</div>
                                    <div
                                        style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:8px;padding:1rem;text-align:center;margin-bottom:1rem;">
                                        <i class="bi bi-check-circle"
                                            style="font-size:2rem;color:var(--success);"></i>
                                        <div style="font-size:0.85rem;color:var(--mist);margin-top:0.5rem;">Tiket
                                            di-scan pada 20 Sep 2024, 05:45</div>
                                    </div>
                                    <div class="expand-row"><span class="el">Event</span><span
                                            class="ev">Jakarta International Marathon</span></div>
                                    <div class="expand-row"><span class="el">Kategori</span><span
                                            class="ev">10K Run</span></div>
                                    <div class="expand-row"><span class="el">Bib Number</span><span
                                            class="ev" style="font-family:monospace;">#4829</span></div>
                                </div>
                                <div>
                                    <div class="expand-section-title">Detail Pembayaran</div>
                                    <div class="expand-row"><span class="el">Harga Tiket</span><span
                                            class="ev">Rp 150.000</span></div>
                                    <div class="expand-row"><span class="el">Biaya Layanan</span><span
                                            class="ev">Rp 7.500</span></div>
                                    <hr class="expand-divider" />
                                    <div class="expand-row"><span class="el"
                                            style="font-weight:600;color:var(--cream);">Total</span><span
                                            class="ev"
                                            style="color:var(--gold-light);font-family:'Playfair Display',serif;font-size:1rem;">Rp
                                            157.500</span></div>
                                </div>
                            </div>
                            <div class="order-actions">
                                <button class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-download"></i> Unduh Tiket</button>
                                <button class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-star"></i> Beri Ulasan</button>
                                <a href="index.html" class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-arrow-repeat"></i> Beli Lagi</a>
                            </div>
                        </div>
                    </div>

                    <!-- ── YEAR 2024 ── -->
                    <div class="year-divider reveal"><span>2024</span></div>

                    <!-- ORDER 5: USED -->
                    <div class="order-card reveal" id="order-5" data-status="used"
                        data-name="Grand Music Festival Nusantara 2024" onclick="toggleOrder(this)">
                        <div class="order-card-header">
                            <div class="order-thumb" style="background:linear-gradient(135deg,#1a1200,#332800);">🎵
                            </div>
                            <div class="order-meta">
                                <div class="order-event-name">Grand Music Festival Nusantara 2024</div>
                                <div class="order-event-details">
                                    <div class="order-detail-item"><i class="bi bi-calendar3"></i> 17 Agt 2024</div>
                                    <div class="order-detail-item"><i class="bi bi-geo-alt"></i> Stadion GBK, Jakarta
                                    </div>
                                    <div class="order-detail-item"><i class="bi bi-ticket-perforated"></i> 2× VIP
                                    </div>
                                </div>
                            </div>
                            <div class="order-status used">
                                <div class="status-dot-sm"></div> Selesai
                            </div>
                            <div class="order-price-col">
                                <div class="order-price">Rp 1.050.000</div>
                                <div class="order-price-label">EVS-2024-08-5542</div>
                            </div>
                            <i class="bi bi-chevron-down order-chevron"></i>
                        </div>
                        <div class="order-detail-expand">
                            <div class="order-detail-body">
                                <div>
                                    <div class="expand-section-title">Status Tiket</div>
                                    <div
                                        style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:8px;padding:1rem;text-align:center;margin-bottom:1rem;">
                                        <i class="bi bi-check-circle"
                                            style="font-size:2rem;color:var(--success);"></i>
                                        <div style="font-size:0.85rem;color:var(--mist);margin-top:0.5rem;">2 tiket
                                            di-scan pada 17 Agt 2024</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="expand-section-title">Pembayaran</div>
                                    <div class="expand-row"><span class="el">VIP × 2</span><span
                                            class="ev">Rp 1.000.000</span></div>
                                    <div class="expand-row"><span class="el">Biaya Layanan</span><span
                                            class="ev">Rp 50.000</span></div>
                                    <hr class="expand-divider" />
                                    <div class="expand-row"><span class="el"
                                            style="font-weight:600;color:var(--cream);">Total</span><span
                                            class="ev"
                                            style="color:var(--gold-light);font-family:'Playfair Display',serif;font-size:1rem;">Rp
                                            1.050.000</span></div>
                                </div>
                            </div>
                            <div class="order-actions">
                                <button class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-star"></i> Beri Ulasan</button>
                                <a href="detail.html" class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-arrow-repeat"></i> Beli Lagi</a>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER 6: CANCELLED -->
                    <div class="order-card reveal" id="order-6" data-status="cancelled"
                        data-name="Workshop AI Future of Work 2024" onclick="toggleOrder(this)">
                        <div class="order-card-header">
                            <div class="order-thumb"
                                style="background:linear-gradient(135deg,#1a001a,#330033);opacity:0.6;">📚</div>
                            <div class="order-meta">
                                <div class="order-event-name" style="opacity:0.6;">Workshop AI Future of Work 2024
                                </div>
                                <div class="order-event-details">
                                    <div class="order-detail-item" style="opacity:0.5;"><i
                                            class="bi bi-calendar3"></i> 18 Mar 2024</div>
                                    <div class="order-detail-item" style="opacity:0.5;"><i class="bi bi-geo-alt"></i>
                                        Digital Hub Surabaya</div>
                                    <div class="order-detail-item" style="opacity:0.5;"><i
                                            class="bi bi-ticket-perforated"></i> 1× REGULER</div>
                                </div>
                            </div>
                            <div class="order-status cancelled">
                                <div class="status-dot-sm"></div> Dibatalkan
                            </div>
                            <div class="order-price-col" style="opacity:0.6;">
                                <div class="order-price" style="text-decoration:line-through;font-size:1rem;">Rp
                                    472.500</div>
                                <div class="order-price-label">EVS-2024-03-2291</div>
                            </div>
                            <i class="bi bi-chevron-down order-chevron"></i>
                        </div>
                        <div class="order-detail-expand">
                            <div class="order-detail-body">
                                <div>
                                    <div class="expand-section-title">Alasan Pembatalan</div>
                                    <div
                                        style="background:rgba(239,68,68,0.07);border:1px solid rgba(239,68,68,0.15);border-radius:8px;padding:1rem;">
                                        <div
                                            style="font-size:0.8rem;color:#FCA5A5;font-weight:600;margin-bottom:0.25rem;">
                                            <i class="bi bi-x-circle"></i> Dibatalkan oleh Anda</div>
                                        <div style="font-size:0.78rem;color:var(--mist);">15 Mar 2024, 11:22 — Refund
                                            Rp 450.000 diproses dalam 5 hari kerja</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="expand-section-title">Rincian Refund</div>
                                    <div class="expand-row"><span class="el">Total Dibayar</span><span
                                            class="ev">Rp 472.500</span></div>
                                    <div class="expand-row"><span class="el">Biaya Pembatalan (5%)</span><span
                                            class="ev" style="color:#FCA5A5;">−Rp 22.500</span></div>
                                    <hr class="expand-divider" />
                                    <div class="expand-row"><span class="el"
                                            style="color:#6EE7B7;font-weight:600;">Refund Diterima</span><span
                                            class="ev" style="color:#6EE7B7;">Rp 450.000</span></div>
                                    <div class="expand-row"><span class="el">Via</span><span
                                            class="ev">Transfer BCA</span></div>
                                </div>
                            </div>
                            <div class="order-actions">
                                <button class="act-btn outline" onclick="event.stopPropagation()"><i
                                        class="bi bi-headset"></i> Hubungi Support</button>
                                <a href="detail.html" class="act-btn outline ms-auto"
                                    onclick="event.stopPropagation()"><i class="bi bi-arrow-repeat"></i> Beli Lagi</a>
                            </div>
                        </div>
                    </div>

                    <!-- EMPTY STATE -->
                    <div class="empty-state" id="empty-state">
                        <div class="empty-icon">🎟️</div>
                        <div class="empty-title">Tidak Ada Pesanan</div>
                        <div class="empty-sub">Belum ada pesanan yang cocok dengan filter yang dipilih</div>
                        <a href="index.html" class="btn-primary-gold">Jelajahi Events</a>
                    </div>

                    <!-- PAGINATION -->
                    <div class="pagination-wrap reveal">
                        <button class="page-btn"><i class="bi bi-chevron-left"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
                    </div>

                </div><!-- /ORDER LIST -->

                <!-- SIDEBAR -->
                <div class="col-lg-4">
                    <div class="profile-card">
                        <div class="profile-card-header">
                            <div class="profile-avatar">RK</div>
                            <div class="profile-name">Reza Kurniawan</div>
                            <div class="profile-email">reza@email.com</div>
                            <div class="member-badge"><i class="bi bi-star-fill"></i> Premium Member</div>
                        </div>

                        <div class="profile-stats">
                            <div class="profile-stat">
                                <div class="profile-stat-val">12</div>
                                <div class="profile-stat-lbl">Events</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-val">9</div>
                                <div class="profile-stat-lbl">Tiket</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-val">4.9</div>
                                <div class="profile-stat-lbl">Rating</div>
                            </div>
                        </div>

                        <div class="profile-menu">
                            <a href="#" class="profile-menu-item"><i class="bi bi-person"></i> Profil Saya</a>
                            <div class="profile-menu-item active"><i class="bi bi-receipt"></i> Riwayat Pemesanan
                            </div>
                            <a href="#" class="profile-menu-item"><i class="bi bi-heart"></i> Wishlist</a>
                            <a href="#" class="profile-menu-item"><i class="bi bi-bell"></i> Notifikasi</a>
                            <a href="#" class="profile-menu-item"><i class="bi bi-shield-check"></i>
                                Keamanan</a>
                            <a href="#" class="profile-menu-item"><i class="bi bi-credit-card"></i> Metode
                                Pembayaran</a>
                            <hr style="border-color:rgba(255,255,255,0.06);margin:0.5rem 1.5rem;" />
                            <a href="index.html" class="profile-menu-item"><i class="bi bi-grid"></i> Jelajahi
                                Events</a>
                            <a href="#" class="profile-menu-item" style="color:#FCA5A5;"><i
                                    class="bi bi-box-arrow-right"></i> Keluar</a>
                        </div>
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
                <div class="footer-copy">© 2025 EventSphere. All rights reserved.</div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ── TOGGLE ORDER EXPAND ──
        function toggleOrder(card) {
            const wasExpanded = card.classList.contains('expanded');
            document.querySelectorAll('.order-card.expanded').forEach(c => c.classList.remove('expanded'));
            if (!wasExpanded) card.classList.add('expanded');
        }

        // ── FILTER TABS ──
        function filterOrders(btn, status) {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');

            const orders = document.querySelectorAll('.order-card');
            const yearDividers = document.querySelectorAll('.year-divider');
            let visibleCount = 0;

            orders.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                const show = status === 'all' || cardStatus === status ||
                    (status === 'success' && (cardStatus === 'success' || cardStatus === 'refunded'));
                card.style.display = show ? 'block' : 'none';
                if (show) visibleCount++;
            });

            // Year dividers visibility
            yearDividers.forEach(div => {
                let nextSibling = div.nextElementSibling;
                let hasVisible = false;
                while (nextSibling && !nextSibling.classList.contains('year-divider')) {
                    if (nextSibling.classList.contains('order-card') && nextSibling.style.display !== 'none') {
                        hasVisible = true;
                        break;
                    }
                    nextSibling = nextSibling.nextElementSibling;
                }
                div.style.display = hasVisible ? 'flex' : 'none';
            });

            document.getElementById('empty-state').classList.toggle('show', visibleCount === 0);
        }

        // ── SEARCH ──
        function searchOrders(query) {
            const q = query.toLowerCase();
            const orders = document.querySelectorAll('.order-card');
            let visibleCount = 0;

            orders.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                const orderId = card.querySelector('.order-price-label')?.textContent.toLowerCase() || '';
                const show = name.includes(q) || orderId.includes(q);
                card.style.display = show ? 'block' : 'none';
                if (show) visibleCount++;
            });

            document.getElementById('empty-state').classList.toggle('show', visibleCount === 0);
        }

        // ── SORT ──
        function sortOrders(val) {
            const container = document.querySelector('.col-lg-8');
            const yearDivs = Array.from(document.querySelectorAll('.year-divider'));
            const orderCards = Array.from(document.querySelectorAll('.order-card'));

            // Simple visual feedback for now
            // (Full sort implementation would reorder DOM nodes)
            console.log('Sort by:', val);
        }

        // ── PENDING TIMER ──
        let pendingSeconds = 6138; // ~1h 42m 18s
        const timerEl = document.getElementById('pending-timer');

        function updatePendingTimer() {
            if (!timerEl || pendingSeconds <= 0) return;
            pendingSeconds--;
            const h = Math.floor(pendingSeconds / 3600);
            const m = Math.floor((pendingSeconds % 3600) / 60);
            const s = pendingSeconds % 60;
            timerEl.textContent =
                String(h).padStart(2, '0') + ':' +
                String(m).padStart(2, '0') + ':' +
                String(s).padStart(2, '0');
        }
        setInterval(updatePendingTimer, 1000);

        // ── SCROLL REVEAL ──
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver(entries => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    setTimeout(() => e.target.classList.add('visible'), i * 60);
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.08
        });
        reveals.forEach(el => observer.observe(el));

        // ── PAGINATION ──
        document.querySelectorAll('.page-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.querySelector('i')) return;
                document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Auto-open first card
        setTimeout(() => {
            const firstCard = document.getElementById('order-1');
            if (firstCard) firstCard.classList.add('expanded');
        }, 800);
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
