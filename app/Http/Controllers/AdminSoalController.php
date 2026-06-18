<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;

class AdminSoalController extends Controller
{
    public function index()
    {
        $soals = Soal::paginate(10);
        return view('admin.soal.index', compact('soals'));
    }

    public function create()
    {
        return view('admin.soal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'kategori' => 'required',
            'is_active' => 'required|boolean',
        ]);

        Soal::create([
            'pertanyaan' => $request->pertanyaan,
            'kategori' => $request->kategori,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.soal.index')
            ->with('success', 'Soal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $soal = Soal::findOrFail($id);
        return view('admin.soal.edit', compact('soal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'kategori' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $soal = Soal::findOrFail($id);

        $soal->update([
            'pertanyaan' => $request->pertanyaan,
            'kategori' => $request->kategori,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.soal.index')
            ->with('success', 'Soal berhasil diupdate');
    }

    public function destroy($id)
    {
        Soal::findOrFail($id)->delete();

        return back()->with('success', 'Soal berhasil dihapus');
    }
}