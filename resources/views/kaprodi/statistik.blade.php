@extends('layouts.app')

@section('title', 'Statistik Keseluruhan')

@section('styles')
<style>
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
    --r-sm : 8px;
    --r-lg : 20px;
    --sh-md: 0 4px 16px rgba(40, 114, 232, 0.12);
    --sh-lg: 0 8px 32px rgba(40, 114, 232, 0.18);
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
    left: 0;
    bottom: -3px;
    width: 56px;
    height: 3px;
    background: linear-gradient(90deg, var(--bl5), var(--bl4));
}

.card {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    margin-bottom: 1.75rem;
}

.card:last-of-type {
    background: linear-gradient(135deg, var(--bl9), var(--bl7));
}

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
}

.table tbody tr {
    border-bottom: 1px solid var(--g2);
}

.table tbody tr:hover {
    background: var(--bl0);
}

.table tbody td {
    padding: 0.9rem 1rem;
    color: var(--g8);
}

.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.3em 0.9em;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    white-space: nowrap;
}

.badge-rendah {
    background: #dcfce7;
    color: #15803d;
}

.badge-sedang {
    background: #fef9c3;
    color: #a16207;
}

.badge-tinggi {
    background: #fee2e2;
    color: #b91c1c;
}

.badge-sangat-tinggi {
    background: #fce7f3;
    color: #be185d;
}

.badge-belum {
    background: #e5e7eb;
    color: #4b5563;
    padding: 8px 16px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.7em 1.4em;
    border-radius: var(--r-sm);
    text-decoration: none;
    font-weight: 600;
    background: rgba(255,255,255,0.15);
    color: white;
    border: 1px solid rgba(255,255,255,0.3);
}

.btn:hover {
    background: rgba(255,255,255,0.25);
}

/* ── PAGINATION ──────────────────────────────────────────── */
nav[role="navigation"] {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    margin-top: 1.5rem;
}
nav[role="navigation"] > div:first-child {
    font-size: 0.83rem;
    color: var(--g6);
    font-weight: 500;
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
    transition: background 0.2s, border-color 0.2s, color 0.2s;
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

.no-dosen {
    color: var(--g4);
    font-style: italic;
}

@media (max-width: 768px) {

    .card {
        padding: 1rem;
        overflow-x: auto;
    }

    .table {
        min-width: 900px;
    }

    .btn {
        width: 100%;
    }
}
</style>
@endsection

@section('content')

<h1>Statistik Keseluruhan Mahasiswa</h1>

<div class="card">

    <table class="table">

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Kelas</th>
                <th>Angkatan</th>
                <th>Email</th>
                <th>Dosen Pembimbing</th>
                <th>Tanggal Tes Terakhir</th>
                <th>Skor</th>
                <th>Level Risiko</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($mahasiswa as $mhs)

                @php
                    $tesTerakhir = $mhs->percobaanTes
                        ->sortByDesc('created_at')
                        ->first();
                @endphp

                <tr>

                    <td>
                        {{ ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() + $loop->iteration }}
                    </td>

                    <td>
                        {{ $mhs->name }}
                    </td>

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
                        {{ $kelasLabel }}
                    </td>

                    <td>
                        {{ $mhs->angkatan ?: '-' }}
                    </td>

                    <td>
                        {{ $mhs->email }}
                    </td>

                    <td>
                        @if ($mhs->dosen)
                            {{ $mhs->dosen->name }}
                        @else
                            <span class="no-dosen">
                                Belum ada dosen
                            </span>
                        @endif
                    </td>

                    <td>
                        @if($tesTerakhir)
                            {{ $tesTerakhir->created_at->format('d M Y H:i') }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if($tesTerakhir)
                            {{ $tesTerakhir->total_skor }}
                        @else
                            Belum Tes
                        @endif
                    </td>

                    <td>

                        @if($tesTerakhir && $tesTerakhir->levelRisiko)

                            <span class="badge badge-{{ strtolower(str_replace(' ', '-', $tesTerakhir->levelRisiko->nama_level)) }}">
                                {{ $tesTerakhir->levelRisiko->nama_level }}
                            </span>

                        @else

                            <span class="badge badge-belum">
                                Belum Tes
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9" style="text-align:center;padding:2rem;">
                        Belum ada mahasiswa
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div>
        {{ $mahasiswa->links('vendor.pagination.kaprodi-statistik') }}
    </div>

</div>

<div class="card">

    <a href="{{ route('kaprodi.dashboard') }}" class="btn">
        Kembali
    </a>

</div>

@endsection