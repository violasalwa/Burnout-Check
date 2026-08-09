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

    public function getDimensionScoresAttribute()
    {
        return $this->calculateDimensionScores();
    }

    public function calculateDimensionScores()
    {
        $groups = $this->jawaban->groupBy(fn ($jawaban) => $jawaban->soal->kategori);

        return $groups->map(function ($answers, $kategori) {
            $count = $answers->count();
            $sum = $answers->sum('skor');
            $avg = $count ? round($sum / $count, 2) : 0;
            $percent = $count ? round(($sum / ($count * 5)) * 100) : 0;

            return [
                'kategori' => $kategori,
                'count' => $count,
                'sum' => $sum,
                'avg' => $avg,
                'percent' => $percent,
                'level' => self::dimensionSeverity($avg),
            ];
        })->sortByDesc('percent');
    }

    public static function dimensionSeverity(float $avg)
    {
        if ($avg <= 2.33) {
            return 'rendah';
        }

        if ($avg <= 3.66) {
            return 'sedang';
        }

        return 'tinggi';
    }

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
