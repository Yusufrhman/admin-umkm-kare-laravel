<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UMKM;
use App\Models\User;

class UMKMSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@madukare.com')->first();

        UMKM::create([
            'umkm_name' => 'Madu Kare Asli',
            'description' => 'Madu asli dari peternakan lebah Kare',
            'main_image' => '/dev/madu-kare.png',
            'nomer_wa' => '081234567893',
            'instagram' => 'madukare_asli',
            'user_id' => $admin->id,
        ]);

        UMKM::create([
            'umkm_name' => 'Madu Kare Premium',
            'description' => 'Madu premium kualitas terbaik',
            'main_image' => '/dev/madu-kare.png',
            'nomer_wa' => '081234567894',
            'instagram' => 'madukare_premium',
            'user_id' => $admin->id,
        ]);
    }
}
