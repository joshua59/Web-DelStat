<?php

namespace Database\Seeders;

use App\Models\HasilKuis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HasilKuisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HasilKuis::create([
            'id_user' => 4,
            'nama_user' => 'Matthew Alfredo',
            'id_kuis' => 1,
            'nilai_kuis' => '90.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        HasilKuis::create([
            'id_user' => 5,
            'nama_user' => 'Joshua Pratama Silitonga',
            'id_kuis' => 1,
            'nilai_kuis' => '90.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        HasilKuis::create([
            'id_user' => 6,
            'nama_user' => 'Kevin Nainggolan',
            'id_kuis' => 1,
            'nilai_kuis' => '90.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        HasilKuis::create([
            'id_user' => 7,
            'nama_user' => 'Dewa Sembiring',
            'id_kuis' => 1,
            'nilai_kuis' => '90.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        HasilKuis::create([
            'id_user' => 8,
            'nama_user' => 'Rut Ferwati Lumbantoruan',
            'id_kuis' => 1,
            'nilai_kuis' => '90.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
