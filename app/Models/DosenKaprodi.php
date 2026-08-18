<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenKaprodi extends Model
{
    use HasFactory;

    protected $table = 'dosen_kaprodi';

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mahasiswaBimbingan()
    {
        return $this->hasMany(User::class, 'dosen_id');
    }
}
