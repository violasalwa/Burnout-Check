@extends('layouts.app')

@section('title', 'Hasil Tes Mahasiswa')

@section('styles')
<style>
/* ============================================================
   admin/hasil/index.blade.php — Custom CSS
   ============================================================ */
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
    --g5  : #717a90;
    --g6  : #5a6278;
    --g7  : #3f465a;
    --g8  : #2c3249;
    --r-sm: 8px;
    --r-md: 14px;
    --r-lg: 20px;
    --sh-sm: 0 4px 16px rgba(40, 114, 232, 0.06);
    --sh-md: 0 8px 32px rgba(40, 114, 232, 0.12);
    --tr  : 0.22s cubic-bezier(.4, 0, .2, 1);
}

h1 {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 800;
    color: var(--bl9);
    letter-spacing: -0.02em;
    margin-bottom: 1.75rem;
}

.card {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.75rem;
    box-shadow: var(--sh-sm);
    border: 1px solid var(--g2);
    margin-bottom: 1.5rem;
}

.dosen-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.25rem;
    margin-bottom: 1.5rem;
}

.dosen-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    border-radius: var(--r-md);
    background: var(--wh);
    border: 1px solid var(--g2);
    text-decoration: none;
    color: var(--g8);
    transition: all var(--tr);
    box-shadow: 0 2px 10px rgba(17, 24, 39, 0.02);
}

.dosen-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--sh-sm);
    border-color: var(--bl1);
}

.dosen-card.active {
    background: var(--bl0);
    border-color: var(--bl4);
    box-shadow: 0 4px 16px rgba(40, 114, 232, 0.15);
}

.dosen-card__icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.1rem;
    background: var(--g1);
    color: var(--g6);
    transition: all var(--tr);
}

.dosen-card.active .dosen-card__icon {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    color: var(--wh);
}

.dosen-card__info {
    display: flex;
    flex-direction: column;
}

.dosen-card__name {
    font-weight: 700;
    font-size: 0.95rem;
}

.dosen-card__role {
    font-size: 0.8rem;
    color: var(--g5);
    font-weight: 500;
}

/* ================== Table Styles ================== */
.table-responsive {
    overflow-x: auto;
    margin-top: 1rem;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 1rem 1.25rem;
    text-align: left;
    border-bottom: 1px solid var(--g2);
}

.table th {
    background: var(--g1);
    color: var(--g7);
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.table tbody tr {
    transition: background var(--tr);
}

.table tbody tr:hover {
    background: var(--bl0);
}

.table td {
    font-size: 0.95rem;
    color: var(--g8);
    vertical-align: middle;
}

/* ================== Badges ================== */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.4rem 0.85rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.03em;
    text-transform: uppercase;
}

.badge-rendah { background: #dcfce7; color: #166534; }
.badge-sedang { background: #fef9c3; color: #854d0e; }
.badge-tinggi { background: #fee2e2; color: #991b1b; }
.badge-sangat-tinggi { background: #fecaca; color: #7f1d1d; }

/* ================== Buttons ================== */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    border-radius: 999px;
    font-size: 0.85rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all var(--tr);
}

.btn-primary {
    background: linear-gradient(135deg, var(--bl7), var(--bl5));
    color: var(--wh);
    box-shadow: 0 4px 12px rgba(40, 114, 232, 0.2);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 114, 232, 0.3);
}

.btn-secondary {
    background: var(--g1);
    color: var(--g7);
    border: 1px solid var(--g2);
}

.btn-secondary:hover {
    background: var(--g2);
    color: var(--g8);
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    background: var(--g1);
    border-radius: var(--r-md);
    border: 1px dashed var(--g4);
    color: var(--g6);
}

.pagination {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
}
</style>
@endsection

@section('content')
<h1>Hasil Tes Mahasiswa</h1>

<div class="card">
    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--g8); margin-bottom: 1rem;">
        Pilih Dosen Pembimbing
    </h2>
    <div class="dosen-grid">
        @foreach ($dosens as $dosen)
            <a href="{{ route('admin.mahasiswa.index', ['dosen_id' => $dosen->id]) }}" 
               class="dosen-card {{ optional($selectedDosen)->id == $dosen->id ? 'active' : '' }}">
                <div class="dosen-card__icon">
                    {{ substr($dosen->nama, 0, 1) }}
                </div>
                <div class="dosen-card__info">
                    <span class="dosen-card__name">{{ $dosen->nama }}</span>
                    <span class="dosen-card__role">Dosen Pembimbing</span>
                </div>
            </a>
        @endforeach
    </div>

    <div style="margin-top: 1.5rem; border-top: 1px solid var(--g2); padding-top: 1.5rem;">
        @if ($selectedDosen)
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                <div>
                    <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--g8);">Mahasiswa Bimbingan</h3>
                    <p style="font-size: 0.9rem; color: var(--g6); margin-top: 0.25rem;">
                        Menampilkan hasil tes untuk mahasiswa bimbingan <strong>{{ $selectedDosen->nama }}</strong>
                    </p>
                </div>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">
                    Tampilkan Semua
                </a>
            </div>

            @if ($results && $results->count())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Email</th>
                                <th>Skor Total</th>
                                <th>Level Risiko</th>
                                <th>Indikator Tertinggi</th>
                                <th>Tanggal Tes</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $index => $result)
                                <tr>
                                    <td style="font-weight: 600; color: var(--g5);">
                                        {{ $results->firstItem() + $index }}
                                    </td>
                                    <td style="font-weight: 700;">
                                        {{ $result->user?->name ?? 'Tidak tersedia' }}
                                    </td>
                                    <td style="color: var(--g6);">
                                        {{ $result->user?->email ?? '-' }}
                                    </td>
                                    <td style="font-weight: 800; color: var(--bl9);">
                                        {{ $result->total_skor }}
                                    </td>
                                    <td>
                                        @if ($result->levelRisiko)
                                            @php
                                                $levelClass = strtolower(str_replace(' ', '-', $result->levelRisiko->nama_level));
                                            @endphp
                                            <span class="badge badge-{{ $levelClass }}">
                                                {{ $result->levelRisiko->nama_level }}
                                            </span>
                                        @else
                                            <span style="color: var(--g4);">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $dimScores = $result->calculateDimensionScores();
                                            $topDim = $dimScores ? $dimScores->first() : null;
                                        @endphp
                                        @if($topDim)
                                            <span class="badge badge-{{ strtolower(str_replace(' ', '-', $topDim['level'])) }}">
                                                {{ $topDim['kategori'] }} ({{ $topDim['percent'] }}%)
                                            </span>
                                        @else
                                            <span style="color: var(--g4);">-</span>
                                        @endif
                                    </td>
                                    <td style="color: var(--g6); font-size: 0.85rem;">
                                        {{ $result->created_at->format('d M Y') }}
                                        <div style="font-size: 0.75rem; color: var(--g5);">
                                            {{ $result->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.hasil.download', $result->id) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                                            <svg viewBox="0 0 24 24" width="16" height="16" style="fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round;">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="7 10 12 15 17 10"></polyline>
                                                <line x1="12" y1="15" x2="12" y2="3"></line>
                                            </svg>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    {{ $results->links('vendor.pagination.kaprodi-statistik') }}
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
                    <p style="font-size: 1rem; font-weight: 600;">Tidak Ada Data</p>
                    <p style="font-size: 0.9rem; margin-top: 0.5rem;">Belum ada mahasiswa bimbingan {{ $selectedDosen->nama }} yang melakukan tes.</p>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

