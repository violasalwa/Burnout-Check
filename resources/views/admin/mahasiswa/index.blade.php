@extends('layouts.app')

@section('title', 'Data Mahasiswa per Dosen')

@section('styles')
<style>
/* ============================================================
   admin/mahasiswa/index.blade.php — Custom CSS
   Theme  : Blue & White | Filter Mahasiswa oleh Dosen
   ============================================================ */

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

h1 {
    font-size: clamp(1.35rem, 3vw, 1.9rem);
    font-weight: 700;
    color: var(--bl9);
    letter-spacing: -0.02em;
    padding-bottom: 0.6rem;
    border-bottom: 3px solid var(--bl1);
    margin-bottom: 1.5rem;
}

.card {
    background: var(--wh);
    border-radius: var(--r-lg);
    padding: 1.75rem;
    box-shadow: var(--sh-md);
    border: 1px solid var(--bl1);
    margin-bottom: 1.5rem;
}

.form-filter {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1rem;
    align-items: center;
    margin-bottom: 1.5rem;
}

.select-field {
    width: 100%;
    padding: 0.4rem 0.9rem;
    height: 40px;
    line-height: 1.2;
    border: 1px solid var(--g2);
    border-radius: 8px;
    background: var(--g1);
    color: var(--g8);
    font-size: 0.95rem;
    box-sizing: border-box;
    display: inline-flex;
    align-items: center;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.4rem 0.8rem;
    min-width: 0;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--bl5), var(--bl4));
    border: none;
    color: var(--wh);
    font-weight: 700;
    font-size: 0.92rem;
    cursor: pointer;
    transition: transform var(--tr), box-shadow var(--tr), filter var(--tr);
    box-shadow: 0 6px 12px rgba(40, 114, 232, 0.06);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 40px;
}
.btn:hover {
    transform: translateY(-1px);
    filter: brightness(1.05);
}

.btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.4rem 0.8rem;
    min-width: 0;
    border-radius: 8px;
    border: 1px solid rgba(71, 85, 105, 0.12);
    background: #475569;
    color: var(--wh);
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: transform var(--tr), box-shadow var(--tr), filter var(--tr), background var(--tr);
    box-shadow: 0 6px 12px rgba(15, 23, 42, 0.06);
    height: 40px;
}
.btn-secondary:hover {
    transform: translateY(-1px);
    filter: brightness(1.08);
}

.action-buttons {
    display:flex;
    gap:0.75rem;
    flex-wrap:wrap;
    justify-content:flex-end;
}
.action-buttons .btn, .action-buttons .btn-secondary {
    flex: 0 0 auto;
    min-width: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0.4rem 0.8rem;
    font-size: 0.92rem;
}
@media (max-width: 960px) {
    .action-buttons .btn, .action-buttons .btn-secondary { flex: 1 1 100%; min-width:0; }
}

.select-field {
    transition: border-color var(--tr), box-shadow var(--tr), background var(--tr);
}
.select-field:focus {
    outline: none;
    border-color: var(--bl5);
    box-shadow: 0 0 0 4px rgba(40, 114, 232, 0.12);
    background: #ffffff;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    font-size: 0.92rem;
    min-width: 100%;
    border-radius: var(--r-sm);
    overflow: hidden;
    box-shadow: 0 12px 24px rgba(15, 23, 42, 0.04);
}

.table thead {
    background: linear-gradient(90deg, var(--bl5), var(--bl4));
    color: var(--wh);
}

.table th,
.table td {
    padding: 1rem 1.15rem;
    border-bottom: 1px solid var(--g2);
}

.table tbody tr:hover {
    background: rgba(66, 113, 255, 0.06);
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.28em 0.85em;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}
.badge-rendah { background: #dcfce7; color: #15803d; }
.badge-sedang { background: #fef9c3; color: #a16207; }
.badge-tinggi { background: #fee2e2; color: #b91c1c; }
.badge-secondary { background: var(--g2); color: var(--g6); }

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--g4);
    background: var(--g1);
    border-radius: var(--r-sm);
}

.pagination {
    margin-top: 1.25rem;
    display: flex;
    justify-content: flex-end;
}

@media (max-width: 960px) {
    .form-filter { grid-template-columns: 1fr; }
    .btn { width: 100%; }
}

@media (max-width: 760px) {
    .table { display: block; overflow-x: auto; }
}
</style>
@endsection

@section('content')
<h1>Mahasiswa Berdasarkan Dosen Pembimbing</h1>
<div class="card">
    <form class="form-filter" method="GET" action="{{ route('admin.mahasiswa.index') }}">
        <div class="filter-label">
            <label for="dosen_id" style="font-weight:700; color:#334155; margin:0;">Pilih Dosen Pembimbing</label>
        </div>
        <div>
            <select id="dosen_id" name="dosen_id" class="select-field" required>
                <option value="">-- Pilih Dosen Pembimbing --</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ optional($selectedDosen)->id == $dosen->id ? 'selected' : '' }}>
                        {{ $dosen->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="action-buttons">
            <button type="submit" class="btn">Lihat Mahasiswa</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Dashboard</a>
        </div>
    </form>

    @if ($selectedDosen)
        <div style="margin-bottom: 1rem; color: var(--g6);">
            Menampilkan mahasiswa bimbingan <strong>{{ $selectedDosen->name }}</strong>.
        </div>
    @endif

    @if ($selectedDosen && $mahasiswas)
        @if ($mahasiswas->count())
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $index => $mahasiswa)
                        <tr>
                            <td>{{ $mahasiswas->firstItem() + $index }}</td>
                            <td>{{ $mahasiswa->name }}</td>
                            <td>{{ $mahasiswa->email }}</td>
                            <td>{{ $mahasiswa->kelas ? 'Kelas ' . chr(60 + $mahasiswa->kelas) : '-' }}</td>
                            <td>{{ $mahasiswa->angkatan ?? '-' }}</td>
                            <td>{{ optional($mahasiswa->percobaanTes->first())->total_skor ?? '-' }}</td>
                            <td>
                                @if ($mahasiswa->percobaanTes->first()?->levelRisiko)
                                    <span class="badge badge-{{ strtolower(str_replace(' ', '-', $mahasiswa->percobaanTes->first()->levelRisiko->nama_level)) }}">
                                        {{ $mahasiswa->percobaanTes->first()->levelRisiko->nama_level }}
                                    </span>
                                @else
                                    <span class="badge badge-secondary">Belum Tes</span>
                                @endif
                            </td>
                            <td>
                                @if ($mahasiswa->percobaanTes->first())
                                    @php
                                        $dimScores = $mahasiswa->percobaanTes->first()->calculateDimensionScores();
                                        $topDim = $dimScores ? $dimScores->first() : null;
                                    @endphp
                                    @if($topDim)
                                        <span class="badge badge-{{ strtolower(str_replace(' ', '-', $topDim['level'])) }}">
                                            {{ $topDim['kategori'] }} ({{ $topDim['percent'] }}%)
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">-</span>
                                    @endif
                                @else
                                    <span class="badge badge-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($mahasiswa->percobaanTes->first())
                                    <a href="{{ route('admin.hasil.download', $mahasiswa->percobaanTes->first()->id) }}" class="btn" style="padding:0.55rem 0.85rem; font-size:0.8rem; background: linear-gradient(135deg, var(--bl5), var(--bl4)); color: var(--wh); text-decoration:none;">
                                        Download PDF
                                    </a>
                                @else
                                    <span class="badge badge-secondary">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $mahasiswas->links() }}
            </div>
        @else
            <div class="empty-state">
                <p>Tidak ditemukan mahasiswa untuk dosen pembimbing ini.</p>
            </div>
        @endif
    @else
        <div class="empty-state">
            <p>Silakan pilih dosen pembimbing terlebih dahulu untuk melihat daftar mahasiswa.</p>
        </div>
    @endif
</div>
@endsection
