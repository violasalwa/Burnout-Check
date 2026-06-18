<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jawaban; // 🔥 WAJIB TAMBAH INI

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'pertanyaan',
        'kategori',
        'is_active',
    ];

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'soal_id');
    }
}