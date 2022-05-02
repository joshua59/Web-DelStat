<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Class UsersSeeder generates 3 users with role Dosen and 5 users with role Siswa.
 */
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User with role Dosen
        User::create([
            'nama' => 'Dosen 1',
            'email' => 'dosen1@gmail.com',
            'no_hp' => '08123456791',
            'password' => bcrypt('12345678'),
            'jenjang' => 'Siswa',
            'foto_profil' => User::$FILE_DESTINATION . '/' . 'default.svg',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dosen 2',
            'email' => 'dosen2@gmail.com',
            'no_hp' => '08123456792',
            'password' => bcrypt('12345678'),
            'jenjang' => 'Siswa',
            'foto_profil' => User::$FILE_DESTINATION . '/' . 'default.svg',
            'role' => 'Dosen',
        ]);

        User::create([
            'nama' => 'Dosen 3',
            'email' => 'dosen3@gmail.com',
            'no_hp' => '08123456793',
            'password' => bcrypt('12345678'),
            'jenjang' => 'Siswa',
            'foto_profil' => User::$FILE_DESTINATION . '/' . 'default.svg',
            'role' => 'Dosen',
        ]);

        // User with role Siswa
        User::create([
            'nama' => 'Matthew Alfredo',
            'email' => 'matthewwalfredoo@gmail.com',
            'no_hp' => '08123456789',
            'password' => bcrypt('12345678'),
            'jenjang' => 'Siswa',
            'foto_profil' => User::$FILE_DESTINATION . '/' . 'default.svg',
            'role' => 'Siswa',
        ]);

        User::create([
            'nama' => 'Joshua Pratama Silitonga',
            'email' => 'joshuasilitonga@gmail.com',
            'no_hp' => '08123456788',
            'password' => bcrypt('12345678'),
            'jenjang' => 'Siswa',
            'foto_profil' => User::$FILE_DESTINATION . '/' . 'default.svg',
            'role' => 'Siswa',
        ]);

        User::create([
            'nama' => 'Kevin Nainggolan',
            'email' => 'kevinnainggolan@gmail.com',
            'no_hp' => '08123456787',
            'password' => bcrypt('12345678'),
            'jenjang' => 'Siswa',
            'foto_profil' => User::$FILE_DESTINATION . '/' . 'default.svg',
            'role' => 'Siswa',
        ]);

        User::create([
            'nama' => 'Dewa Sembiring',
            'email' => 'dewasembiring@gmail.com',
            'no_hp' => '08123456786',
            'password' => bcrypt('12345678'),
            'jenjang' => 'Siswa',
            'foto_profil' => User::$FILE_DESTINATION . '/' . 'default.svg',
            'role' => 'Siswa',
        ]);

        User::create([
            'nama' => 'Rut Ferwati Lumbantoruan',
            'email' => 'rutferwati@gmail.com',
            'no_hp' => '08123456785',
            'password' => bcrypt('12345678'),
            'jenjang' => 'Siswa',
            'foto_profil' => User::$FILE_DESTINATION . '/' . 'default.svg',
            'role' => 'Siswa',
        ]);
    }
}
