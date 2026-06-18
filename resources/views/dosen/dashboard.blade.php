@extends('layouts.app')

@section('title', 'Dashboard Dosen')

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

/* ── PAGE TITLE ── */
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

/* ── WELCOME BANNER ── */
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
    width: 320px; height: 320px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    top: -110px; right: -70px;
    pointer-events: none;
}
.welcome-banner::after {
    content: '';
    position: absolute;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    bottom: -70px; left: 38%;
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
    color: rgba(255,255,255,0.72);
    line-height: 1.65;
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

/* ── STAT GRID ── */
.stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
    margin-bottom: 1.75rem;
}

/* ── STAT BOX ── */
.stat-box {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.5rem 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
    transition: box-shadow var(--tr), transform var(--tr);
}
.stat-box:hover {
    box-shadow: var(--sh-lg);
    transform: translateY(-3px);
}

.stat-box__icon {
    width: 42px; height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.4rem;
    flex-shrink: 0;
}
.stat-box__icon svg {
    width: 20px; height: 20px;
    stroke: #fff; fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.stat-box--total  .stat-box__icon { background: linear-gradient(135deg, var(--bl9), var(--bl5)); }
.stat-box--rendah .stat-box__icon { background: linear-gradient(135deg, #15803d, #22c55e); }
.stat-box--sedang .stat-box__icon { background: linear-gradient(135deg, #a16207, #f59e0b); }
.stat-box--tinggi .stat-box__icon { background: linear-gradient(135deg, #b91c1c, #ef4444); }

.stat-box h3 {
    font-size: 0.72rem;
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
.stat-box--total  .number { color: var(--bl7); }
.stat-box--rendah .number { color: #15803d; }
.stat-box--sedang .number { color: #a16207; }
.stat-box--tinggi .number { color: #b91c1c; }

.stat-box .stat-sub {
    font-size: 0.74rem;
    color: var(--g4);
    font-weight: 500;
}

/* Dekorasi lingkaran pojok */
.stat-box::after {
    content: '';
    position: absolute;
    width: 90px; height: 90px;
    border-radius: 50%;
    bottom: -25px; right: -25px;
    pointer-events: none;
    opacity: 0.6;
}
.stat-box--total::after  { background: radial-gradient(circle, rgba(40,114,232,0.10) 0%, transparent 70%); }
.stat-box--rendah::after { background: radial-gradient(circle, rgba(21,128,61,0.10) 0%, transparent 70%); }
.stat-box--sedang::after { background: radial-gradient(circle, rgba(161,98,7,0.10) 0%, transparent 70%); }
.stat-box--tinggi::after { background: radial-gradient(circle, rgba(185,28,28,0.10) 0%, transparent 70%); }

/* ── BOTTOM GRID ── */
.bottom-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
    margin-bottom: 1.75rem;
}

/* ── CARD ── */
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

/* ── CHART CARD (full width) ── */
.card-chart {
    margin-bottom: 1.75rem;
}

/* ── MENU ITEM ── */
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
    background: linear-gradient(135deg, var(--bl9), var(--bl5));
}
.menu-item__icon svg {
    width: 20px; height: 20px;
    stroke: #fff; fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
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

/* ── RISIKO BREAKDOWN ── */
.risiko-list {
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
}
.risiko-row {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}
.risiko-row__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.risiko-row__label {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--g6);
}
.risiko-row__count {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--g8);
}
.progress-bar {
    width: 100%;
    height: 8px;
    background: var(--g2);
    border-radius: 999px;
    overflow: hidden;
}
.progress-bar__fill {
    height: 100%;
    border-radius: 999px;
    transition: width 0.6s cubic-bezier(.4,0,.2,1);
}
.progress-bar__fill--rendah { background: linear-gradient(90deg, #15803d, #22c55e); }
.progress-bar__fill--sedang { background: linear-gradient(90deg, #a16207, #f59e0b); }
.progress-bar__fill--tinggi { background: linear-gradient(90deg, #b91c1c, #ef4444); }

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .welcome-banner { padding: 1.5rem; }
    .welcome-banner__icon { display: none; }
    .stat-grid { grid-template-columns: 1fr 1fr; gap: 0.9rem; }
    .bottom-grid { grid-template-columns: 1fr; }
    .card { padding: 1.25rem; }
}
@media (max-width: 420px) {
    .stat-grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')

<h1>Dashboard Dosen</h1>

{{-- ── Welcome Banner ── --}}
<div class="welcome-banner">
    <div class="welcome-banner__text">
        <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p>Pantau kondisi burnout mahasiswa bimbingan Anda. Gunakan data di bawah untuk memahami perkembangan kesehatan mental mahasiswa.</p>
    </div>
    <div class="welcome-banner__icon">
        <svg viewBox="0 0 24 24">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87"/>
            <path d="M16 3.13a4 4 0 010 7.75"/>
        </svg>
    </div>
</div>

{{-- ── Stat Cards ── --}}
<div class="stat-grid">

    <div class="stat-box stat-box--total">
        <div class="stat-box__icon">
            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                <path d="M16 3.13a4 4 0 010 7.75"/>
            </svg>
        </div>
        <h3>Total Mahasiswa</h3>
        <p class="number">{{ $mahasiswaCount }}</p>
        <p class="stat-sub">Terdaftar di sistem</p>
    </div>

    <div class="stat-box stat-box--rendah">
        <div class="stat-box__icon">
            <svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <h3>Risiko Rendah</h3>
        <p class="number">{{ $lowRiskCount }}</p>
        <p class="stat-sub">Kondisi stabil</p>
    </div>

    <div class="stat-box stat-box--sedang">
        <div class="stat-box__icon">
            <svg viewBox="0 0 24 24">
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        </div>
        <h3>Risiko Sedang</h3>
        <p class="number">{{ $mediumRiskCount }}</p>
        <p class="stat-sub">Perlu diperhatikan</p>
    </div>

    <div class="stat-box stat-box--tinggi">
        <div class="stat-box__icon">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="15" y1="9" x2="9" y2="15"/>
                <line x1="9" y1="9" x2="15" y2="15"/>
            </svg>
        </div>
        <h3>Risiko Tinggi</h3>
        <p class="number">{{ $highRiskCount }}</p>
        <p class="stat-sub">Perlu penanganan</p>
    </div>

</div>

{{-- ── Chart (full width) ── --}}
<div class="card card-chart">
    <h2>Distribusi Risiko Burnout Mahasiswa</h2>
    <div style="width: 100%; max-width: 420px; margin: 0 auto;">
        <canvas id="burnoutChart"></canvas>
    </div>
</div>

{{-- ── Bottom Grid ── --}}
<div class="bottom-grid">

    {{-- Menu --}}
    <div class="card">
        <h2>Menu Dosen</h2>
        <div class="menu-list">
            <a href="{{ route('dosen.mahasiswa') }}" class="menu-item">
                <div class="menu-item__icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                        <path d="M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <div class="menu-item__info">
                    <p class="menu-item__title">Daftar Mahasiswa</p>
                    <p class="menu-item__desc">Lihat seluruh data dan hasil tes mahasiswa</p>
                </div>
                <svg class="menu-item__arrow" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- Risiko Breakdown ── --}}
    <div class="card">
        <h2>Breakdown Risiko</h2>
        <div class="risiko-list">

            @php
                $total = max($mahasiswaCount, 1);
            @endphp

            <div class="risiko-row">
                <div class="risiko-row__header">
                    <span class="risiko-row__label">🟢 Rendah</span>
                    <span class="risiko-row__count">{{ $lowRiskCount }} mahasiswa</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-bar__fill progress-bar__fill--rendah"
                         style="width: {{ round(($lowRiskCount / $total) * 100) }}%"></div>
                </div>
            </div>

            <div class="risiko-row">
                <div class="risiko-row__header">
                    <span class="risiko-row__label">🟡 Sedang</span>
                    <span class="risiko-row__count">{{ $mediumRiskCount }} mahasiswa</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-bar__fill progress-bar__fill--sedang"
                         style="width: {{ round(($mediumRiskCount / $total) * 100) }}%"></div>
                </div>
            </div>

            <div class="risiko-row">
                <div class="risiko-row__header">
                    <span class="risiko-row__label">🔴 Tinggi</span>
                    <span class="risiko-row__count">{{ $highRiskCount }} mahasiswa</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-bar__fill progress-bar__fill--tinggi"
                         style="width: {{ round(($highRiskCount / $total) * 100) }}%"></div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('burnoutChart');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Rendah', 'Sedang', 'Tinggi'],
        datasets: [{
            data: [
                {{ $lowRiskCount }},
                {{ $mediumRiskCount }},
                {{ $highRiskCount }}
            ],
            backgroundColor: ['#22c55e', '#f59e0b', '#ef4444'],
            borderWidth: 4,
            borderColor: '#ffffff',
            hoverOffset: 8
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    font: { size: 13, weight: 'bold' },
                    padding: 20,
                    usePointStyle: true,
                    pointStyleWidth: 10,
                }
            }
        }
    }
});
</script>
@endsection