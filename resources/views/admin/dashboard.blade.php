@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
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
    --r-sm : 8px;
    --r-lg : 20px;
    --sh-md: 0 4px 16px rgba(40,114,232,0.12);
    --sh-lg: 0 8px 32px rgba(40,114,232,0.18);
    --tr   : 0.22s cubic-bezier(.4,0,.2,1);
}

/* ── PAGE TITLE ──────────────────────────────────────────── */
h1 {
    font-size: clamp(1.35rem, 3vw, 1.9rem);
    font-weight: 700;
    color: var(--bl9);
    letter-spacing: -0.02em;
    padding-bottom: 0.6rem;
    border-bottom: 3px solid var(--bl1);
    position: relative;
    margin-bottom: 1.75rem;
}
h1::after {
    content: '';
    position: absolute;
    left: 0; bottom: -3px;
    width: 56px; height: 3px;
    background: linear-gradient(90deg, var(--bl5), var(--bl4));
    border-radius: 2px;
}

/* ── WELCOME BANNER ──────────────────────────────────────── */
.welcome-banner {
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 55%, var(--bl5) 100%);
    border-radius: var(--r-lg);
    padding: 2rem 2.5rem;
    margin-bottom: 1.75rem;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    box-shadow: var(--sh-lg);
}
.welcome-banner::before {
    content: '';
    position: absolute;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    top: -100px; right: -60px;
    pointer-events: none;
}
.welcome-banner::after {
    content: '';
    position: absolute;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    bottom: -70px; left: 40%;
    pointer-events: none;
}

.welcome-banner__text { position: relative; z-index: 1; }
.welcome-banner__text h2 {
    font-size: clamp(1.2rem, 3vw, 1.7rem);
    font-weight: 800;
    color: var(--wh);
    letter-spacing: -0.02em;
    margin-bottom: 0.4rem;
    line-height: 1.2;
}
.welcome-banner__text p {
    font-size: 0.88rem;
    color: rgba(255,255,255,0.7);
    line-height: 1.6;
    max-width: 420px;
}

.welcome-banner__icon {
    position: relative; z-index: 1;
    width: 72px; height: 72px;
    border-radius: 20px;
    background: rgba(255,255,255,0.12);
    border: 1.5px solid rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.welcome-banner__icon svg {
    width: 36px; height: 36px;
    stroke: #fff; fill: none;
    stroke-width: 1.75;
    stroke-linecap: round;
    stroke-linejoin: round;
}

/* ── STAT GRID ───────────────────────────────────────────── */
.stat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
    margin-bottom: 1.75rem;
}

/* ── STAT BOX ────────────────────────────────────────────── */
.stat-box {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.5rem 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    display: flex;
    flex-direction: column;
    gap: 0.55rem;
    position: relative;
    overflow: hidden;
    transition: box-shadow var(--tr), transform var(--tr);
}
.stat-box:hover {
    box-shadow: var(--sh-lg);
    transform: translateY(-3px);
}

.stat-box__icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.5rem;
    flex-shrink: 0;
}
.stat-box__icon svg {
    width: 22px; height: 22px;
    stroke: #fff; fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.stat-box--users .stat-box__icon  { background: linear-gradient(135deg, var(--bl9), var(--bl5)); }
.stat-box--soal .stat-box__icon   { background: linear-gradient(135deg, #0891b2, #06b6d4); }
.stat-box--tes .stat-box__icon    { background: linear-gradient(135deg, #7c3aed, #a78bfa); }

.stat-box h3 {
    font-size: 0.73rem;
    font-weight: 700;
    color: var(--g4);
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.stat-box .number {
    font-size: clamp(2.2rem, 5vw, 3rem);
    font-weight: 800;
    line-height: 1;
    letter-spacing: -0.04em;
}
.stat-box--users .number { color: var(--bl7); }
.stat-box--soal  .number { color: #0891b2;    }
.stat-box--tes   .number { color: #7c3aed;    }

.stat-box .stat-box__sub {
    font-size: 0.75rem;
    color: var(--g4);
    font-weight: 500;
}

.stat-box::after {
    content: '';
    position: absolute;
    width: 90px; height: 90px;
    border-radius: 50%;
    bottom: -25px; right: -25px;
    pointer-events: none;
    opacity: 0.5;
}
.stat-box--users::after { background: radial-gradient(circle, rgba(40,114,232,0.10) 0%, transparent 70%); }
.stat-box--soal::after  { background: radial-gradient(circle, rgba(8,145,178,0.10) 0%, transparent 70%);  }
.stat-box--tes::after   { background: radial-gradient(circle, rgba(124,58,237,0.10) 0%, transparent 70%); }

/* ── BOTTOM GRID ─────────────────────────────────────────── */
.bottom-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
    margin-bottom: 1.75rem;
}

/* ── CARD ────────────────────────────────────────────────── */
.card {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    transition: box-shadow var(--tr), transform var(--tr);
}
.card:hover {
    box-shadow: var(--sh-lg);
    transform: translateY(-2px);
}

.card h2 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--bl7);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.card h2::before {
    content: '';
    display: inline-block;
    width: 4px; height: 1.1em;
    background: linear-gradient(180deg, var(--bl5), var(--bl4));
    border-radius: 2px;
    flex-shrink: 0;
}

/* ── MENU ITEMS ───────────────────────────────────────────── */
.menu-list {
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.9rem 1rem;
    border-radius: 12px;
    text-decoration: none;
    border: 1.5px solid var(--g2);
    background: var(--g1);
    transition: background var(--tr), border-color var(--tr), transform var(--tr), box-shadow var(--tr);
}
.menu-item:hover {
    background: var(--bl0);
    border-color: var(--bl4);
    transform: translateX(4px);
    box-shadow: 0 2px 10px rgba(40,114,232,0.12);
}

.menu-item__icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.menu-item__icon svg {
    width: 20px; height: 20px;
    stroke: #fff; fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
.menu-item--users .menu-item__icon  { background: linear-gradient(135deg, var(--bl9), var(--bl5)); }
.menu-item--soal .menu-item__icon   { background: linear-gradient(135deg, #0891b2, #06b6d4); }
.menu-item--level .menu-item__icon  { background: linear-gradient(135deg, #7c3aed, #a78bfa); }

.menu-item__info { flex: 1; min-width: 0; }
.menu-item__title {
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--g8);
    margin-bottom: 0.15rem;
}
.menu-item__desc {
    font-size: 0.75rem;
    color: var(--g4);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.menu-item__arrow {
    width: 18px; height: 18px;
    stroke: var(--g4); fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    flex-shrink: 0;
    transition: stroke var(--tr), transform var(--tr);
}
.menu-item:hover .menu-item__arrow {
    stroke: var(--bl5);
    transform: translateX(2px);
}

/* ── INFO ROWS ───────────────────────────────────────────── */
.info-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.info-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.7rem 0;
    border-bottom: 1px solid var(--g2);
}
.info-row:last-child { border-bottom: none; }

.info-row__label {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.85rem;
    color: var(--g6);
    font-weight: 500;
}
.info-row__label svg {
    width: 15px; height: 15px;
    stroke: var(--g4); fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    flex-shrink: 0;
}

.info-row__value {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--g8);
}

.badge-pill {
    display: inline-flex;
    align-items: center;
    padding: 0.2em 0.7em;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.04em;
}
.badge-pill--blue  { background: var(--bl0); color: var(--bl7); border: 1px solid var(--bl1); }
.badge-pill--green { background: #dcfce7; color: #15803d; }

/* ── ACTIVITY LIST ───────────────────────────────────────── */
.activity-list {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--g2);
}
.activity-item:last-child { border-bottom: none; }

.activity-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--bl9), var(--bl5));
    color: var(--wh);
    font-size: 0.72rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    letter-spacing: 0.03em;
}

.activity-info {
    flex: 1;
    min-width: 0;
}

.activity-name {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--g8);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 0.15rem;
}

.activity-meta {
    font-size: 0.75rem;
    color: var(--g4);
}

.activity-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.15em 0.55em;
    border-radius: 999px;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.04em;
}
.activity-badge--rendah       { background: #dcfce7; color: #15803d; }
.activity-badge--sedang       { background: #fef9c3; color: #a16207; }
.activity-badge--tinggi       { background: #fee2e2; color: #b91c1c; }
.activity-badge--sangat-tinggi { background: #fce7f3; color: #be185d; }

.activity-time {
    font-size: 0.72rem;
    color: var(--g4);
    white-space: nowrap;
    flex-shrink: 0;
}

.activity-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    padding: 2rem 1rem;
    color: var(--g4);
    text-align: center;
}
.activity-empty svg {
    width: 32px;
    height: 32px;
    stroke: var(--g4);
    fill: none;
    stroke-width: 1.75;
    stroke-linecap: round;
    stroke-linejoin: round;
    opacity: 0.6;
}
.activity-empty p {
    font-size: 0.82rem;
    color: var(--g4);
}

/* ── RESPONSIVE ───────────────────────────────────────────── */
@media (max-width: 768px) {
    .welcome-banner { padding: 1.5rem; }
    .welcome-banner__icon { display: none; }

    .stat-grid { grid-template-columns: 1fr 1fr; gap: 0.9rem; }
    .stat-box--tes { grid-column: 1 / -1; }

    .bottom-grid { grid-template-columns: 1fr; }

    .card { padding: 1.25rem; }
}

@media (max-width: 420px) {
    .stat-grid { grid-template-columns: 1fr; }
    .stat-box--tes { grid-column: auto; }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .stat-grid { grid-template-columns: repeat(3, 1fr); }
    .bottom-grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')

<h1>Dashboard Admin</h1>

{{-- ── Welcome Banner ── --}}
<div class="welcome-banner">
    <div class="welcome-banner__text">
        <h2>Selamat Datang, Admin!</h2>
        <p>Pantau dan kelola seluruh data sistem BurnoutCheck dari satu tempat. Gunakan menu di bawah untuk navigasi cepat.</p>
    </div>
    <div class="welcome-banner__icon">
        <svg viewBox="0 0 24 24">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
            <path d="M2 17l10 5 10-5"/>
            <path d="M2 12l10 5 10-5"/>
        </svg>
    </div>
</div>

{{-- ── Stat Cards ── --}}
<div class="stat-grid">
    <div class="stat-box stat-box--users">
        <div class="stat-box__icon">
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                <path d="M16 3.13a4 4 0 010 7.75"/>
            </svg>
        </div>
        <h3>Total Pengguna</h3>
        <p class="number">{{ $stats['users'] }}</p>
        <p class="stat-box__sub">Terdaftar di sistem</p>
    </div>

    <div class="stat-box stat-box--soal">
        <div class="stat-box__icon">
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
        </div>
        <h3>Total Soal</h3>
        <p class="number">{{ $stats['soal'] }}</p>
        <p class="stat-box__sub">Soal kuesioner aktif</p>
    </div>

    <div class="stat-box stat-box--tes">
        <div class="stat-box__icon">
            <svg viewBox="0 0 24 24">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
            </svg>
        </div>
        <h3>Total Percobaan Tes</h3>
        <p class="number">{{ $stats['percobaan'] }}</p>
        <p class="stat-box__sub">Tes yang telah diselesaikan</p>
    </div>
</div>

{{-- ── Bottom: Menu + Aktivitas ── --}}
<div class="bottom-grid">

    {{-- Menu Manajemen --}}
    <div class="card">
        <h2>Menu Manajemen</h2>
        <div class="menu-list">
            <a href="{{ route('admin.users.index') }}" class="menu-item menu-item--users">
                <div class="menu-item__icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                        <path d="M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <div class="menu-item__info">
                    <p class="menu-item__title">Kelola Pengguna</p>
                    <p class="menu-item__desc">Tambah, edit, dan hapus akun pengguna</p>
                </div>
                <svg class="menu-item__arrow" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>

            <a href="{{ route('admin.soal.index') }}" class="menu-item menu-item--soal">
                <div class="menu-item__icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <div class="menu-item__info">
                    <p class="menu-item__title">Kelola Soal</p>
                    <p class="menu-item__desc">Atur soal kuesioner burnout</p>
                </div>
                <svg class="menu-item__arrow" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>

            <a href="{{ route('admin.risk-levels.index') }}" class="menu-item menu-item--level">
                <div class="menu-item__icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <div class="menu-item__info">
                    <p class="menu-item__title">Kelola Level Risiko</p>
                    <p class="menu-item__desc">Atur ambang batas skor burnout</p>
                </div>
                <svg class="menu-item__arrow" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- Ringkasan Sistem --}}
    <div class="card">
        <h2>Ringkasan Sistem</h2>
        <div class="info-list">

            <div class="info-row">
                <span class="info-row__label">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                        <path d="M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                    Total Pengguna
                </span>
                <span class="info-row__value">{{ $stats['users'] }} akun</span>
            </div>

            <div class="info-row">
                <span class="info-row__label">
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                    Total Soal Kuesioner
                </span>
                <span class="info-row__value">{{ $stats['soal'] }} soal</span>
            </div>

            <div class="info-row">
                <span class="info-row__label">
                    <svg viewBox="0 0 24 24">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                    Total Percobaan Tes
                </span>
                <span class="info-row__value">{{ $stats['percobaan'] }} tes</span>
            </div>

            <div class="info-row">
                <span class="info-row__label">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Tanggal Hari Ini
                </span>
                <span class="info-row__value">{{ now()->translatedFormat('d F Y') }}</span>
            </div>

            <div class="info-row">
                <span class="info-row__label">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    Status Sistem
                </span>
                <span class="badge-pill badge-pill--green">Aktif</span>
            </div>

        </div>
    </div>

</div>

@endsection