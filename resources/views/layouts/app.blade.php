<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Aplikasi Burnout')</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bl9 : #0d2d6b;
            --bl7 : #1a4fad;
            --bl5 : #2872e8;
            --bl4 : #4d8ef5;
            --bl1 : #dce8fd;
            --bl0 : #f0f5ff;
            --wh  : #ffffff;
            --g1  : #f4f6fb;
            --g2  : #e8ecf4;
            --g4  : #9aa3b8;
            --g6  : #5a6278;
            --g8  : #2c3249;
            --nav-h : 64px;
            --tr : 0.2s cubic-bezier(.4,0,.2,1);
        }

        html, body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            background: var(--g1);
            color: var(--g8);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ─────────────────────────────────────────────── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            height: var(--nav-h);
            background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 60%, var(--bl5) 100%);
            border-bottom: none;
            box-shadow: 0 4px 24px rgba(13,45,107,0.28);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            gap: 1.5rem;
            position: relative;
        }

        /* Subtle wave sheen on navbar */
        .navbar::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                rgba(255,255,255,0.04) 0%,
                rgba(255,255,255,0.08) 40%,
                rgba(255,255,255,0.02) 100%);
            pointer-events: none;
        }

        .navbar__logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        /* Logo wrapper — white background to separate blue logo from blue navbar */
        .navbar__logo-img-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .navbar__logo-img {
            height: 30px;
            width: auto;
            display: block;
            object-fit: contain;
            /* HAPUS filter invert — biarkan logo tampil warna aslinya di atas bg putih */
        }

        .navbar__logo-text {
            font-size: 1rem;
            font-weight: 800;
            color: var(--wh);
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .navbar__logo-text span {
            display: block;
            font-size: 0.63rem;
            font-weight: 500;
            color: rgba(255,255,255,0.60);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .navbar__menu {
            display: flex;
            align-items: center;
            gap: 0.15rem;
            flex: 1;
            list-style: none;
            position: relative;
            z-index: 1;
        }

        .navbar__menu a {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.42em 0.9em;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: rgba(255,255,255,0.78);
            text-decoration: none;
            transition: background var(--tr), color var(--tr);
            white-space: nowrap;
        }

        .navbar__menu a:hover {
            background: rgba(255,255,255,0.14);
            color: var(--wh);
        }
        .navbar__menu a.active {
            background: rgba(255,255,255,0.20);
            color: var(--wh);
        }

        .navbar__menu a svg {
            width: 16px; height: 16px;
            flex-shrink: 0;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .navbar__guest {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        .navbar__btn-login {
            display: inline-flex;
            align-items: center;
            padding: 0.45em 1.1em;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            color: var(--wh);
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(255,255,255,0.30);
            transition: background var(--tr), border-color var(--tr);
        }
        .navbar__btn-login:hover {
            background: rgba(255,255,255,0.22);
            border-color: rgba(255,255,255,0.50);
            color: var(--wh);
        }

        .navbar__btn-register {
            display: inline-flex;
            align-items: center;
            padding: 0.45em 1.1em;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            color: var(--bl9);
            background: var(--wh);
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
        }
        .navbar__btn-register:hover {
            background: var(--bl0);
            box-shadow: 0 4px 16px rgba(0,0,0,0.20);
            transform: translateY(-1px);
            color: var(--bl9);
        }

        .navbar__spacer { flex: 1; }

        .navbar__user {
            position: relative;
            flex-shrink: 0;
            z-index: 1;
        }

        .navbar__user-btn {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.32em 0.75em 0.32em 0.32em;
            border-radius: 999px;
            border: 1.5px solid rgba(255,255,255,0.25);
            background: rgba(255,255,255,0.12);
            cursor: pointer;
            transition: border-color var(--tr), background var(--tr);
        }
        .navbar__user-btn:hover {
            border-color: rgba(255,255,255,0.45);
            background: rgba(255,255,255,0.20);
        }

        .navbar__avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            border: 1.5px solid rgba(255,255,255,0.40);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--wh);
            flex-shrink: 0;
            text-transform: uppercase;
            overflow: hidden;
        }
        .navbar__avatar img { width: 100%; height: 100%; object-fit: cover; }

        .navbar__user-info { line-height: 1.2; text-align: left; }

        .navbar__user-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--wh);
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .navbar__user-role {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.60);
            font-weight: 500;
            text-transform: capitalize;
        }

        .navbar__chevron {
            width: 14px; height: 14px;
            stroke: rgba(255,255,255,0.70);
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: transform var(--tr);
            flex-shrink: 0;
        }
        .navbar__user.open .navbar__chevron { transform: rotate(180deg); }

        .navbar__dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            min-width: 200px;
            background: var(--wh);
            border: 1px solid var(--g2);
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(13,45,107,0.18);
            padding: 0.5rem;
            z-index: 200;
        }
        .navbar__user.open .navbar__dropdown {
            display: block;
            animation: dropIn 0.18s ease;
        }

        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .navbar__dropdown-header {
            padding: 0.6rem 0.75rem 0.75rem;
            border-bottom: 1px solid var(--g2);
            margin-bottom: 0.4rem;
        }
        .navbar__dropdown-header strong { display: block; font-size: 0.85rem; font-weight: 700; color: var(--g8); }
        .navbar__dropdown-header small  { font-size: 0.75rem; color: var(--g4); }

        .navbar__dropdown a,
        .navbar__dropdown button {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            width: 100%;
            padding: 0.55em 0.75em;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--g6);
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            transition: background var(--tr), color var(--tr);
            font-family: inherit;
        }
        .navbar__dropdown a:hover,
        .navbar__dropdown button:hover { background: var(--bl0); color: var(--bl5); }

        .navbar__dropdown a svg,
        .navbar__dropdown button svg {
            width: 15px; height: 15px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        .navbar__dropdown .divider { height: 1px; background: var(--g2); margin: 0.4rem 0; }
        .navbar__dropdown .logout-btn { color: #dc2626; }
        .navbar__dropdown .logout-btn:hover { background: #fee2e2; color: #b91c1c; }

        .navbar__hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            border: none;
            background: rgba(255,255,255,0.12);
            margin-left: auto;
            position: relative;
            z-index: 1;
        }
        .navbar__hamburger span {
            display: block;
            width: 22px; height: 2px;
            background: var(--wh);
            border-radius: 2px;
            transition: transform var(--tr), opacity var(--tr);
        }

        .navbar__mobile {
            display: none;
            position: fixed;
            top: var(--nav-h);
            left: 0; right: 0;
            background: var(--wh);
            border-bottom: 1px solid var(--bl1);
            box-shadow: 0 4px 24px rgba(13,45,107,0.14);
            padding: 1rem;
            z-index: 99;
            flex-direction: column;
            gap: 0.25rem;
        }
        .navbar__mobile.open { display: flex; }

        .navbar__mobile a {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.65em 1em;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--g6);
            text-decoration: none;
            transition: background var(--tr), color var(--tr);
        }
        .navbar__mobile a:hover,
        .navbar__mobile a.active { background: var(--bl0); color: var(--bl5); }

        .navbar__mobile a svg {
            width: 17px; height: 17px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .navbar__mobile .mob-divider { height: 1px; background: var(--g2); margin: 0.4rem 0; }
        .navbar__mobile .mob-logout  { color: #dc2626; }
        .navbar__mobile .mob-logout:hover { background: #fee2e2; color: #b91c1c; }

        /* ── MAIN CONTENT ───────────────────────────────────────── */
        .app-main {
            flex: 1;
            min-height: calc(100vh - var(--nav-h));
        }

        .app-main.app-main--inner {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* ── FOOTER ─────────────────────────────────────────────── */
        .app-footer {
            background: var(--wh);
            border-top: 1px solid var(--g2);
            padding: 2rem 2rem 1.5rem;
        }

        .app-footer__top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .app-footer__brand {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .app-footer__brand-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .app-footer__logo-img {
            height: 28px;
            width: auto;
            object-fit: contain;
        }

        .app-footer__brand-name {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--g8);
            letter-spacing: -0.01em;
        }
        .app-footer__brand-name span { color: var(--bl5); }

        .app-footer__email {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.82rem;
            color: var(--g6);
            text-decoration: none;
            transition: color var(--tr);
        }
        .app-footer__email:hover { color: var(--bl5); }
        .app-footer__email svg {
            width: 15px; height: 15px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        .app-footer__contact {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .app-footer__contact-title {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--g6);
            margin-bottom: 0.25rem;
        }

        .app-footer__contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.82rem;
            color: var(--g6);
            text-decoration: none;
            transition: color var(--tr);
        }
        .app-footer__contact-item:hover { color: var(--bl5); }

        .app-footer__contact-item svg {
            width: 15px; height: 15px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        .app-footer__contact-item.instagram svg {
            stroke: none;
            fill: currentColor;
        }

        .app-footer__bottom {
            border-top: 1px solid var(--g2);
            padding-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .app-footer__copy {
            font-size: 0.75rem;
            color: var(--g4);
            text-align: center;
        }

        /* ── RESPONSIVE ─────────────────────────────────────────── */
        @media (max-width: 768px) {
            .navbar { padding: 0 1rem; }
            .navbar__menu, .navbar__spacer, .navbar__user { display: none; }
            .navbar__guest { display: none; }
            .navbar__hamburger { display: flex; }

            .app-main.app-main--inner { padding: 1.25rem 1rem; }

            .app-footer__top {
                flex-direction: column;
                gap: 1.5rem;
            }
            .app-footer { padding: 1.5rem 1.25rem 1rem; }
        }

        @media (min-width: 769px) {
            .navbar__mobile { display: none !important; }
        }
    </style>

    @yield('styles')
</head>
<body>

    {{-- ── NAVBAR ────────────────────────────────────────────── --}}
    <nav class="navbar">

        <a href="{{ url('/') }}" class="navbar__logo">
            {{-- Logo wrapper: ring putih tipis agar logo biru tidak tenggelam di bg biru --}}
            <div class="navbar__logo-img-wrap">
                <img src="{{ asset('images/burnout.png') }}"
                     alt="BurnoutCheck Logo"
                     class="navbar__logo-img">
            </div>
            <div class="navbar__logo-text">
                BurnoutCheck
                <span>Sistem Deteksi Burnout</span>
            </div>
        </a>

        <ul class="navbar__menu">
            @auth
                @if (auth()->user()->role === 'mahasiswa')
                    <li>
                        <a href="{{ route('mahasiswa.dashboard') }}"
                           class="{{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.tes.index') }}"
                           class="{{ request()->routeIs('mahasiswa.tes.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                            Mulai Tes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswa.history') }}"
                           class="{{ request()->routeIs('mahasiswa.history') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Riwayat
                        </a>
                    </li>

                @elseif (auth()->user()->role === 'dosen')
                    <li>
                        <a href="{{ route('dosen.dashboard') }}"
                           class="{{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dosen.mahasiswa') }}"
                           class="{{ request()->routeIs('dosen.mahasiswa') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                            Data Mahasiswa
                        </a>
                    </li>

                @elseif (auth()->user()->role === 'kaprodi')
                    <li>
                        <a href="{{ route('kaprodi.dashboard') }}"
                           class="{{ request()->routeIs('kaprodi.dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kaprodi.statistik') }}"
                           class="{{ request()->routeIs('kaprodi.statistik') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                            Statistik
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kaprodi.mahasiswa-bimbingan') }}"
                        class="{{ request()->routeIs('kaprodi.mahasiswa-bimbingan') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                                <path d="M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                            Mahasiswa Bimbingan
                        </a>
                    </li>


                @elseif (auth()->user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                           class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.soal.index') }}"
                           class="{{ request()->routeIs('admin.soal.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            Soal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.risk-levels.index') }}"
                           class="{{ request()->routeIs('admin.risk-levels.*') ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            Level Risiko
                        </a>
                    </li>
                @endif
            @endauth
        </ul>

        <div class="navbar__spacer"></div>

        @guest
        <div class="navbar__guest">
            <a href="{{ route('login') }}" class="navbar__btn-login">Login</a>
            <a href="{{ route('register') }}" class="navbar__btn-register">Daftar</a>
        </div>
        @endguest

        @auth
        <div class="navbar__user" id="userDropdown">
            <button class="navbar__user-btn" onclick="toggleDropdown()" type="button">
                <div class="navbar__avatar">
                    @if (auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                             alt="{{ auth()->user()->name }}">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    @endif
                </div>
                <div class="navbar__user-info">
                    <div class="navbar__user-name">{{ auth()->user()->name }}</div>
                    <div class="navbar__user-role">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
                <svg class="navbar__chevron" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </button>

            <div class="navbar__dropdown">
                <div class="navbar__dropdown-header">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>{{ auth()->user()->email }}</small>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
        @endauth

        <button class="navbar__hamburger" id="hamburger" onclick="toggleMobile()" type="button">
            <span></span><span></span><span></span>
        </button>
    </nav>

    {{-- Mobile nav drawer --}}
    @auth
    <div class="navbar__mobile" id="mobileNav">
        @if (auth()->user()->role === 'mahasiswa')
            <a href="{{ route('mahasiswa.dashboard') }}" class="{{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <a href="{{ route('mahasiswa.tes.index') }}">
                <svg viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                Mulai Tes
            </a>
            <a href="{{ route('mahasiswa.history') }}">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Riwayat
            </a>
        @elseif (auth()->user()->role === 'dosen')
            <a href="{{ route('dosen.dashboard') }}">Dashboard</a>
            <a href="{{ route('dosen.mahasiswa') }}">Data Mahasiswa</a>
        @elseif (auth()->user()->role === 'kaprodi')
            <a href="{{ route('kaprodi.dashboard') }}">Dashboard</a>
            <a href="{{ route('kaprodi.statistik') }}">Statistik</a>
            <a href="{{ route('kaprodi.mahasiswa-bimbingan') }}">Mahasiswa Bimbingan</a>
        @elseif (auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.users.index') }}">Users</a>
            <a href="{{ route('admin.soal.index') }}">Soal</a>
            <a href="{{ route('admin.risk-levels.index') }}">Level Risiko</a>
        @endif

        <div class="mob-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="display:flex;align-items:center;gap:.6rem;width:100%;padding:.65em 1em;border-radius:10px;font-size:.9rem;font-weight:600;color:#dc2626;background:none;border:none;cursor:pointer;font-family:inherit;">
                <svg viewBox="0 0 24 24" style="width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
    @endauth

    {{-- ── MAIN CONTENT ──────────────────────────────────────── --}}
    <main class="app-main @yield('main_class', 'app-main--inner')">
        @yield('content')
    </main>

    {{-- ── FOOTER ────────────────────────────────────────────── --}}
    <footer class="app-footer">
        <div class="app-footer__top">

            <div class="app-footer__brand">
                <a href="{{ url('/') }}" class="app-footer__brand-logo">
                    <img src="{{ asset('images/burnout.png') }}"
                         alt="BurnoutCheck Logo"
                         class="app-footer__logo-img">
                    <span class="app-footer__brand-name">Burnout<span>Check</span></span>
                </a>
                <a href="mailto:violasalwa2004@gmail.com" class="app-footer__email">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    violasalwa2004@gmail.com
                </a>
            </div>

            <div class="app-footer__contact">
                <p class="app-footer__contact-title">Contact Us!</p>

                <a href="https://wa.me/629560048682"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="app-footer__contact-item">
                    <svg viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.857L.057 23.516a.75.75 0 00.927.927l5.663-1.476A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.698-.504-5.243-1.385l-.376-.217-3.862 1.006 1.006-3.842-.225-.385A9.956 9.956 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                    </svg>
                    +62 895-6004-08682
                </a>

                <a href="https://instagram.com/violasalwa_"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="app-footer__contact-item instagram">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.308.975.975 1.246 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.308 3.608-.975.975-2.242 1.246-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.308-.975-.975-1.246-2.242-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.334-2.633 1.308-3.608.975-.975 2.242-1.246 3.608-1.308C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.333.013 7.053.072 5.197.157 3.355.673 1.924 2.076.496 3.507 0 5.344 0 7.053-.013 8.333 0 8.741 0 12c0 3.259.013 3.668.072 4.948.085 1.71.6 3.553 2.004 4.984C3.507 23.504 5.344 24 7.053 24c1.28.059 1.689.072 4.947.072s3.668-.013 4.948-.072c1.71-.085 3.553-.6 4.984-2.004C23.504 20.493 24 18.656 24 16.947c.059-1.28.072-1.689.072-4.947s-.013-3.668-.072-4.948c-.085-1.71-.6-3.553-2.004-4.984C20.493.496 18.656 0 16.947 0 15.667-.013 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                    @violasalwa_
                </a>
            </div>

        </div>

        <div class="app-footer__bottom">
            <p class="app-footer__copy">
                &copy; {{ date('Y') }} BurnoutCheck. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('open');
        }
        function toggleMobile() {
            document.getElementById('mobileNav').classList.toggle('open');
        }
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown && !dropdown.contains(e.target)) {
                dropdown.classList.remove('open');
            }
        });
    </script>

    @yield('scripts')

</body>
</html>