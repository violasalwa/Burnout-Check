<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PercobaanTes;
use App\Models\LevelRisiko;

class KaprodiController extends Controller
{
    // =========================
    // DASHBOARD KAPRODI
    // =========================
    public function index()
    {
        $user = auth()->user();

        if (!$user->dosenKaprodi || $user->dosenKaprodi->jabatan !== 'kaprodi') {
            abort(403, 'Akses ditolak');
        }

        // =========================
        // DATA SELURUH MAHASISWA
        // =========================

        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        $totalDosen = \App\Models\DosenKaprodi::where('jabatan', 'dosen')->count();

        $latestTesIds = PercobaanTes::selectRaw('MAX(id) as id')
            ->groupBy('pengguna_id')
            ->pluck('id');

        $riskStats = LevelRisiko::all()->map(function ($level) use ($latestTesIds) {

            $count = PercobaanTes::whereIn('id', $latestTesIds)
                ->where('level_risiko_id', $level->id)
                ->count();

            $level->percobaan_tes_count = $count;

            return $level;
        });

        // =========================
        // DATA MAHASISWA BIMBINGAN
        // =========================

        $mahasiswaBimbinganIds = User::where('role', 'mahasiswa')
            ->where('dosen_id', $user->dosenKaprodi->id ?? null)
            ->pluck('id');

        $totalMahasiswaBimbingan = $mahasiswaBimbinganIds->count();

        $latestBimbinganTesIds = PercobaanTes::selectRaw('MAX(id) as id')
            ->whereIn('pengguna_id', $mahasiswaBimbinganIds)
            ->groupBy('pengguna_id')
            ->pluck('id');

        $bimbinganStats = LevelRisiko::all()->map(function ($level) use ($latestBimbinganTesIds) {

            $count = PercobaanTes::whereIn('id', $latestBimbinganTesIds)
                ->where('level_risiko_id', $level->id)
                ->count();

            $level->jumlah = $count;

            return $level;
        });

        // compute top dosen across prodi (by number of bimbingan students who have taken tests)
        $dosenStats = \App\Models\DosenKaprodi::where('jabatan', 'dosen')
            ->orderBy('nama')
            ->get()
            ->map(function ($dosen) {
                $mahasiswaIds = User::where('role', 'mahasiswa')
                    ->where('dosen_id', $dosen->id)
                    ->pluck('id');

                if ($mahasiswaIds->isEmpty()) {
                    $count = 0;
                } else {
                    $latestIds = PercobaanTes::selectRaw('MAX(id) as id')
                        ->whereIn('pengguna_id', $mahasiswaIds)
                        ->groupBy('pengguna_id')
                        ->pluck('id');

                    $count = $latestIds->count();
                }

                return (object) [
                    'id' => $dosen->id,
                    'name' => $dosen->nama,
                    'count' => $count,
                ];
            });

        $topDosen = $dosenStats->sortByDesc('count')->first();

        // Bar chart: avg burnout score per dosen (same logic as statistik())
        $lowLevelIds    = \App\Models\LevelRisiko::where('nama_level', 'Rendah')->pluck('id')->toArray();
        $mediumLevelIds = \App\Models\LevelRisiko::where('nama_level', 'Sedang')->pluck('id')->toArray();
        $highLevelIds   = \App\Models\LevelRisiko::whereIn('nama_level', ['Tinggi', 'Sangat Tinggi'])->pluck('id')->toArray();

        $dosenData = \App\Models\DosenKaprodi::where('jabatan', 'dosen')->orderBy('nama')->get()
            ->map(function ($dosen) use ($lowLevelIds, $mediumLevelIds, $highLevelIds) {
                $mahasiswaIds = User::where('role', 'mahasiswa')
                    ->where('dosen_id', $dosen->id)
                    ->pluck('id');

                if ($mahasiswaIds->isEmpty()) {
                    $avgScore = 0;
                    $students = collect();
                } else {
                    $latestIds = PercobaanTes::selectRaw('MAX(id) as id')
                        ->whereIn('pengguna_id', $mahasiswaIds)
                        ->groupBy('pengguna_id')
                        ->pluck('id');

                    $avgScore = PercobaanTes::whereIn('id', $latestIds)->avg('total_skor') ?? 0;

                    $students = User::with('percobaanTes.levelRisiko')
                        ->whereIn('id', $mahasiswaIds)
                        ->get()
                        ->map(function ($m) {
                            $tes = $m->percobaanTes->sortByDesc('created_at')->first();
                            return [
                                'id'        => $m->id,
                                'name'      => $m->name,
                                'kelas'     => $m->kelas,
                                'angkatan'  => $m->angkatan,
                                'skor'      => $tes ? $tes->total_skor : null,
                                'level'     => $tes && $tes->levelRisiko ? $tes->levelRisiko->nama_level : null,
                            ];
                        });
                }

                return (object) [
                    'id'       => $dosen->id,
                    'name'     => $dosen->nama,
                    'avg'      => round($avgScore, 1),
                    'students' => $students->toArray(),
                ];
            });

        $dosenLabels = $dosenData->pluck('name')->toArray();
        $dosenAvgs   = $dosenData->pluck('avg')->toArray();

        return view('kaprodi.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'riskStats',
            'totalMahasiswaBimbingan',
            'bimbinganStats',
            'topDosen',
            'dosenData',
            'dosenLabels',
            'dosenAvgs'
        ));
    }

    // =========================
    // STATISTIK KESELURUHAN
    // =========================
    public function statistik()
    {
        $user = auth()->user();

        if (!$user->dosenKaprodi || $user->dosenKaprodi->jabatan !== 'kaprodi') {
            abort(403, 'Akses ditolak');
        }

        $levelOrder = [
            'sangat tinggi' => 4,
            'tinggi'        => 3,
            'sedang'        => 2,
            'rendah'        => 1,
        ];

        $allMahasiswa = User::with([
                'dosen',
                'percobaanTes.levelRisiko'
            ])
            ->where('role', 'mahasiswa')
            ->get()
            ->sortByDesc(function ($mhs) use ($levelOrder) {
                $tes = $mhs->percobaanTes->sortByDesc('created_at')->first();
                if (!$tes || !$tes->levelRisiko) return -1;
                $nama = strtolower($tes->levelRisiko->nama_level);
                return $levelOrder[$nama] ?? 0;
            })
            ->values();

        $page    = request()->get('page', 1);
        $perPage = 10;

        $mahasiswa = new \Illuminate\Pagination\LengthAwarePaginator(
            $allMahasiswa->slice(($page - 1) * $perPage, $perPage)->values(),
            $allMahasiswa->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // per-dosen aggregation for bar chart: number of mahasiswa (per dosen) who have a latest test
        $lowLevelIds = LevelRisiko::where('nama_level', 'Rendah')->pluck('id')->toArray();
        $mediumLevelIds = LevelRisiko::where('nama_level', 'Sedang')->pluck('id')->toArray();
        $highLevelIds = LevelRisiko::whereIn('nama_level', ['Tinggi', 'Sangat Tinggi'])->pluck('id')->toArray();

        $dosenAggregates = \App\Models\DosenKaprodi::where('jabatan', 'dosen')
            ->orderBy('nama')
            ->get();

        $dosenData = $dosenAggregates->map(function ($dosen) use ($lowLevelIds, $mediumLevelIds, $highLevelIds) {
            $mahasiswaIds = User::where('role', 'mahasiswa')
                ->where('dosen_id', $dosen->id)
                ->pluck('id');

            if ($mahasiswaIds->isEmpty()) {
                $total = 0;
                $lowCount = 0;
                $mediumCount = 0;
                $highCount = 0;
                $avgScore = 0;
                $students = collect();
            } else {
                $latestIds = PercobaanTes::selectRaw('MAX(id) as id')
                    ->whereIn('pengguna_id', $mahasiswaIds)
                    ->groupBy('pengguna_id')
                    ->pluck('id');

                $total = $latestIds->count();

                $lowCount = PercobaanTes::whereIn('id', $latestIds)
                    ->whereIn('level_risiko_id', $lowLevelIds)
                    ->count();

                $mediumCount = PercobaanTes::whereIn('id', $latestIds)
                    ->whereIn('level_risiko_id', $mediumLevelIds)
                    ->count();

                $highCount = PercobaanTes::whereIn('id', $latestIds)
                    ->whereIn('level_risiko_id', $highLevelIds)
                    ->count();

                $avgScore = PercobaanTes::whereIn('id', $latestIds)->avg('total_skor') ?? 0;

                $students = User::with('percobaanTes.levelRisiko')
                    ->whereIn('id', $mahasiswaIds)
                    ->get()
                    ->map(function ($m) {
                        $tes = $m->percobaanTes->sortByDesc('created_at')->first();
                        return [
                            'id' => $m->id,
                            'name' => $m->name,
                            'kelas' => $m->kelas,
                            'angkatan' => $m->angkatan,
                            'email' => $m->email,
                            'last_test' => $tes ? $tes->created_at->format('d M Y H:i') : null,
                            'skor' => $tes ? $tes->total_skor : null,
                            'level' => $tes && $tes->levelRisiko ? $tes->levelRisiko->nama_level : null,
                        ];
                    });
            }

            return (object) [
                'id' => $dosen->id,
                'name' => $dosen->nama,
                'total' => (int) $total,
                'low' => (int) $lowCount,
                'medium' => (int) $mediumCount,
                'high' => (int) $highCount,
                'avg' => round($avgScore, 1),
                'students' => $students->toArray(),
            ];
        });

        $dosenLabels = $dosenData->pluck('name')->toArray();
        $dosenCounts = $dosenData->pluck('total')->toArray();
        $dosenHighs = $dosenData->pluck('high')->toArray();
        $dosenAvgs = $dosenData->pluck('avg')->toArray();

        // --- high-risk per-dosen (Tinggi + Sangat Tinggi) ---
        $highDosenAggregates = \App\Models\DosenKaprodi::where('jabatan', 'dosen')
            ->orderBy('nama')
            ->get()
            ->map(function ($dosen) use ($highLevelIds) {
                $mahasiswaIds = User::where('role', 'mahasiswa')
                    ->where('dosen_id', $dosen->id)
                    ->pluck('id');

                if ($mahasiswaIds->isEmpty()) {
                    $count = 0;
                } else {
                    $latestIds = PercobaanTes::selectRaw('MAX(id) as id')
                        ->whereIn('pengguna_id', $mahasiswaIds)
                        ->groupBy('pengguna_id')
                        ->pluck('id');

                    $count = PercobaanTes::whereIn('id', $latestIds)
                        ->whereIn('level_risiko_id', $highLevelIds)
                        ->count();
                }

                return (object) [
                    'id' => $dosen->id,
                    'name' => $dosen->nama,
                    'count' => $count,
                ];
            });

        $highDosenLabels = $highDosenAggregates->pluck('name')->toArray();
        $highDosenCounts = $highDosenAggregates->pluck('count')->toArray();

        // --- top mahasiswa berisiko (urut berdasarkan level + tanggal) ---
        $highLevelNames = ['sangat tinggi', 'tinggi'];
        $topMahasiswa = $allMahasiswa->filter(function ($mhs) use ($highLevelNames) {
            $tes = $mhs->percobaanTes->sortByDesc('created_at')->first();
            if (!$tes || !$tes->levelRisiko) return false;
            return in_array(strtolower($tes->levelRisiko->nama_level), $highLevelNames);
        })->sortByDesc(function ($mhs) use ($levelOrder) {
            $tes = $mhs->percobaanTes->sortByDesc('created_at')->first();
            $nama = strtolower($tes->levelRisiko->nama_level);
            return ($levelOrder[$nama] ?? 0) * 1000000000 + strtotime($tes->created_at);
        })->values()->take(20);

        return view(
            'kaprodi.statistik',
            compact('mahasiswa', 'dosenData', 'dosenLabels', 'dosenCounts', 'dosenHighs', 'dosenAvgs', 'topMahasiswa')
        );
    }

    // =========================
    // MAHASISWA BIMBINGAN
    // =========================
    public function mahasiswaBimbingan()
    {
        $user = auth()->user();

        if (!$user->dosenKaprodi || $user->dosenKaprodi->jabatan !== 'kaprodi') {
            abort(403, 'Akses ditolak');
        }

        $mahasiswa = User::with([
                'percobaanTes.levelRisiko'
            ])
            ->where('role', 'mahasiswa')
            ->where('dosen_id', $user->dosenKaprodi->id ?? null)
            ->latest()
            ->paginate(10);

        return view(
            'kaprodi.mahasiswa-bimbingan',
            compact('mahasiswa')
        );
    }

    public function mahasiswaByDosen($id)
    {
        $user = auth()->user();

        if (!$user->dosenKaprodi || $user->dosenKaprodi->jabatan !== 'kaprodi') {
            abort(403, 'Akses ditolak');
        }

        $dosen = \App\Models\DosenKaprodi::where('id', $id)->where('jabatan', 'dosen')->firstOrFail();

        $mahasiswa = User::with([
                'percobaanTes.levelRisiko'
            ])
            ->where('role', 'mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->latest()
            ->paginate(10);

        return view(
            'kaprodi.mahasiswa-by-dosen',
            compact('mahasiswa', 'dosen')
        );
    }

    // =========================
    // MARK NOTIFICATION AS READ
    // =========================
    public function markNotificationAsRead($id)
    {
        $user = auth()->user();
        
        if (!$user->dosenKaprodi || $user->dosenKaprodi->jabatan !== 'kaprodi') {
            abort(403, 'Akses ditolak');
        }

        $notification = $user->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    public function markAllNotificationsAsRead()
    {
        $user = auth()->user();
        
        if (!$user->dosenKaprodi || $user->dosenKaprodi->jabatan !== 'kaprodi') {
            abort(403, 'Akses ditolak');
        }

        $user->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }

    public function help()
    {
        return view('kaprodi.help');
    }
}