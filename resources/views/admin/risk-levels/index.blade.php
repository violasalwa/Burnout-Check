@extends('layouts.app')

@section('title', 'Kelola Level Risiko')

@section('styles')
<style>
/* ============================================================
   admin/risk-levels/index.blade.php — Custom CSS
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

/* ── 2. PAGE TITLE ───────────────────────────────────────── */
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

/* Card pertama — tombol tambah */
.card:first-of-type {
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    padding: 1.25rem 1.75rem;
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 100%);
    border-color: transparent;
}

.card:first-of-type:hover { transform: none; }

/* Card terakhir — tombol kembali */
.card:last-of-type {
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.75rem;
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl7) 100%);
    border-color: transparent;
}

.card:last-of-type:hover { transform: none; }

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

/* Rentang Skor & Aksi rata tengah */
.table thead th:nth-child(2),
.table thead th:nth-child(4),
.table tbody td:nth-child(2),
.table tbody td:nth-child(4) {
    text-align: center;
}

.table tbody tr {
    border-bottom: 1px solid var(--g2);
    transition: background var(--tr);
}

.table tbody tr:last-child { border-bottom: none; }
.table tbody tr:hover { background: var(--bl0); }

.table tbody td {
    padding: 0.9rem 1rem;
    color: var(--g8);
    vertical-align: middle;
}

/* Kolom Level */
.table tbody td:nth-child(1) {
    width: 140px;
}

/* Rentang Skor — bold biru */
.table tbody td:nth-child(2) {
    font-weight: 700;
    font-size: 0.9rem;
    color: var(--bl7);
    white-space: nowrap;
    letter-spacing: 0.02em;
}

/* Deskripsi */
.table tbody td:nth-child(3) {
    line-height: 1.6;
    color: var(--g6);
    font-size: 0.85rem;
    min-width: 220px;
}

/* Aksi — samping-sampingan, tidak wrap */
.table tbody td:nth-child(4) {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    flex-wrap: nowrap;
    white-space: nowrap;
}

/* ── 5. BADGE LEVEL ──────────────────────────────────────── */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.32em 0.9em;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.05em;
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
    gap: 0.35rem;
    padding: 0.55em 1.35em;
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
    box-shadow: 0 2px 8px rgba(40, 114, 232, 0.25);
}

.btn:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 4px 14px rgba(40, 114, 232, 0.38);
    transform: translateY(-1px);
    color: var(--wh);
}

.btn:active { transform: translateY(0); }

/* Small — ukuran sama, lebar minimum sama */
.btn-sm {
    padding: 0.38em 1em;
    font-size: 0.78rem;
    border-radius: 6px;
    min-width: 68px;
    height: 32px;
}

/* Tambah Level — putih di atas card gelap */
.card:first-of-type .btn-success {
    background: var(--wh);
    color: var(--bl7);
    border: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
}

.card:first-of-type .btn-success:hover {
    background: var(--bl0);
    color: var(--bl9);
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    transform: translateY(-1px);
}

/* Edit — biru */
.btn-warning {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    box-shadow: 0 2px 8px rgba(40, 114, 232, 0.25);
    color: var(--wh);
}

.btn-warning:hover {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    box-shadow: 0 4px 14px rgba(40, 114, 232, 0.38);
    color: var(--wh);
}

/* Hapus — merah */
.btn-danger {
    background: linear-gradient(135deg, #dc2626, #f87171);
    box-shadow: 0 2px 8px rgba(220, 38, 38, 0.28);
    color: var(--wh);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #b91c1c, #dc2626);
    box-shadow: 0 4px 14px rgba(220, 38, 38, 0.38);
    color: var(--wh);
}

/* Tombol Kembali di card terakhir */
.card:last-of-type .btn {
    background: rgba(255, 255, 255, 0.14);
    color: var(--wh);
    box-shadow: none;
    border: 1.5px solid rgba(255, 255, 255, 0.35);
}

.card:last-of-type .btn:hover {
    background: rgba(255, 255, 255, 0.26);
    border-color: rgba(255, 255, 255, 0.6);
    transform: translateY(-1px);
}

/* ── 7. RESPONSIVE ───────────────────────────────────────── */
@media (max-width: 768px) {
    h1 { margin-bottom: 1.25rem; }

    .card:first-of-type,
    .card:last-of-type {
        padding: 1.25rem;
    }

    .card:first-of-type .btn-success,
    .card:last-of-type .btn {
        width: 100%;
        justify-content: center;
        padding: 0.75em 1.25em;
    }

    .card:nth-of-type(2) {
        padding: 1.25rem 0;
        overflow: hidden;
    }

    .table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding: 0 1.25rem;
    }

    /* Tetap flex tapi boleh wrap di layar sangat kecil */
    .table tbody td:nth-child(4) {
        flex-wrap: wrap;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .card { padding: 1.5rem; }
}
</style>
@endsection

@section('content')
<h1>Kelola Level Risiko</h1>

<div class="card">
    <a href="{{ route('admin.risk-levels.create') }}" class="btn btn-success">
        + Tambah Level
    </a>
</div>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Level</th>
                <th>Rentang Skor</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($levels as $level)
                <tr>
                    <td>
                        <span class="badge badge-{{ strtolower(str_replace(' ', '-', $level->nama_level)) }}">
                            {{ $level->nama_level }}
                        </span>
                    </td>

                    <td>{{ $level->skor_min }} - {{ $level->skor_max }}</td>

                    <td>{{ $level->deskripsi }}</td>

                    <td>
                        <a href="{{ route('admin.risk-levels.edit', $level->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.risk-levels.destroy', $level->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus level ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <a href="{{ route('admin.dashboard') }}" class="btn">Kembali</a>
</div>
@endsection