@extends('layouts.app')

@section('title', 'Daftar Mahasiswa Bimbingan - ' . $dosen->name)

@section('styles')
<style>
/* ============================================================
   kaprodi/mahasiswa.blade.php â€” Custom CSS
   Theme  : Blue & White | Elegant Gradient | Modern Responsive
   Konsisten dengan seluruh halaman sistem
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
    --r-sm : 8px;
    --r-lg : 20px;
    --sh-md: 0 4px 16px rgba(40, 114, 232, 0.12);
    --sh-lg: 0 8px 32px rgba(40, 114, 232, 0.18);
    --tr   : 0.22s cubic-bezier(.4, 0, .2, 1);
}

/* â”€â”€ PAGE TITLE â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
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

/* â”€â”€ CARD â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
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

/* Card tombol aksi (last) â€” dark bg, row layout */
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

/* â”€â”€ TABLE â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
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

/* No, Skor, Kelas rata tengah */
.table thead th:nth-child(1),
.table thead th:nth-child(4),
.table thead th:nth-child(5),
.table tbody td:nth-child(1),
.table tbody td:nth-child(4),
.table tbody td:nth-child(5) {
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
    line-height: 1.5;
}

/* Kolom No */
.table tbody td:nth-child(1) {
    font-weight: 700;
    color: var(--g4);
    font-size: 0.82rem;
    width: 48px;
}

/* Kolom Nama â€” bold biru */
.table tbody td:nth-child(2) {
    font-weight: 700;
    color: var(--bl9);
}

/* Kolom Email â€” monospace tipis */
.table tbody td:nth-child(3) {
    font-size: 0.83rem;
    color: var(--g6);
    font-family: 'Courier New', monospace;
}

/* Kolom Kelas â€” pill */
.table tbody td:nth-child(4) {
    text-align: center;
}

.kelas-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.2em 0.7em;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    background: var(--g2);
    color: var(--g6);
    border: 1px solid var(--g2);
    letter-spacing: 0.03em;
}

/* Kolom Skor â€” angka besar biru */
.table tbody td:nth-child(5) {
    font-weight: 800;
    font-size: 1rem;
    color: var(--bl5);
}

/* Kolom Level Risiko */
.table tbody td:nth-child(6) {
    white-space: nowrap;
}

/* â”€â”€ BADGE LEVEL RISIKO â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.3em 0.9em;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.badge-rendah        { background: #dcfce7; color: #15803d; }
.badge-sedang        { background: #fef9c3; color: #a16207; }
.badge-tinggi        { background: #fee2e2; color: #b91c1c; }
.badge-sangat-tinggi { background: #fce7f3; color: #be185d; }
.badge-secondary     { background: var(--g2); color: var(--g6); }

/* â”€â”€ EMPTY STATE â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--g4);
}
.empty-state svg {
    width: 48px; height: 48px;
    stroke: var(--g2);
    margin-bottom: 0.75rem;
}
.empty-state p {
    font-size: 0.88rem;
    font-weight: 500;
}

/* â”€â”€ PAGINATION â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
nav[aria-label="pagination"],
.pagination-wrapper {
    display: flex;
    justify-content: center;
}

nav[role="navigation"] span[aria-current="page"] span,
nav[role="navigation"] span[aria-current="page"] button {
    background: linear-gradient(135deg, var(--bl5), var(--bl4)) !important;
    color: var(--wh) !important;
    border-color: transparent !important;
    box-shadow: 0 2px 8px rgba(40,114,232,0.3);
}

nav[role="navigation"] a {
    color: var(--bl7) !important;
    border-color: var(--g2) !important;
    transition: background var(--tr), color var(--tr), border-color var(--tr);
}
nav[role="navigation"] a:hover {
    background: var(--bl0) !important;
    border-color: var(--bl4) !important;
    color: var(--bl5) !important;
}

.pagination {
    display: flex;
    gap: 0.3rem;
    list-style: none;
    padding: 0;
    flex-wrap: wrap;
    justify-content: center;
}
.pagination li a,
.pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px; height: 36px;
    padding: 0 0.6em;
    border-radius: var(--r-sm);
    font-size: 0.83rem;
    font-weight: 600;
    border: 1.5px solid var(--g2);
    background: var(--wh);
    color: var(--g6);
    text-decoration: none;
    transition: background var(--tr), color var(--tr),
                border-color var(--tr), box-shadow var(--tr);
}
.pagination li a:hover {
    background: var(--bl0);
    border-color: var(--bl4);
    color: var(--bl5);
}
.pagination li.active span,
.pagination li span[aria-current] {
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    border-color: transparent;
    color: var(--wh);
    box-shadow: 0 2px 8px rgba(40,114,232,0.3);
}
.pagination li.disabled span {
    opacity: 0.4;
    cursor: not-allowed;
}

/* â”€â”€ BUTTON â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.55em 1.35em;
    border-radius: var(--r-sm);
    font-size: 0.88rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    background: rgba(255,255,255,0.14);
    color: var(--wh);
    border: 1.5px solid rgba(255,255,255,0.35);
}
.btn:hover {
    background: rgba(255,255,255,0.26);
    border-color: rgba(255,255,255,0.6);
    transform: translateY(-1px);
    color: var(--wh);
}
.btn:active { transform: translateY(0); }

/* â”€â”€ RESPONSIVE â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
@media (max-width: 768px) {
    h1 { margin-bottom: 1.25rem; }

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

    .card:first-of-type > div:last-child {
        padding: 0 1.25rem;
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
}

@media (min-width: 769px) and (max-width: 1024px) {
    .card { padding: 1.5rem; }
}
</style>
@endsection

@section('content')
<h1>Daftar Mahasiswa Bimbingan: {{ $dosen->name }}</h1>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>Angkatan</th>
                <th>Skor Terbaru</th>
                <th>Level Risiko</th>
                <th>Indikator Tertinggi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswa as $index => $mhs)
                <tr>
                    <td>{{ $mahasiswa->firstItem() + $index }}</td>
                    <td>{{ $mhs->name }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td>
                        @php
                            $kelasLabel = '-';
                            if ($mhs->kelas == 5) {
                                $kelasLabel = 'Kelas A';
                            } elseif ($mhs->kelas == 6) {
                                $kelasLabel = 'Kelas B';
                            } elseif ($mhs->kelas == 7) {
                                $kelasLabel = 'Kelas C';
                            } elseif ($mhs->kelas == 8) {
                                $kelasLabel = 'Kelas D';
                            } elseif ($mhs->kelas == 9) {
                                $kelasLabel = 'Kelas E';
                            }
                        @endphp
                        <span class="kelas-pill">
                            {{ $kelasLabel }}
                        </span>
                    </td>
                    <td>{{ $mhs->angkatan ?? '-' }}</td>
                    <td>
                        @if ($mhs->percobaanTes->first())
                            {{ $mhs->percobaanTes->first()->total_skor }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($mhs->percobaanTes->first())
                            <span class="badge badge-{{ strtolower(str_replace(' ', '-', $mhs->percobaanTes->first()->levelRisiko->nama_level)) }}">
                                {{ $mhs->percobaanTes->first()->levelRisiko->nama_level }}
                            </span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($mhs->percobaanTes->first())
                            @php
                                $dimScores = $mhs->percobaanTes->first()->calculateDimensionScores();
                                $topDim = $dimScores ? $dimScores->first() : null;
                            @endphp
                            @if($topDim)
                                <span class="badge badge-{{ strtolower(str_replace(' ', '-', $topDim['level'])) }}">
                                    {{ $topDim['kategori'] }} ({{ $topDim['percent'] }}%)
                                </span>
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            <p>Belum ada mahasiswa bimbingan.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1.5rem;">
        {{ $mahasiswa->links() }}
    </div>
</div>

<div class="card">
    <a href="{{ route('kaprodi.statistik') }}" class="btn">
        Kembali 
    </a>
</div>
@endsection
