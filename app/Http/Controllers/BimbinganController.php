<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bimbingan;
use App\Models\User;

class BimbinganController extends Controller
{
    // 🔹 tampilkan semua bimbingan milik dosen
    public function index()
    {
        $bimbingans = Bimbingan::where('dosen_id', auth()->id())
            ->with('mahasiswa')
            ->latest()
            ->get();

        return view('dosen.bimbingan', compact('bimbingans'));
    }

    // 🔹 form tambah
    public function create()
    {
        $dosenId = auth()->user()->dosenKaprodi ? auth()->user()->dosenKaprodi->id : null;
        $mahasiswa = User::where('dosen_id', $dosenId)->get();

        return view('dosen.bimbingan-create', compact('mahasiswa'));
    }

    // 🔹 simpan
    public function store(Request $request)
    {
        Bimbingan::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'dosen_id' => auth()->id(),
            'catatan' => $request->catatan
        ]);

        return redirect('/bimbingan')->with('success', 'Data berhasil disimpan');
    }
}