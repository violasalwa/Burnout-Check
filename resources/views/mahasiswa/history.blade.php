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
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
}

.table thead tr {
    background: linear-gradient(90deg, var(--bl9), var(--bl7));
}

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

.table thead th:first-child { border-radius: var(--r-sm) 0 0 var(--r-sm); }
.table thead th:last-child  { border-radius: 0 var(--r-sm) var(--r-sm) 0; }

/* Kolom No. & Skor rata tengah */
.table thead th:nth-child(1),
.table thead th:nth-child(3),
.table tbody td:nth-child(1),
.table tbody td:nth-child(3) {
    text-align: center;
}

.table tbody tr {
    border-bottom: 1px solid var(--g2);
    transition: background var(--tr);
}

.table tbody tr:last-child { border-bottom: none; }

.table tbody tr:hover { background: var(--bl0); }

.table tbody td {
    padding: 0.85rem 1rem;
    color: var(--g8);
    vertical-align: middle;
}

/* Nomor urut */
.table tbody td:first-child {
    font-weight: 700;
    color: var(--g4);
    font-size: 0.82rem;
}

/* Skor — bold biru */
.table tbody td:nth-child(3) {
    font-weight: 700;
    color: var(--bl7);
    font-size: 1rem;
}

/* Empty state */
.card > p {
    color: var(--g4);
    font-size: 0.9rem;
    font-style: italic;
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

<div class="card">
    @if ($history->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Skor</th>
                    <th>Level Risiko</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $index => $result)
                    <tr>
                        <td>{{ $history->firstItem() + $index }}</td>
                        <td>{{ $result->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $result->total_skor }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower(str_replace(' ', '-', $result->levelRisiko->nama_level)) }}">
                                {{ $result->levelRisiko->nama_level }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('mahasiswa.tes.hasil', $result->id) }}" class="btn">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $history->links() }}
        </div>
    @else
        <p>Belum ada riwayat tes.</p>
    @endif
</div>

<div class="card">
    <a href="{{ route('mahasiswa.dashboard') }}" class="btn">Kembali ke Dashboard</a>
</div>
@endsection
