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
        $dosenList = User::whereIn('role', ['dosen', 'kaprodi'])
            ->orderBy('name')
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
            'dosen_id' => ['nullable', 'required_unless:semester,5', 'exists:users,id'],
            'semester' => ['required', 'integer', 'between:5,8'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'mahasiswa',
            'dosen_id' => $data['dosen_id'] ?? null,
            'semester' => $data['semester'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}