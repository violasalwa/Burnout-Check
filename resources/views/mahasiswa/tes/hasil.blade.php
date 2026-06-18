@extends('layouts.app')

@section('title', 'Hasil Tes Burnout')

@section('styles')
<style>
/* ============================================================
   mahasiswa/tes/hasil.blade.php — Custom CSS
   Theme  : Blue & White | Report Style | Modern Responsive
   ============================================================ */

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
    --green5: #16a34a;
    --green1: #dcfce7;
    --green0: #f0fdf4;
    --yel5  : #a16207;
    --yel1  : #fef9c3;
    --red5  : #b91c1c;
    --red1  : #fee2e2;
    --r-sm : 10px;
    --r-lg : 20px;
    --r-xl : 28px;
    --sh-md: 0 4px 16px rgba(40, 114, 232, 0.10);
    --sh-lg: 0 8px 32px rgba(40, 114, 232, 0.15);
    --tr   : 0.22s cubic-bezier(.4, 0, .2, 1);
}

/* ── PAGE WRAPPER ─────────────────────────────────────────── */
.laporan-wrapper {
    max-width: 780px;
    margin: 0 auto;
    padding: 2rem 1rem 3rem;
}

/* ── LAPORAN CARD UTAMA ───────────────────────────────────── */
.laporan-card {
    background: var(--wh);
    border-radius: var(--r-xl);
    border: 1px solid var(--g2);
    box-shadow: var(--sh-lg);
    overflow: hidden;
}

/* ── HEADER LAPORAN ───────────────────────────────────────── */
.laporan-header {
    padding: 2rem 2.5rem 1.5rem;
    border-bottom: 1px solid var(--g2);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

.laporan-header-left { flex: 1; }

.laporan-eyebrow {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--g4);
    margin-bottom: 0.4rem;
}

.laporan-title {
    font-size: clamp(1.2rem, 3vw, 1.55rem);
    font-weight: 800;
    color: var(--g8);
    letter-spacing: -0.02em;
    line-height: 1.25;
}

.laporan-date {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--g6);
    background: var(--g1);
    border: 1px solid var(--g2);
    border-radius: 999px;
    padding: 0.4em 1em;
    white-space: nowrap;
    flex-shrink: 0;
    align-self: flex-start;
    margin-top: 0.25rem;
}
.laporan-date svg {
    width: 14px; height: 14px;
    stroke: var(--g4); fill: none;
    stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    flex-shrink: 0;
}

/* ── SECTION LABEL ────────────────────────────────────────── */
.section-label {
    font-size: 0.68rem;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--g4);
    padding: 1.5rem 2.5rem 0.75rem;
}

/* ── ANALISIS BOX ─────────────────────────────────────────── */
.analisis-box {
    margin: 0 2rem 1.5rem;
    border: 1px solid var(--g2);
    border-radius: var(--r-lg);
    display: flex;
    align-items: stretch;
    overflow: hidden;
    background: var(--wh);
}

.skor-visual {
    width: 220px;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 2rem 1.5rem;
    background: var(--g1);
    border-right: 1px solid var(--g2);
}

.skor-ring {
    position: relative;
    width: 100px; height: 100px;
}
.skor-ring svg {
    width: 100%; height: 100%;
    transform: rotate(-90deg);
}
.skor-ring-bg {
    fill: none;
    stroke: var(--g2);
    stroke-width: 8;
}
.skor-ring-fill {
    fill: none;
    stroke-width: 8;
    stroke-linecap: round;
    transition: stroke-dashoffset 1s ease;
}
.ring-rendah        { stroke: var(--green5); }
.ring-sedang        { stroke: #eab308; }
.ring-tinggi        { stroke: #ef4444; }

.skor-ring-text {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    line-height: 1;
}
.skor-angka {
    font-size: 1.75rem;
    font-weight: 900;
    color: var(--g8);
    letter-spacing: -0.04em;
}
.skor-max {
    font-size: 0.7rem;
    color: var(--g4);
    font-weight: 600;
    margin-top: 0.15rem;
}
.skor-caption {
    font-size: 0.65rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--g4);
}

.skor-detail {
    flex: 1;
    padding: 1.75rem 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 0.75rem;
}

/* ── BADGE ────────────────────────────────────────────────── */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.3em 0.9em;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    white-space: nowrap;
    align-self: flex-start;
}
.badge::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
    flex-shrink: 0;
}
.badge-rendah        { background: var(--green1); color: var(--green5); }
.badge-sedang        { background: var(--yel1);   color: var(--yel5); }
.badge-tinggi        { background: var(--red1);   color: var(--red5); }

.status-title {
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--g8);
    letter-spacing: -0.02em;
    line-height: 1.2;
}
.status-desc {
    font-size: 0.88rem;
    color: var(--g6);
    line-height: 1.75;
}

/* ── INFO GRID ────────────────────────────────────────────── */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    border-top: 1px solid var(--g2);
}
.info-col { padding: 1.75rem 2.5rem; }
.info-col:first-child { border-right: 1px solid var(--g2); }

.info-col-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    font-weight: 800;
    color: var(--g8);
    margin-bottom: 1.1rem;
}
.info-col-title svg {
    width: 18px; height: 18px;
    stroke: var(--bl5); fill: none;
    stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    flex-shrink: 0;
}

.info-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
}
.info-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.55rem;
    font-size: 0.84rem;
    color: var(--g6);
    line-height: 1.6;
}
.info-list li svg {
    width: 15px; height: 15px;
    fill: none; stroke-width: 2.5;
    stroke-linecap: round; stroke-linejoin: round;
    flex-shrink: 0; margin-top: 2px;
}
.col-interpretasi .info-list li svg { stroke: var(--green5); }
.col-rekomendasi  .info-list li svg { stroke: var(--bl5); }

/* ── ACTION BAR ───────────────────────────────────────────── */
.action-bar {
    padding: 1.75rem 2.5rem;
    border-top: 1px solid var(--g2);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    background: var(--g1);
}

/* ── BUTTON ───────────────────────────────────────────────── */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.45rem;
    padding: 0.7em 1.5em;
    border-radius: 12px;
    font-size: 0.88rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    font-family: inherit;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
}
.btn svg {
    width: 15px; height: 15px;
    stroke: currentColor; fill: none;
    stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    flex-shrink: 0;
}
.btn:active { transform: translateY(0); }

.btn-primary {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    color: var(--wh);
    box-shadow: 0 3px 12px rgba(40,114,232,0.35);
}
.btn-primary:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 5px 18px rgba(40,114,232,0.45);
    transform: translateY(-2px);
    color: var(--wh);
}

.btn-outline {
    background: var(--wh);
    color: var(--g8);
    border: 1.5px solid var(--g2);
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.btn-outline:hover {
    background: var(--g1);
    border-color: var(--g4);
    color: var(--g8);
    box-shadow: 0 4px 12px rgba(0,0,0,0.10);
    transform: translateY(-1px);
}

.btn-success {
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: var(--wh);
    box-shadow: 0 3px 12px rgba(22, 163, 74, 0.35);
}
.btn-success:hover {
    background: linear-gradient(135deg, #15803d, #16a34a);
    box-shadow: 0 5px 18px rgba(22, 163, 74, 0.45);
    transform: translateY(-2px);
    color: var(--wh);
}

/* Psikolog — ungu/violet */
.btn-psikolog {
    background: linear-gradient(135deg, #7c3aed, #a855f7);
    color: var(--wh);
    box-shadow: 0 3px 12px rgba(124, 58, 237, 0.35);
}
.btn-psikolog:hover {
    background: linear-gradient(135deg, #6d28d9, #7c3aed);
    box-shadow: 0 5px 18px rgba(124, 58, 237, 0.45);
    transform: translateY(-2px);
    color: var(--wh);
}

/* ── FOOTER LAPORAN ───────────────────────────────────────── */
.laporan-footer {
    padding: 1.1rem 2.5rem;
    border-top: 1px solid var(--g2);
    text-align: center;
    background: var(--wh);
}
.laporan-footer p {
    font-size: 0.72rem;
    color: var(--g4);
}

/* ── TABEL DETAIL ─────────────────────────────────────────── */
.detail-card {
    background: var(--wh);
    border-radius: var(--r-xl);
    border: 1px solid var(--g2);
    box-shadow: var(--sh-md);
    overflow: hidden;
    margin-top: 1.5rem;
}
.detail-card-header {
    padding: 1.25rem 2rem;
    border-bottom: 1px solid var(--g2);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    font-weight: 800;
    color: var(--g8);
}
.detail-card-header::before {
    content: '';
    display: inline-block;
    width: 4px; height: 1.1em;
    background: linear-gradient(180deg, var(--bl5), var(--bl4));
    border-radius: 2px;
    flex-shrink: 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
}
.table thead tr { background: linear-gradient(90deg, var(--bl9), var(--bl7)); }
.table thead th {
    padding: 0.85rem 1rem;
    color: var(--wh);
    font-weight: 600;
    text-align: left;
    font-size: 0.78rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    white-space: nowrap;
}
.table thead th:nth-child(1),
.table thead th:nth-child(4),
.table tbody td:nth-child(1),
.table tbody td:nth-child(4) { text-align: center; }

.table tbody tr { border-bottom: 1px solid var(--g2); transition: background var(--tr); }
.table tbody tr:last-child { border-bottom: none; }
.table tbody tr:hover { background: var(--bl0); }
.table tbody td {
    padding: 0.85rem 1rem;
    color: var(--g8);
    vertical-align: middle;
    line-height: 1.55;
}
.table tbody td:first-child {
    font-weight: 700; color: var(--g4);
    font-size: 0.82rem; width: 48px;
}
.table tbody td:nth-child(2) { min-width: 260px; }
.table tbody td:nth-child(3) { white-space: nowrap; }
.table tbody td:nth-child(4) {
    font-weight: 800; font-size: 1rem; color: var(--bl5);
}

.kategori-pill {
    display: inline-flex;
    align-items: center;
    padding: 0.22em 0.75em;
    border-radius: 999px;
    font-size: 0.73rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    background: var(--bl0);
    color: var(--bl7);
    border: 1px solid var(--bl1);
    white-space: nowrap;
}

/* ── RESPONSIVE ───────────────────────────────────────────── */
@media (max-width: 768px) {
    .laporan-wrapper { padding: 1rem 0.75rem 2rem; }
    .laporan-header  { padding: 1.5rem 1.25rem 1.25rem; }
    .section-label   { padding: 1.25rem 1.25rem 0.6rem; }

    .analisis-box {
        flex-direction: column;
        margin: 0 1rem 1.25rem;
    }
    .skor-visual {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid var(--g2);
        flex-direction: row;
        padding: 1.25rem 1.5rem;
        gap: 1.25rem;
        justify-content: flex-start;
    }
    .skor-detail { padding: 1.25rem 1.5rem; }

    .info-grid { grid-template-columns: 1fr; }
    .info-col:first-child { border-right: none; border-bottom: 1px solid var(--g2); }
    .info-col { padding: 1.25rem 1.5rem; }

    .action-bar {
        padding: 1.25rem 1.5rem;
        flex-direction: column;
    }
    .btn { width: 100%; justify-content: center; }

    .laporan-footer { padding: 1rem 1.25rem; }
    .detail-card { border-radius: var(--r-lg); margin-top: 1rem; }
    .detail-card-header { padding: 1rem 1.25rem; }
    .table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .laporan-wrapper { padding: 1.5rem 1.25rem 2.5rem; }
}
</style>
@endsection

@section('content')
@php
    $level         = $percobaan->levelRisiko->nama_level;
    $slug          = strtolower(str_replace(' ', '-', $level));
    $skor          = $percobaan->total_skor;
    $maxSkor = 100;
    $pct = $skor;
    $circumference = 2 * M_PI * 42;
    $offset        = $circumference - ($pct / 100) * $circumference;

    $statusMap = [
        'rendah'        => 'Status Mental Stabil',
        'sedang'        => 'Perlu Perhatian',
        'tinggi'        => 'Risiko Burnout Tinggi',
    ];
    $statusTitle = $statusMap[$slug] ?? $level;

    $rekomendasiMap = [
        'rendah'        => [
            'Pertahankan pola istirahat dan manajemen waktu yang sudah Anda terapkan.',
            'Terus lakukan hobi atau kegiatan di luar akademik untuk menjaga keseimbangan.',
            'Lakukan evaluasi mandiri secara berkala setiap akhir semester.',
        ],
        'sedang'        => [
            'Mulai atur ulang jadwal belajar dan istirahat agar lebih seimbang.',
            'Ceritakan kondisi Anda kepada dosen pembimbing atau konselor akademik.',
            'Kurangi beban tugas yang tidak prioritas dan fokus pada kesehatan mental.',
        ],
        'tinggi'        => [
            'Segera konsultasikan kondisi Anda dengan konselor atau psikolog kampus.',
            'Ambil jeda dari aktivitas akademik yang membebani secara berlebihan.',
            'Bangun sistem dukungan sosial dengan teman, keluarga, atau mentor.',
        ],
    ];
    $rekomendasi = $rekomendasiMap[$slug] ?? [];
@endphp

<div class="laporan-wrapper">

    {{-- ═══ LAPORAN UTAMA ═══ --}}
    <div class="laporan-card">

        {{-- Header --}}
        <div class="laporan-header">
            <div class="laporan-header-left">
                <div class="laporan-eyebrow">Laporan Akademik &bull; Official Report</div>
                <div class="laporan-title">Laporan Hasil Deteksi Burnout Akademik</div>
            </div>
            <div class="laporan-date">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8"  y1="2" x2="8"  y2="6"/>
                    <line x1="3"  y1="10" x2="21" y2="10"/>
                </svg>
                {{ $percobaan->created_at->translatedFormat('d F Y') }}
            </div>
        </div>

        {{-- Section Label --}}
        <div class="section-label">Hasil Analisis</div>

        {{-- Analisis Box --}}
        <div class="analisis-box">

            {{-- Kiri: Lingkaran Skor --}}
            <div class="skor-visual">
                <div class="skor-ring">
                    <svg viewBox="0 0 100 100">
                        <circle class="skor-ring-bg" cx="50" cy="50" r="42"/>
                        <circle class="skor-ring-fill ring-{{ $slug }}"
                                cx="50" cy="50" r="42"
                                stroke-dasharray="{{ $circumference }}"
                                stroke-dashoffset="{{ $offset }}"
                                id="skorRingFill"/>
                    </svg>
                    <div class="skor-ring-text">
                        <span class="skor-angka">{{ $skor }}</span>
                        <span class="skor-max">Skor</span>
                    </div>
                </div>
                <span class="skor-caption">Skor Burnout</span>
            </div>

            {{-- Kanan: Status & Deskripsi --}}
            <div class="skor-detail">
                <span class="badge badge-{{ $slug }}">{{ $level }}</span>
                <div class="status-title">{{ $statusTitle }}</div>
                <p class="status-desc">{{ $percobaan->levelRisiko->deskripsi }}</p>
            </div>

        </div>

        {{-- Interpretasi & Rekomendasi --}}
        <div class="info-grid">
            <div class="info-col col-interpretasi">
                <div class="info-col-title">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8"  x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Interpretasi Skor
                </div>
                <ul class="info-list">
                    @foreach(explode('.', $percobaan->levelRisiko->deskripsi) as $kalimat)
                        @if(trim($kalimat))
                            <li>
                                <svg viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                {{ trim($kalimat) }}.
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="info-col col-rekomendasi">
                <div class="info-col-title">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8"  x2="12" y2="16"/>
                        <line x1="8"  y1="12" x2="16" y2="12"/>
                    </svg>
                    Rekomendasi
                </div>
                <ul class="info-list">
                    @foreach($rekomendasi as $item)
                        <li>
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="1" fill="currentColor"/>
                                <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                            </svg>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Action Bar --}}
        <div class="action-bar">
            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-outline">
                <svg viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12"/>
                    <polyline points="12 19 5 12 12 5"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <a href="{{ route('mahasiswa.tes.index') }}" class="btn btn-primary">
                <svg viewBox="0 0 24 24">
                    <polyline points="1 4 1 10 7 10"/>
                    <path d="M3.51 15a9 9 0 1 0 .49-4"/>
                </svg>
                Tes Ulang
            </a>
            <a href="{{ route('mahasiswa.tes.pdf', $percobaan->id) }}" class="btn btn-success">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Download PDF
            </a>

            {{-- Hanya tampil jika level sedang/tinggi/sangat tinggi --}}
            @if(in_array($slug, ['sedang', 'tinggi']))
            <a href="https://himpsi.or.id/cari-psikolog"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-psikolog">
                Cari Psikolog HIMPSI
            </a>
            @endif
        </div>

        {{-- Footer Laporan --}}
        <div class="laporan-footer">
            <p>
                &copy; {{ date('Y') }} Sistem Deteksi Burnout Akademik &bull;
                Diselesaikan pada {{ $percobaan->created_at->translatedFormat('d F Y, H:i') }} WIB
            </p>
        </div>

    </div>

    {{-- ═══ TABEL DETAIL JAWABAN ═══ --}}
    <div class="detail-card">
        <div class="detail-card-header">Detail Jawaban</div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Kategori</th>
                    <th>Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($percobaan->jawaban as $index => $jawaban)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jawaban->soal->pertanyaan }}</td>
                        <td>
                            <span class="kategori-pill">
                                {{ $jawaban->soal->kategori }}
                            </span>
                        </td>
                        <td>{{ $jawaban->skor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ring = document.getElementById('skorRingFill');
        if (!ring) return;
        const final = parseFloat(ring.getAttribute('stroke-dashoffset'));
        const circ  = parseFloat(ring.getAttribute('stroke-dasharray'));
        ring.style.strokeDashoffset = circ;
        requestAnimationFrame(() => {
            ring.style.transition = 'stroke-dashoffset 1.2s cubic-bezier(.4,0,.2,1)';
            ring.style.strokeDashoffset = final;
        });
    });
</script>
@endsection