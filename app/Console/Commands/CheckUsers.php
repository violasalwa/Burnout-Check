<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUsers extends Command
{
    protected $signature = 'check:users';
    protected $description = 'Inspect the current users table data';

    public function handle()
    {
        $count = User::count();
        $this->info('count=' . $count);

        foreach (User::take(5)->get() as $user) {
            $this->line($user->id . '|' . $user->name . '|' . ($user->kelas ?? 'null') . '|' . ($user->angkatan ?? 'null'));
        }

        return 0;
    }
}
