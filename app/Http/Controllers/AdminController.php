<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $users = User::with('dosen')
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
        $dosenList = User::whereIn('role', ['dosen', 'kaprodi'])->orderBy('name')->get();
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

        // Conditional validation for mahasiswa role
        $semester = null;
        $dosenId = null;
        if ($request->role === 'mahasiswa') {
            $request->validate([
                'semester' => 'required|integer|between:5,8',
                'dosen_id' => 'required_unless:semester,5|exists:users,id',
            ]);
            $semester = $request->semester;
            $dosenId = $request->dosen_id;
        }

        User::create([
            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'role' => $request->role,

            'semester' => $semester,
            'dosen_id' => $dosenId,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * FORM EDIT USER
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $dosenList = User::whereIn('role', ['dosen', 'kaprodi'])->orderBy('name')->get();

        return view('admin.users.edit', compact('user', 'dosenList'));
    }

    /**
     * UPDATE USER
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'role' => 'required|string',
        ]);

        // Conditional validation for mahasiswa
        if ($request->role === 'mahasiswa') {
            $request->validate([
                'semester' => 'required|integer|between:5,8',
                'dosen_id' => 'required_unless:semester,5|exists:users,id',
            ]);
        }
      

        $user->name = $request->name;

        $user->email = $request->email;

        $user->role = $request->role;

        if ($request->role === 'mahasiswa') {
            $user->semester = $request->semester;
            $user->dosen_id = $request->dosen_id;
        } else {
            $user->semester = null;
            $user->dosen_id = null;
        }

        if ($request->filled('password')) {

            $user->password = Hash::make($request->password);
        }

        $user->save();

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
    public function hasilTes()
    {
        $results = PercobaanTes::with([
                'user',
                'levelRisiko'
            ])
            ->latest()
            ->paginate(10);

        return view('admin.hasil.index', compact('results'));
    }
}