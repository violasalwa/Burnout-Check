<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\PercobaanTes;

class HighBurnoutNotification extends Notification
{
    use Queueable;

    public $student;
    public $tes;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $student, PercobaanTes $tes)
    {
        $this->student = $student;
        $this->tes = $tes;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $levelNama = $this->tes->levelRisiko ? $this->tes->levelRisiko->nama_level : 'Tidak diketahui';
        $dosenNama = $this->student->dosen ? $this->student->dosen->nama : 'Belum ditentukan';

        $pesanLengkap = sprintf(
            "Mahasiswa %s (NIM: %s, Kelas: %s) mendapatkan skor burnout %s (%d). Dosen Pembimbing: %s.",
            $this->student->name,
            $this->student->nim ?? '-',
            $this->student->kelas ?? '-',
            strtoupper($levelNama),
            $this->tes->total_skor,
            $dosenNama
        );

        return [
            'student_id' => $this->student->id,
            'student_name' => $this->student->name,
            'tes_id' => $this->tes->id,
            'skor' => $this->tes->total_skor,
            'level' => $levelNama,
            'dosen' => $dosenNama,
            'message' => $pesanLengkap,
        ];
    }
}
