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
        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 1,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 2,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 3,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 2,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 3,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 3,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 3,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 3,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 3,
        ]);

        Materi::create([
            'link_video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'id_user' => 3,
        ]);
    }
}
