<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Class UsersSeeder generates 10 dummy data for Materi table.
 */
class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Materi 1 - Konsep Peluang
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=AiEwPSPY0uE',
            'link_video_2' => 'https://www.youtube.com/watch?v=h8Nur-4DAWs',
            'id_user' => 1,
        ]);

        // Materi 2 - Variabel Acak
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=1osLasN8DsM',
            'link_video_2' => 'https://www.youtube.com/watch?v=Bn4--Dqedfs',
            'id_user' => 1,
        ]);

        // Materi 3 - Distribusi Peluang Diskrit
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=_penOQYAtxg',
            'id_user' => 1,
        ]);

        // Materi 4 - Distribusi Peluang Kontinu
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=tG9HI5T-Sqs',
            'link_video_2' => 'https://www.youtube.com/watch?v=K2iT4AGX_LU',
            'link_video_3' => 'https://www.youtube.com/watch?v=jmWBebK-PSM',
            'id_user' => 1,
        ]);

        // Materi 5 - Pengantar Statistik dan Analisis Data
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=kdU8o3QbhBk',
            'id_user' => 1,
        ]);

        // Materi 6 - Teknik Sampling
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=Vz2wQrv8zaw',
            'id_user' => 1,
        ]);

        // Materi 7 - Rancangan Percobaan (ANOVA)
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=8s26-P80WEk',
            'id_user' => 3,
        ]);

        // Materi 8 - Masalah Estimasi Satu dan Dua Sampel
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=5eN5UQZ9pvU',
            'link_video_2' => 'https://www.youtube.com/watch?v=9uuyVzKd0tA',
            'id_user' => 3,
        ]);

        // Materi 9 - Pengujian Hipotesis
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=JnNldZqguWE',
            'id_user' => 3,
        ]);

        // Materi 10 - Regresi Linier Sederhana dan Korelasi
        Materi::create([
            'link_video_1' => 'https://www.youtube.com/watch?v=eg5s-fB1hwk',
            'link_video_2' => 'https://www.youtube.com/watch?v=CugJoXktwoY',
            'id_user' => 3,
        ]);
    }
}
