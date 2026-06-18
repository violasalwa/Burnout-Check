<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';

    protected $fillable = [
        'percobaan_tes_id',
        'soal_id',
        'skor',
    ];

    public function percobaanTes()
    {
        return $this->belongsTo(PercobaanTes::class, 'percobaan_tes_id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }
}
