<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * TAMPIL FORM REGISTER
     */
    public function create(): View
    {
        $dosenList = \App\Models\DosenKaprodi::where('jabatan', 'dosen')
            ->orderBy('nama')
            ->get();

        return view('auth.register', compact('dosenList'));
    }

    /**
     * PROSES REGISTER
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'dosen_id' => ['nullable', 'required_unless:kelas,5', 'exists:dosen_kaprodi,id'],
            'kelas' => ['required', 'integer', 'between:5,9'],
            'angkatan' => ['required', 'numeric', 'digits:4'],
            'nim' => ['required', 'string', 'unique:users,nim'],
            'ipk' => ['required', 'numeric', 'between:0.00,4.00'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'mahasiswa',
            'dosen_id' => $data['dosen_id'] ?? null,
            'kelas' => $data['kelas'],
            'angkatan' => $data['angkatan'],
            'nim' => $data['nim'],
            'ipk' => $data['ipk'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}