@extends('layouts.app')

@section('title', 'Riwayat Tes')

@section('styles')
<style>
/* ============================================================
   mahasiswa/history.blade.php — Custom CSS
   Theme  : Blue & White | Elegant Gradient | Modern Responsive
   ============================================================ */

/* ── 1. RESET / BASE ─────────────────────────────────────── */
*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

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
    --r-sm: 8px;
    --r-lg: 20px;
    --sh-md: 0 4px 16px rgba(40, 114, 232, 0.12);
    --sh-lg: 0 8px 32px rgba(40, 114, 232, 0.18);
    --tr  : 0.22s cubic-bezier(.4, 0, .2, 1);
}

/* ── 2. LAYOUT ───────────────────────────────────────────── */
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
    left: 0;
    bottom: -3px;
    width: 56px;
    height: 3px;
    background: linear-gradient(90deg, var(--bl5), var(--bl4));
    border-radius: 2px;
}

/* ── 3. CARD ─────────────────────────────────────────────── */
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

/* Action card (tombol kembali) */
.card:last-of-type {
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.75rem;
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 100%);
    border-color: transparent;
}

.card:last-of-type:hover {
    transform: none;
}

/* ── 4. TABLE ────────────────────────────────────────────── */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.9rem;
}

.table thead th {
    padding: 1rem;
    color: var(--g5);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    text-align: left;
    border-bottom: 2px solid var(--g2);
    white-space: nowrap;
}

.table tbody tr {
    transition: background-color var(--tr);
}

.table tbody tr:hover {
    background-color: var(--g1);
}

.table tbody td {
    padding: 1rem;
    color: var(--g8);
    border-bottom: 1px solid var(--g2);
    vertical-align: middle;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

/* Kolom No. & Skor rata tengah */
.table thead th:nth-child(1),
.table thead th:nth-child(3),
.table tbody td:nth-child(1),
.table tbody td:nth-child(3) {
    text-align: center;
}

/* Skor — bold biru */
.table tbody td:nth-child(3) {
    font-weight: 800;
    color: var(--bl7);
    font-size: 1.05rem;
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--g5);
}

/* ── 5. BADGE ────────────────────────────────────────────── */
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
.badge-sangat-tinggi { background: #fce7f3; color: #be185d; }
.badge-secondary     { background: var(--g2); color: var(--g6); }

/* ── 6. BUTTON ───────────────────────────────────────────── */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.45em 1.1em;
    border-radius: var(--r-sm);
    font-size: 0.82rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    color: var(--wh);
    box-shadow: 0 2px 8px rgba(40, 114, 232, 0.25);
}

.btn:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 4px 14px rgba(40, 114, 232, 0.38);
    transform: translateY(-1px);
    color: var(--wh);
}

.btn:active { transform: translateY(0); }

/* Tombol di action card (dark bg) */
.card:last-of-type .btn {
    background: rgba(255, 255, 255, 0.14);
    color: var(--wh);
    box-shadow: none;
    border: 1.5px solid rgba(255, 255, 255, 0.35);
    padding: 0.55em 1.35em;
    font-size: 0.88rem;
}

.card:last-of-type .btn:hover {
    background: rgba(255, 255, 255, 0.26);
    border-color: rgba(255, 255, 255, 0.6);
    transform: translateY(-1px);
}

/* ── 7. PAGINATION ───────────────────────────────────────── */
/* Override default Laravel pagination */
nav[role="navigation"] {
    display: flex;
    justify-content: center;
}

nav[role="navigation"] > div:first-child {
    display: none; /* sembunyikan "Showing X to Y of Z results" */
}

nav[role="navigation"] span[aria-current="page"] > span,
nav[role="navigation"] a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 0.6em;
    border-radius: var(--r-sm);
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid var(--g2);
    margin: 0 2px;
    transition: background var(--tr), border-color var(--tr), color var(--tr);
}

nav[role="navigation"] a {
    color: var(--g6);
    background: var(--wh);
}

nav[role="navigation"] a:hover {
    background: var(--bl0);
    border-color: var(--bl4);
    color: var(--bl5);
}

nav[role="navigation"] span[aria-current="page"] > span {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    border-color: transparent;
    color: var(--wh);
}

nav[role="navigation"] span > span {
    color: var(--g4);
    background: var(--g1);
    border: 1.5px solid var(--g2);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    border-radius: var(--r-sm);
    font-size: 0.85rem;
    margin: 0 2px;
}

/* ── 8. RESPONSIVE ───────────────────────────────────────── */
@media (max-width: 768px) {
    h1 { margin-bottom: 1.25rem; }

    .card {
        padding: 1.25rem;
    }

    .card:last-of-type {
        flex-direction: column;
        align-items: stretch;
    }

    .card:last-of-type .btn {
        width: 100%;
        justify-content: center;
        padding: 0.75em 1.25em;
    }

    /* Tabel scroll horizontal di mobile */
    .card:first-of-type {
        padding: 1.25rem 0;
        overflow: hidden;
    }

    .table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding: 0 1.25rem;
    }

    nav[role="navigation"] {
        flex-wrap: wrap;
        gap: 4px;
        padding: 0 1.25rem;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .card { padding: 1.5rem; }
}
</style>
@endsection

@section('content')
<h1>Riwayat Tes Burnout</h1>

<div class="card" style="padding: 1.5rem 0;">
    @if ($history->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Tes</th>
                        <th>Skor</th>
                        <th>Level Risiko</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $index => $result)
                        <tr>
                            <td style="font-weight: 600; color: var(--g5);">{{ $history->firstItem() + $index }}</td>
                            <td>
                                <div style="color: var(--g8); font-weight: 600; font-size: 0.95rem;">
                                    {{ $result->created_at->format('d M Y') }}
                                </div>
                                <div style="font-size: 0.75rem; color: var(--g5); margin-top: 2px;">
                                    {{ $result->created_at->format('H:i') }} WIB
                                </div>
                            </td>
                            <td>{{ $result->total_skor }}</td>
                            <td>
                                <span class="badge badge-{{ strtolower(str_replace(' ', '-', $result->levelRisiko->nama_level)) }}">
                                    {{ $result->levelRisiko->nama_level }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('mahasiswa.tes.hasil', $result->id) }}" class="btn">
                                    <svg viewBox="0 0 24 24" width="16" height="16" style="fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round;">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.5rem; padding: 0 1.5rem;">
            {{ $history->links() }}
        </div>
    @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" width="48" height="48" style="margin-bottom: 1rem; fill: none; stroke: var(--g4); stroke-width: 1.5;">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <p style="font-size: 1.1rem; font-weight: 700; color: var(--g8);">Belum Ada Riwayat Tes</p>
            <p style="font-size: 0.9rem; margin-top: 0.5rem;">Anda belum pernah mengikuti tes burnout.</p>
        </div>
    @endif
</div>

<div class="card">
    <a href="{{ route('mahasiswa.dashboard') }}" class="btn">Kembali ke Dashboard</a>
</div>
@endsection
