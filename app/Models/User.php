<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kelas',
        'dosen_id',
        'angkatan',
        'nim',
        'ipk'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // =========================
    // 👨‍🏫 DOSEN KAPRODI PROFILE
    // =========================
    public function dosenKaprodi()
    {
        return $this->hasOne(DosenKaprodi::class, 'user_id');
    }

    // =========================
    // 👨‍🏫 MAHASISWA → DOSEN (DosenKaprodi)
    // =========================
    public function dosen()
    {
        return $this->belongsTo(DosenKaprodi::class, 'dosen_id');
    }

    // =========================
    // 👨‍🏫 DOSEN (User) → MAHASISWA BIMBINGAN
    // =========================
    public function mahasiswaBimbingan()
    {
        return $this->hasManyThrough(User::class, DosenKaprodi::class, 'user_id', 'dosen_id', 'id', 'id');
    }

    // =========================
    // 🧠 HASIL TES BURNOUT (MAHASISWA)
    // =========================
    public function percobaanTes()
    {
        return $this->hasMany(PercobaanTes::class, 'pengguna_id');
    }

    // =========================
    // 📌 BIMBINGAN (OPSIONAL TABEL TERPISAH)
    // =========================
    public function bimbinganMahasiswa()
    {
        return $this->hasMany(Bimbingan::class, 'mahasiswa_id');
    }

    public function bimbinganDosen()
    {
        return $this->hasMany(Bimbingan::class, 'dosen_id');
    }
}