<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercobaanTes extends Model
{
    use HasFactory;

    protected $table = 'percobaan_tes';

    protected $fillable = [
        'pengguna_id',
        'total_skor',
        'level_risiko_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    public function levelRisiko()
    {
        return $this->belongsTo(LevelRisiko::class, 'level_risiko_id');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'percobaan_tes_id');
    }
}
