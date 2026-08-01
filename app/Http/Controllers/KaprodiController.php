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

        if ($user->role !== 'kaprodi') {
            abort(403, 'Akses ditolak');
        }

        // =========================
        // DATA SELURUH MAHASISWA
        // =========================

        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        $totalDosen = User::where('role', 'dosen')->count();

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
            ->where('dosen_id', $user->id)
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

        return view('kaprodi.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'riskStats',
            'totalMahasiswaBimbingan',
            'bimbinganStats'
        ));
    }

    // =========================
    // STATISTIK KESELURUHAN
    // =========================
    public function statistik()
    {
        $user = auth()->user();

        if ($user->role !== 'kaprodi') {
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

        return view(
            'kaprodi.statistik',
            compact('mahasiswa')
        );
    }

    // =========================
    // MAHASISWA BIMBINGAN
    // =========================
    public function mahasiswaBimbingan()
    {
        $user = auth()->user();

        if ($user->role !== 'kaprodi') {
            abort(403, 'Akses ditolak');
        }

        $mahasiswa = User::with([
                'percobaanTes.levelRisiko'
            ])
            ->where('role', 'mahasiswa')
            ->where('dosen_id', $user->id)
            ->latest()
            ->paginate(10);

        return view(
            'kaprodi.mahasiswa-bimbingan',
            compact('mahasiswa')
        );
    }
}