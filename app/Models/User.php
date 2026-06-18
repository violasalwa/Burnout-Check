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
        'semester',
        'dosen_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // =========================
    // 👨‍🏫 MAHASISWA → DOSEN
    // =========================
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    // =========================
    // 👨‍🏫 DOSEN → MAHASISWA BIMBINGAN
    // =========================
    public function mahasiswaBimbingan()
    {
        return $this->hasMany(User::class, 'dosen_id');
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