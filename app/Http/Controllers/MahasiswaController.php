<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PercobaanTes;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $latestResult = PercobaanTes::with(['levelRisiko', 'jawaban.soal'])
            ->where('pengguna_id', $user->id)
            ->latest()
            ->first();

        $history = PercobaanTes::with('levelRisiko')
            ->where('pengguna_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalTes = PercobaanTes::where('pengguna_id', $user->id)->count();

        return view('mahasiswa.dashboard', compact('latestResult', 'history', 'totalTes'));
    }

    public function history()
    {
        $history = PercobaanTes::with('levelRisiko')
            ->where('pengguna_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('mahasiswa.history', compact('history'));
    }

}