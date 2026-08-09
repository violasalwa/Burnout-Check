@extends('layouts.app')

@section('title', 'Statistik Keseluruhan')

@section('styles')
<style>
.card {
    border-radius: 18px;
    border: 1px solid var(--g2);
    padding: 1.25rem;
    background: white;
    box-shadow: 0 12px 40px rgba(17, 24, 39, 0.04);
}

.chart-card {
    padding: 1.25rem;
}

.chart-wrap {
    position: relative;
    min-height: 360px;
}

.chart-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 1rem;
    color: var(--g7);
}

.legend-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.dot {
    width: 12px;
    height: 12px;
    border-radius: 999px;
    display: inline-block;
}

.dot-low { background: #22c55e; }
.dot-medium { background: #eab308; }
.dot-high { background: #dc2626; }

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 0.75rem;
}

.table th,
.table td {
    padding: 0.95rem 0.85rem;
    text-align: left;
    border-bottom: 1px solid var(--g2);
}

.table th {
    background: #fafafa;
    font-weight: 700;
    color: var(--g7);
}

.table tbody tr:nth-child(even) {
    background: #fbfcff;
}

.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.45rem 0.85rem;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 700;
}

.badge-rendah { background: #d1fae5; color: #047857; }
.badge-sedang { background: #fef9c3; color: #92400e; }
.badge-tinggi,
.badge-sangat-tinggi { background: #fee2e2; color: #991b1b; }

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.85rem 1.1rem;
    border-radius: 999px;
    border: none;
    background: var(--bl7);
    color: white;
    font-weight: 700;
    cursor: pointer;
    transition: transform 0.15s ease, filter 0.15s ease;
}

.btn:hover {
    transform: translateY(-1px);
    filter: brightness(1.05);
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

@section('scripts')
<script>
    (function () {
        const dosenData = @json($dosenData ?? []);

        const combined = dosenData
            .map(d => ({ id: d.id, label: d.name, avg: d.avg || 0, students: d.students || [] }))
            .sort((a, b) => b.avg - a.avg);

        const sortedLabels = combined.map(c => c.label);
        const sortedAvgs = combined.map(c => c.avg);
        const bgColors = combined.map(c => {
            if (c.students.length === 0) return '#e2e8f0';
            if (c.avg <= 40) return '#22c55e';
            if (c.avg <= 70) return '#eab308';
            return '#dc2626';
        });

        if (document.getElementById('dosenCombinedBarChart')) {
            const canvas = document.getElementById('dosenCombinedBarChart');
            canvas.style.height = '400px';
            const ctx = canvas.getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: sortedLabels,
                    datasets: [
                        { 
                            label: 'Rata-rata Skor', 
                            data: sortedAvgs, 
                            backgroundColor: bgColors, 
                            borderRadius: 6 
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { ticks: { autoSkip: false, maxRotation: 45, minRotation: 0 }, grid: { display: false } },
                        y: { beginAtZero: true, max: 100, ticks: { stepSize: 10 }, title: { display: true, text: 'Rentang Skor Burnout' }, grid: { color: 'rgba(15, 23, 42, 0.05)' } }
                    }
                }
            });

            document.getElementById('dosenCombinedBarChart').addEventListener('click', function (evt) {
                const points = chart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
                if (!points.length) return;
                const idx = points[0].index;
                const dosen = combined[idx];
                if (dosen) {
                    window.location.href = `/kaprodi/dosen/${dosen.id}/mahasiswa`;
                }
            });
        }

        document.addEventListener('click', function(e) {
            const card = e.target.closest('.dosen-card');
            if (card) {
                const id = parseInt(card.getAttribute('data-dosen-id'));
                window.location.href = `/kaprodi/dosen/${id}/mahasiswa`;
            }
        });
    })();
</script>
@endsection

@section('content')

<h1>Statistik Keseluruhan Mahasiswa</h1><div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:1.25rem; margin-bottom: 1.5rem;">
    <!-- Stat Box: Total Dosen -->
    <div class="card" style="display:flex; align-items:center; gap:1.25rem;">
        <div style="width:54px;height:54px;border-radius:14px;background:linear-gradient(135deg, var(--bl7), var(--bl5));display:flex;align-items:center;justify-content:center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
        <div>
            <div style="font-size:0.85rem; color:var(--g5); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Total Dosen</div>
            <div style="font-size:1.75rem; font-weight:800; color:var(--g8);">{{ count($dosenData) }}</div>
        </div>
    </div>
    
    <!-- Stat Box: Total Mahasiswa -->
    <div class="card" style="display:flex; align-items:center; gap:1.25rem;">
        <div style="width:54px;height:54px;border-radius:14px;background:linear-gradient(135deg, #0891b2, #06b6d4);display:flex;align-items:center;justify-content:center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
            </svg>
        </div>
        <div>
            <div style="font-size:0.85rem; color:var(--g5); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Total Mahasiswa</div>
            <div style="font-size:1.75rem; font-weight:800; color:var(--g8);">{{ $mahasiswa->total() }}</div>
        </div>
    </div>
</div>

<div class="card chart-card" style="margin-bottom:1.5rem;">
    <h2 style="margin-bottom:0.5rem;">Rata-rata Skor Burnout Mahasiswa Per Dosen</h2>
    <div class="chart-wrap">
        <canvas id="dosenCombinedBarChart"></canvas>
    </div>
    <div class="chart-legend">
        <span class="legend-item"><span class="dot dot-low"></span> Skor Rendah (&lt; 40)</span>
        <span class="legend-item"><span class="dot dot-medium"></span> Skor Sedang (41&ndash;70)</span>
        <span class="legend-item"><span class="dot dot-high"></span> Skor Tinggi (71&ndash;100)</span>
    </div>
</div>

<div class="card" style="margin-bottom:1.5rem;">
    <h2 style="margin-bottom:1rem;">Daftar Dosen & Mahasiswa Bimbingan</h2>
    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap:1.25rem;">
        @forelse($dosenData as $dosen)
            <div class="card dosen-card" data-dosen-id="{{ $dosen->id }}" style="cursor:pointer; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; padding:1.5rem 1rem; transition: transform 0.2s, box-shadow 0.2s; background:white; border:1px solid var(--g2); border-radius:12px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                <div style="width:52px; height:52px; border-radius:50%; background:linear-gradient(135deg, var(--bl7), var(--bl5)); color:white; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:1.4rem; margin-bottom:1rem; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                    {{ strtoupper(substr($dosen->name, 0, 1)) }}
                </div>
                <div style="font-weight:700; color:var(--g8); font-size:1rem; margin-bottom:0.4rem;">{{ $dosen->name }}</div>
                <div style="font-size:0.85rem; font-weight:600; color:var(--g5); background:var(--g1); padding:0.2rem 0.75rem; border-radius:999px;">{{ count($dosen->students) }} Mahasiswa</div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align:center; color:var(--g5);">Belum ada data dosen.</div>
        @endforelse
    </div>
</div>

<div class="card" style="margin-bottom:1.5rem;">
    <h2>Daftar Seluruh Mahasiswa Berdasarkan Risiko</h2>
    @if(isset($mahasiswa) && $mahasiswa->isNotEmpty())
        <div style="overflow-x:auto;">
            <table class="table" style="margin-bottom:0.75rem; min-width:800px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Dosen Pembimbing</th>
                        <th>Level Risiko</th>
                        <th>Indikator Tertinggi</th>
                        <th>Tanggal Tes</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa as $i => $mhsItem)
                        @php $tes = $mhsItem->percobaanTes->sortByDesc('created_at')->first(); @endphp
                        <tr>
                            <td>{{ $mahasiswa->firstItem() + $i }}</td>
                            <td>{{ $mhsItem->name }}</td>
                            <td>
                                @php
                                    $kelasLabel = '-';
                                    if ($mhsItem->kelas == 5) { $kelasLabel = 'Kelas A'; }
                                    elseif ($mhsItem->kelas == 6) { $kelasLabel = 'Kelas B'; }
                                    elseif ($mhsItem->kelas == 7) { $kelasLabel = 'Kelas C'; }
                                    elseif ($mhsItem->kelas == 8) { $kelasLabel = 'Kelas D'; }
                                    elseif ($mhsItem->kelas == 9) { $kelasLabel = 'Kelas E'; }
                                @endphp
                                <span style="display:inline-block; padding:0.2rem 0.6rem; border-radius:4px; background:var(--g1); color:var(--g7); font-size:0.8rem; font-weight:600;">{{ $kelasLabel }}</span>
                            </td>
                            <td>{{ $mhsItem->dosen->name ?? '-' }}</td>
                            <td>
                                @if($tes && $tes->levelRisiko)
                                    <span class="badge badge-{{ strtolower(str_replace(' ', '-', $tes->levelRisiko->nama_level)) }}">
                                        {{ $tes->levelRisiko->nama_level }}
                                    </span>
                                @else
                                    <span class="badge" style="background:#f1f5f9; color:#64748b;">Belum Tes</span>
                                @endif
                            </td>
                            <td>
                                @if($tes)
                                    @php
                                        $dimScores = $tes->calculateDimensionScores();
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
                            <td>
                                @if($tes)
                                    {{ \Carbon\Carbon::parse($tes->created_at)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($tes)
                                    <strong>{{ $tes->total_skor }}</strong>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 1rem; display:flex; justify-content:center;">
            {{ $mahasiswa->links() }}
        </div>
    @else
        <div style="padding: 2rem; text-align:center; color:var(--g5);">Belum ada data mahasiswa.</div>
    @endif
</div>

<div class="card">
    <a href="{{ route('kaprodi.dashboard') }}" class="btn">Kembali</a>
</div>

@endsection