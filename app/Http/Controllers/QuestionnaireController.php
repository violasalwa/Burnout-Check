<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\PercobaanTes;
use App\Models\Jawaban;
use App\Models\LevelRisiko;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class QuestionnaireController extends Controller
{
    /**
     * TAMPILKAN SOAL
     */
    public function index()
    {
        $soals = Soal::where('is_active', 1)
            ->orderBy('id', 'asc')
            ->get();

        return view('mahasiswa.tes.index', compact('soals'));
    }

    /**
     * SIMPAN HASIL TES
     */
    public function store(Request $request)
    {
        $request->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|integer|min:1|max:5',
        ]);

        DB::beginTransaction();

        try {

            // =========================
            // HITUNG SKOR ASLI
            // =========================
            $skorAsli = array_sum($request->jawaban);

            // =========================
            // JUMLAH SOAL AKTIF
            // =========================
            $jumlahSoal = Soal::where('is_active', 1)->count();

            // =========================
            // SKOR MAKSIMAL
            // =========================
            $skorMaksimal = $jumlahSoal * 5;

            // =========================
            // KONVERSI KE 0-100
            // =========================
            $totalSkor = round(
                ($skorAsli / $skorMaksimal) * 100
            );

            // =========================
            // AMBIL LEVEL RISIKO
            // =========================
            $levelRisiko = LevelRisiko::where('skor_min', '<=', $totalSkor)
                ->where('skor_max', '>=', $totalSkor)
                ->first();

            // =========================
            // VALIDASI LEVEL
            // =========================
            if (!$levelRisiko) {
                throw new \Exception(
                    "Skor {$totalSkor} tidak masuk range level risiko"
                );
            }

            // =========================
            // SIMPAN TES
            // =========================
            $percobaan = PercobaanTes::create([
                'pengguna_id'      => auth()->id(),
                'total_skor'       => $totalSkor,
                'level_risiko_id'  => $levelRisiko->id,
            ]);

            // =========================
            // SIMPAN JAWABAN
            // =========================
            foreach ($request->jawaban as $soalId => $skor) {

                Jawaban::create([
                    'percobaan_tes_id' => $percobaan->id,
                    'soal_id'          => $soalId,
                    'skor'             => $skor,
                ]);
            }

            DB::commit();

            return redirect()->route(
                'mahasiswa.tes.hasil',
                $percobaan->id
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withErrors([
                'msg' => $e->getMessage()
            ]);
        }
    }

    /**
     * HASIL TES
     */
    public function show($id)
    {
        $percobaan = PercobaanTes::with([
                'levelRisiko',
                'jawaban.soal',
                'user'
            ])
            ->findOrFail($id);

        if ($percobaan->pengguna_id !== auth()->id()) {
            abort(403);
        }

        return view(
            'mahasiswa.tes.hasil',
            compact('percobaan')
        );
    }

    /**
     * DOWNLOAD PDF
     */
    public function downloadPdf($id)
    {
        $percobaan = PercobaanTes::with([
                'levelRisiko',
                'jawaban.soal',
                'user'
            ])
            ->findOrFail($id);

        if ($percobaan->pengguna_id !== auth()->id()) {
            abort(403);
        }

        $pdf = Pdf::loadView(
            'mahasiswa.pdf.hasil',
            compact('percobaan')
        );

        return $pdf->download('hasil-burnout.pdf');
    }
}