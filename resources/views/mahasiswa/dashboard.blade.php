@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('styles')
<style>
*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

:root {
    --bl9: #0d2d6b;
    --bl7: #1a4fad;
    --bl5: #2872e8;
    --bl4: #4d8ef5;
    --bl1: #dce8fd;
    --bl0: #f0f5ff;
    --wh:  #ffffff;
    --g1:  #f4f6fb;
    --g2:  #e8ecf4;
    --g4:  #9aa3b8;
    --g6:  #5a6278;
    --g8:  #2c3249;
    --r-sm: 8px;
    --r-lg: 20px;
    --sh-md: 0 4px 16px rgba(40,114,232,0.12);
    --sh-lg: 0 8px 32px rgba(40,114,232,0.18);
    --tr: 0.22s cubic-bezier(.4,0,.2,1);
}

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

.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
    margin-bottom: 1.75rem;
}

.card {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
    margin-bottom: 1.75rem;
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

/* STAT BOX */
.stat-box {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.5rem 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    position: relative;
    overflow: hidden;
    transition: box-shadow var(--tr), transform var(--tr);
}
.stat-box:hover {
    box-shadow: var(--sh-lg);
    transform: translateY(-2px);
}
.stat-box h3 {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    color: var(--g4);
}

.stat-status-text {
    font-size: clamp(1.5rem, 3vw, 1.9rem);
    font-weight: 800;
    color: var(--bl5);
    line-height: 1.1;
    letter-spacing: -0.02em;
}
.stat-status-text.rendah        { color: #15803d; }
.stat-status-text.sedang        { color: #a16207; }
.stat-status-text.tinggi        { color: #b91c1c; }

.stat-sublabel {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.82rem;
    font-weight: 600;
}
.stat-sublabel svg {
    width: 15px; height: 15px;
    fill: none;
    stroke-width: 2.5;
    stroke-linecap: round;
    stroke-linejoin: round;
    flex-shrink: 0;
}

.stat-score-wrap {
    display: flex;
    align-items: baseline;
    gap: 0.1rem;
    line-height: 1;
}
.stat-score-wrap .number {
    font-size: clamp(2.4rem, 6vw, 3.2rem);
    font-weight: 800;
    line-height: 1;
    background: linear-gradient(135deg, var(--bl9), var(--bl5));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.stat-score-wrap .number-max {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--g4);
}

.stat-box .number-plain {
    font-size: clamp(2rem, 6vw, 3rem);
    font-weight: 800;
    line-height: 1;
    background: linear-gradient(135deg, var(--bl9), var(--bl5));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-date {
    font-size: 0.82rem;
    color: var(--g4);
    margin-top: auto;
}

/* BADGE */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.28em 0.85em;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    white-space: nowrap;
}
.badge-rendah        { background: #dcfce7; color: #15803d; }
.badge-sedang        { background: #fef9c3; color: #a16207; }
.badge-tinggi        { background: #fee2e2; color: #b91c1c; }
.badge-secondary     { background: var(--g2); color: var(--g6); }

/* TABLE */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
}
.table thead tr {
    background: linear-gradient(90deg, var(--bl9), var(--bl7));
}
.table thead th {
    padding: 0.8rem 1rem;
    color: var(--wh);
    font-weight: 600;
    text-align: left;
    font-size: 0.78rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    white-space: nowrap;
}
.table thead th:first-child { border-radius: var(--r-sm) 0 0 var(--r-sm); }
.table thead th:last-child  { border-radius: 0 var(--r-sm) var(--r-sm) 0; }
.table tbody tr {
    border-bottom: 1px solid var(--g2);
    transition: background var(--tr);
}
.table tbody tr:last-child { border-bottom: none; }
.table tbody tr:hover { background: var(--bl0); }
.table tbody td {
    padding: 0.8rem 1rem;
    color: var(--g8);
    vertical-align: middle;
}

/* BUTTON */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.6em 1.5em;
    border-radius: var(--r-sm);
    font-size: 0.88rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    font-family: inherit;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    color: var(--wh);
    box-shadow: 0 2px 8px rgba(40,114,232,0.25);
}
.btn:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 4px 14px rgba(40,114,232,0.38);
    transform: translateY(-1px);
    color: var(--wh);
}
.btn:active { transform: translateY(0); }

.btn-hero {
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 35%, var(--bl5) 70%, var(--bl4) 100%);
    box-shadow: 0 4px 20px rgba(40,114,232,0.45), 0 1px 4px rgba(13,45,107,0.3);
    font-size: 0.95rem;
    font-weight: 700;
    padding: 0.75em 2em;
    letter-spacing: 0.02em;
    border-radius: 10px;
}
.btn-hero:hover {
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl9) 20%, var(--bl7) 60%, var(--bl5) 100%);
    box-shadow: 0 6px 28px rgba(40,114,232,0.55), 0 2px 8px rgba(13,45,107,0.35);
    transform: translateY(-2px);
    color: var(--wh);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .welcome-banner { padding: 1.5rem; }
    .welcome-banner__icon { display: none; }
    .card { padding: 1.25rem; }
    .stat-box { padding: 1.25rem; }
    .grid { grid-template-columns: 1fr; }
    .table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .btn-hero { width: 100%; justify-content: center; }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .grid { grid-template-columns: repeat(3, 1fr); }
}
</style>
@endsection

@section('content')

<h1>Dashboard Mahasiswa</h1>

{{-- ═══ WELCOME BANNER ═══ --}}
<div class="welcome-banner">
    <div class="welcome-banner__text">
        <h2>Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p>Pantau kondisi burnout Anda dan lihat perkembangan dari waktu ke waktu. Mulai tes untuk mendapatkan hasil terbaru.</p>
    </div>
    <div class="welcome-banner__icon">
        <svg viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
        </svg>
    </div>
</div>

{{-- ═══ TOMBOL MULAI TES ═══ --}}
<div style="margin-bottom: 1.75rem;">
    <a href="{{ route('mahasiswa.tes.index') }}" class="btn btn-hero">
        Mulai Tes Burnout
    </a>
</div>

{{-- ═══ CHART ═══ --}}
<div class="card">
    <h2>Perkembangan Burnout Anda</h2>
    <canvas id="burnoutChart" style="max-height: 300px;"></canvas>
</div>

{{-- ═══ 3 STAT CARDS ═══ --}}
<div class="grid">

    {{-- 1. Status Burnout Terbaru --}}
    <div class="stat-box">
        <h3>Status Saat Ini</h3>
        @if ($latestResult)
            @php
                $level = $latestResult->levelRisiko;
                $slug  = $level ? strtolower(str_replace(' ', '-', $level->nama_level)) : 'secondary';
                $sublabelMap = [
                    'rendah'        => ['text' => 'Kondisi Stabil',     'color' => '#15803d', 'icon' => 'check'],
                    'sedang'        => ['text' => 'Perlu Diperhatikan', 'color' => '#a16207', 'icon' => 'alert'],
                    'tinggi'        => ['text' => 'Perlu Penanganan',   'color' => '#b91c1c', 'icon' => 'x'],
                ];
                $sub = $sublabelMap[$slug] ?? ['text' => 'Kondisi Terpantau', 'color' => '#9aa3b8', 'icon' => 'check'];
            @endphp
            @if ($level)
                <p class="stat-status-text {{ $slug }}">{{ $level->nama_level }}</p>
                <span class="stat-sublabel" style="color: {{ $sub['color'] }};">
                    @if ($sub['icon'] === 'check')
                        <svg viewBox="0 0 24 24" style="stroke:{{ $sub['color'] }}">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                    @elseif ($sub['icon'] === 'alert')
                        <svg viewBox="0 0 24 24" style="stroke:{{ $sub['color'] }}">
                            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            <line x1="12" y1="9" x2="12" y2="13"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    @else
                        <svg viewBox="0 0 24 24" style="stroke:{{ $sub['color'] }}">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="15" y1="9" x2="9" y2="15"/>
                            <line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                    @endif
                    {{ $sub['text'] }}
                </span>
            @else
                <p class="stat-status-text" style="color:var(--g4);">—</p>
                <span class="stat-sublabel">Belum ada level</span>
            @endif
        @else
            <p class="stat-status-text" style="color:var(--g4);">—</p>
            <span class="stat-sublabel">Belum ada tes</span>
        @endif
    </div>

    {{-- 2. Skor Terbaru --}}
    <div class="stat-box">
        <h3>Skor Anda Saat Ini</h3>
        @if ($latestResult)
            <div class="stat-score-wrap">
                <span class="number">{{ $latestResult->total_skor }}</span>
                <span class="number-max">/100</span>
            </div>
            <p class="stat-date">Tercatat pada {{ $latestResult->created_at->format('d M Y') }}</p>
        @else
            <div class="stat-score-wrap">
                <span class="number" style="-webkit-text-fill-color:var(--g4);background:none;color:var(--g4);">—</span>
                <span class="number-max">/100</span>
            </div>
            <p class="stat-date">Belum ada tes</p>
        @endif
    </div>

    {{-- 3. Total Tes Selesai --}}
    <div class="stat-box">
        <h3>Total Tes Selesai</h3>
        <p class="number-plain">{{ $totalTes }}</p>
    </div>

</div>

{{-- ═══ RIWAYAT TERBARU ═══ --}}
<div class="card">
    <h2>Riwayat Tes Terbaru</h2>

    @if ($history->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Skor</th>
                    <th>Level Risiko</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $result)
                    <tr>
                        <td>{{ $result->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $result->total_skor }}</td>
                        <td>
                            @php $level = $result->levelRisiko; @endphp
                            @if ($level)
                                <span class="badge badge-{{ strtolower(str_replace(' ', '-', $level->nama_level)) }}">
                                    {{ $level->nama_level }}
                                </span>
                            @else
                                <span class="badge badge-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('mahasiswa.tes.hasil', $result->id) }}" class="btn">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color:var(--g4); font-size:0.9rem;">Belum ada riwayat tes.</p>
    @endif
</div>

{{-- ═══ CTA BAWAH ═══ --}}
<div class="card" style="flex-direction:row; flex-wrap:wrap; align-items:center; gap:1rem; padding:1.25rem 1.75rem; background:linear-gradient(135deg,var(--bl9) 0%,var(--bl7) 100%); border-color:transparent;">
    <a href="{{ route('mahasiswa.history') }}"
       style="display:inline-flex;align-items:center;justify-content:center;padding:0.55em 1.25em;border-radius:var(--r-sm);font-size:0.85rem;font-weight:600;text-decoration:none;color:var(--wh);background:rgba(255,255,255,0.14);border:1.5px solid rgba(255,255,255,0.35);transition:background 0.22s,transform 0.22s;white-space:nowrap;">
        Lihat Semua Riwayat
    </a>
</div>

@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('burnoutChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($history->reverse()->map(fn($h) => $h->created_at->format('d/m'))->values()) !!},
            datasets: [{
                label: 'Skor Burnout',
                data: {!! json_encode($history->reverse()->pluck('total_skor')->values()) !!},
                borderColor: '#2872e8',
                backgroundColor: 'rgba(40,114,232,0.08)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#2872e8',
                pointRadius: 5,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, max: 100 }
            }
        }
    });
</script>
@endsection