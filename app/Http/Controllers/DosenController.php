<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * DASHBOARD DOSEN
     */
    public function index()
    {
        $dosenId = auth()->user()->dosenKaprodi ? auth()->user()->dosenKaprodi->id : null;

        /*
        |--------------------------------------------------------------------------
        | AMBIL MAHASISWA BIMBINGAN + TES TERAKHIR
        |--------------------------------------------------------------------------
        */
        $mahasiswas = User::with([
                'percobaanTes' => function ($query) {
                    $query->latest();
                },
                'percobaanTes.levelRisiko'
            ])
            ->where('role', 'mahasiswa')
            ->where('dosen_id', $dosenId)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TOTAL MAHASISWA
        |--------------------------------------------------------------------------
        */
        $mahasiswaCount = $mahasiswas->count();

        /*
        |--------------------------------------------------------------------------
        | HITUNG HASIL TES TERAKHIR SETIAP MAHASISWA
        |--------------------------------------------------------------------------
        */
        $lowRiskCount = 0;
        $mediumRiskCount = 0;
        $highRiskCount = 0;

        foreach ($mahasiswas as $mahasiswa) {

            // Ambil tes terakhir mahasiswa
            $tesTerakhir = $mahasiswa->percobaanTes
                ->sortByDesc('created_at')
                ->first();

            // Jika ada hasil tes & level risiko
            if ($tesTerakhir && $tesTerakhir->levelRisiko) {

                $level = strtolower($tesTerakhir->levelRisiko->nama_level);

                if ($level == 'rendah') {
                    $lowRiskCount++;
                }

                elseif ($level == 'sedang') {
                    $mediumRiskCount++;
                }

                elseif ($level == 'tinggi') {
                    $highRiskCount++;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | DATA CHART
        |--------------------------------------------------------------------------
        */
        $chartLabels = ['Rendah', 'Sedang', 'Tinggi'];

        $chartData = [
            $lowRiskCount,
            $mediumRiskCount,
            $highRiskCount
        ];

        return view('dosen.dashboard', compact(
            'mahasiswaCount',
            'lowRiskCount',
            'mediumRiskCount',
            'highRiskCount',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * DATA MAHASISWA BIMBINGAN
     */
    public function mahasiswa()
    {
        $dosenId = auth()->user()->dosenKaprodi ? auth()->user()->dosenKaprodi->id : null;

        $mahasiswas = User::with([
                'percobaanTes' => function ($query) {
                    $query->latest();
                },
                'percobaanTes.levelRisiko'
            ])
            ->where('role', 'mahasiswa')
            ->where('dosen_id', $dosenId)
            ->paginate(10);

        return view('dosen.mahasiswa', compact('mahasiswas'));
    }

    public function help()
    {
        return view('dosen.help');
    }
}