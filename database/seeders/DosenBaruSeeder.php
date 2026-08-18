<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DosenKaprodi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DosenBaruSeeder extends Seeder
{
    public function run()
    {
        $dosens = [
            ['198011022012122003', 'Budianingsih, S.T., M.T.'],
            ['197302061995011001', 'Ferry Faisal, S.ST., M.T.'],
            ['198512282015041002', 'Fitri Wibowo, S.ST., M.T.'],
            ['197408141999031002', 'Prof. Ardi Marwan'],
            ['197108201999031003', 'Hasan, ST., MT'],
            ['198406112019031012', 'Lindung Siswanto, S.Kom., M.Eng'],
            ['197503142006042001', 'Mariana Syamsudin, S.T., M.T., PhD'],
            ['198702082019031005', 'Muhammad Diponegoro, S.Kom., M.Cs.'],
            ['197601112014041001', 'Muhammad Hasbi, S.T., M.T.'],
            ['197710022014042001', 'Neny Firdyanti, S.T., M.T.'],
            ['198211005200812014', 'Nurul Fadilah M.Ed.Tesol.'],
            ['198809202015041003', 'Pausta Yugianus, S.Kom., M.T.'],
            ['196201261989031003', 'Ramli, ST, MT'],
            ['198806042019092001', 'Sarah Bibi, S.ST., M.Pd.'],
            ['197609232006041001', 'Satriyo, ST., M.Kom'],
            ['198307172008121005', 'Suheri, S.T., M.Cs.'],
            ['199010202019031013', 'Tommi Suryanto, S.Kom., M.Kom.'],
            ['198407172019031010', 'Tri Bowo Atmojo, S.T., M.Cs.'],
            ['197406231999031001', 'Wendhi Yuniyarto, ST., MT'],
            ['197203041995011001', 'Yasir Arafat, S.ST., M.T.'],
            ['198106272008012014', 'Yunita, ST., M.Sc. Ph.D.'],
            ['199407162022031006', 'Safri Adam, S.Kom., M.Kom.'],
            ['198811112022031006', 'Suharsono, S.Kom., M.Kom.'],
            ['199111132022032016', 'Novi Aryani Fitri, S.T., M.Tr.Kom.'],
            ['1989040520244061001', 'Yusril Eka Mahendra, M.TI.'],
            ['198603192008121002', 'Dr. Freska Rolansa, ST, M.Cs'],
            ['199011292025061002', 'Karfindo, M.Kom'],
        ];

        DB::beginTransaction();
        try {
            foreach ($dosens as $dosen) {
                $nip = trim($dosen[0]);
                $nama = trim($dosen[1]);
                $email = $nip . '@gmail.com';
                $password = Hash::make($nip);

                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => $nama,
                        'password' => $password,
                        'role' => 'dosen',
                    ]
                );

                $user->update([
                    'name' => $nama,
                    'password' => $password,
                    'role' => 'dosen',
                ]);

                DosenKaprodi::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nip' => $nip,
                        'nama' => $nama,
                        'jabatan' => 'dosen',
                    ]
                );
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
