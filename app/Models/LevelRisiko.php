<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelRisiko extends Model
{
    use HasFactory;

    protected $table = 'level_risiko';

    protected $fillable = [
        'nama_level',
        'skor_min',
        'skor_max',
        'deskripsi',
    ];

    public function percobaanTes()
    {
        return $this->hasMany(PercobaanTes::class, 'level_risiko_id');
    }
}
