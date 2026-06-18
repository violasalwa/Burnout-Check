<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // ambil hanya user dengan role dosen
        $dosen = User::where('role', 'dosen')->get();

        return view('profile.edit', [
            'user' => $request->user(),
            'dosen' => $dosen
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // isi data dasar (name, email)
        $user->fill($request->validated());

        // 🔥 hanya mahasiswa boleh memilih dosen
        if ($user->role === 'mahasiswa') {

            $request->validate([
                'dosen_id' => [
                    'nullable',
                    'exists:users,id',
                    function ($attribute, $value, $fail) {
                        if ($value && !User::where('id', $value)->where('role', 'dosen')->exists()) {
                            $fail('Yang dipilih bukan dosen.');
                        }
                    }
                ]
            ]);

            $user->dosen_id = $request->dosen_id;
        }

        // reset verifikasi email jika berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}