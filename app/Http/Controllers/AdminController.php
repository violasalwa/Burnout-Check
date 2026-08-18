<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\User;
use App\Models\Soal;
use App\Models\LevelRisiko;
use App\Models\PercobaanTes;

class AdminController extends Controller
{
    /**
     * DASHBOARD ADMIN
     */
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'soal' => Soal::count(),
            'percobaan' => PercobaanTes::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * USER MANAGEMENT
     */
    public function users()
    {
        $users = User::with(['dosen', 'dosenKaprodi'])
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * DETAIL USER
     */
    public function showUser($id)
    {
        $user = User::with([
                'dosen',
                'dosenKaprodi',
                'percobaanTes.levelRisiko'
            ])
            ->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * FORM CREATE USER
     */
    public function createUser()
    {
        $dosenList = \App\Models\DosenKaprodi::orderBy('nama')->get();
        return view('admin.users.create', compact('dosenList'));
    }

    /**
     * SIMPAN USER
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);

        $kelas = null;
        $dosenId = null;
        $angkatan = null;
        if ($request->role === 'mahasiswa') {
            $request->validate([
                'kelas' => 'required|integer|between:5,9',
                'dosen_id' => 'required_unless:kelas,5|exists:dosen_kaprodi,id',
                'angkatan' => 'required|numeric|digits:4',
                'nim' => 'required|string|unique:users,nim',
                'ipk' => 'required|numeric|min:0|max:4',
            ]);
            $kelas = $request->kelas;
            $dosenId = $request->dosen_id;
            $angkatan = $request->angkatan;
            $nim = $request->nim;
            $ipk = $request->ipk;
        } else {
            $nim = null;
            $ipk = null;
        }

        $userRole = in_array($request->role, ['dosen', 'kaprodi']) ? null : $request->role;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $userRole,
            'kelas' => $kelas,
            'dosen_id' => $dosenId,
            'angkatan' => $angkatan,
            'nim' => $nim,
            'ipk' => $ipk,
        ]);

        if (in_array($request->role, ['dosen', 'kaprodi'])) {
            \App\Models\DosenKaprodi::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'jabatan' => $request->role,
            ]);
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * FORM EDIT USER
     */
    public function editUser($id)
    {
        $user = User::with('dosenKaprodi')->findOrFail($id);
        $dosenList = \App\Models\DosenKaprodi::orderBy('nama')->get();

        return view('admin.users.edit', compact('user', 'dosenList'));
    }

    /**
     * UPDATE USER
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::with('dosenKaprodi')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|string',
        ]);

        if ($request->role === 'mahasiswa') {
            $request->validate([
                'kelas' => 'required|integer|between:5,9',
                'dosen_id' => 'required_unless:kelas,5|exists:dosen_kaprodi,id',
                'angkatan' => 'required|numeric|digits:4',
                'nim' => 'required|string|unique:users,nim,' . $user->id,
                'ipk' => 'required|numeric|min:0|max:4',
            ]);
        }
      
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = in_array($request->role, ['dosen', 'kaprodi']) ? null : $request->role;

        if ($request->role === 'mahasiswa') {
            $user->kelas = $request->kelas;
            $user->dosen_id = $request->dosen_id;
            $user->angkatan = $request->angkatan;
            $user->nim = $request->nim;
            $user->ipk = $request->ipk;
        } else {
            $user->kelas = null;
            $user->dosen_id = null;
            $user->angkatan = null;
            $user->nim = null;
            $user->ipk = null;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if (in_array($request->role, ['dosen', 'kaprodi'])) {
            \App\Models\DosenKaprodi::updateOrCreate(
                ['user_id' => $user->id],
                ['nama' => $user->name, 'jabatan' => $request->role]
            );
        } else {
            if ($user->dosenKaprodi) {
                $user->dosenKaprodi->delete();
            }
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * DELETE USER
     */
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }

    /**
     * LIST LEVEL RISIKO
     */
    public function riskLevels()
    {
        $levels = LevelRisiko::orderBy('skor_min')
            ->get();

        return view('admin.risk-levels.index', compact('levels'));
    }

    /**
     * FORM CREATE LEVEL RISIKO
     */
    public function createRiskLevel()
    {
        return view('admin.risk-levels.create');
    }

    /**
     * SIMPAN LEVEL RISIKO
     */
    public function storeRiskLevel(Request $request)
    {
        $request->validate([
            'nama_level' => 'required|string',

            'skor_min' => 'required|integer',

            'skor_max' => 'required|integer',

            'deskripsi' => 'required|string',
        ]);

        LevelRisiko::create([
            'nama_level' => $request->nama_level,
            'skor_min' => $request->skor_min,
            'skor_max' => $request->skor_max,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.risk-levels.index')
            ->with('success', 'Level risiko berhasil ditambahkan');
    }

    /**
     * FORM EDIT LEVEL RISIKO
     */
    public function editRiskLevel($id)
    {
        $level = LevelRisiko::findOrFail($id);

        return view('admin.risk-levels.edit', compact('level'));
    }

    /**
     * UPDATE LEVEL RISIKO
     */
    public function updateRiskLevel(Request $request, $id)
    {
        $request->validate([
            'nama_level' => 'required|string',

            'skor_min' => 'required|integer',

            'skor_max' => 'required|integer',

            'deskripsi' => 'required|string',
        ]);

        $level = LevelRisiko::findOrFail($id);

        $level->update([
            'nama_level' => $request->nama_level,
            'skor_min' => $request->skor_min,
            'skor_max' => $request->skor_max,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('admin.risk-levels.index')
            ->with('success', 'Level risiko berhasil diupdate');
    }

    /**
     * DELETE LEVEL RISIKO
     */
    public function destroyRiskLevel($id)
    {
        LevelRisiko::findOrFail($id)->delete();

        return redirect()
            ->route('admin.risk-levels.index')
            ->with('success', 'Level risiko berhasil dihapus');
    }

    /**
     * HASIL TES SEMUA MAHASISWA
     */
    public function hasilTes(Request $request)
    {
        $dosens = \App\Models\DosenKaprodi::where('jabatan', 'dosen')
            ->orderBy('nama')
            ->get();

        $selectedDosenId = $request->query('dosen_id');
        $selectedDosen = null;
        $results = null;

        if ($selectedDosenId) {
            $selectedDosen = \App\Models\DosenKaprodi::where('jabatan', 'dosen')
                ->find($selectedDosenId);

            if ($selectedDosen) {
                $latestIds = PercobaanTes::whereHas('user', function ($query) use ($selectedDosen) {
                        $query->where('dosen_id', $selectedDosen->id);
                    })
                    ->selectRaw('MAX(id) as id')
                    ->groupBy('pengguna_id')
                    ->pluck('id');

                $results = PercobaanTes::with(['user', 'levelRisiko'])
                    ->whereIn('id', $latestIds)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->appends(['dosen_id' => $selectedDosen->id]);
            }
        }

        return view('admin.hasil.index', compact(
            'dosens',
            'selectedDosen',
            'results'
        ));
    }

    public function mahasiswaByDosen(Request $request)
    {
        $dosens = \App\Models\DosenKaprodi::where('jabatan', 'dosen')
            ->orderBy('nama')
            ->get();

        $selectedDosenId = $request->query('dosen_id');
        $selectedDosen = null;
        $mahasiswas = null;

        if ($selectedDosenId) {
            $selectedDosen = \App\Models\DosenKaprodi::where('jabatan', 'dosen')
                ->find($selectedDosenId);

            if ($selectedDosen) {
                $mahasiswas = User::with([
                        'percobaanTes' => function ($query) {
                            $query->latest();
                        },
                        'percobaanTes.levelRisiko'
                    ])
                    ->where('role', 'mahasiswa')
                    ->where('dosen_id', $selectedDosen->id)
                    ->paginate(10)
                    ->appends(['dosen_id' => $selectedDosen->id]);
            }
        }

        return view('admin.mahasiswa.index', compact(
            'dosens', 'selectedDosen', 'mahasiswas'
        ));
    }

    public function downloadTesPdf($id)
    {
        $percobaan = PercobaanTes::with([
                'levelRisiko',
                'jawaban.soal',
                'user'
            ])
            ->findOrFail($id);

        $pdf = Pdf::loadView('mahasiswa.pdf.hasil', compact('percobaan'));

        return $pdf->download('hasil-burnout-mahasiswa-' . $percobaan->user->id . '.pdf');
    }

    public function help()
    {
        return view('admin.help');
    }
}