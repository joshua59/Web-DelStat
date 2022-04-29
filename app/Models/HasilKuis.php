<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKuis extends Model
{
    use HasFactory;

    protected $table = "hasil_kuis";

    protected $fillable = [
        'nama_user',
        'id_kuis',
        'nilai_kuis',
        'id_user',
    ];

    /**
     * Get all data of Hasil Kuis
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllHasilKuis()
    {
        return HasilKuis::all();
    }

    /**
     * Get all data of Hasil Kuis based on id_user value
     *
     * @param int $id_user
     * @return mixed
     */
    public static function getAllHasilKuisPrivate(int $id_user)
    {
        return HasilKuis::where('id_user', $id_user)->get();
    }

    /**
     * Get all data of Hasil Kuis based on id_kuis value
     *
     * @param int $id_kuis
     * @return mixed
     */
    public static function getAllHasilKuisByIdKuis(int $id_kuis)
    {
        return HasilKuis::where('id_kuis', $id_kuis)->get();
    }

    /**
     * Get all data of Hasil Kuis based on id_kuis and id_user values
     *
     * @param int $id_kuis
     * @param int $id_user
     * @return mixed
     */
    public static function getAllHasilKuisByIdKuisPrivate(int $id_kuis, int $id_user)
    {
        return HasilKuis::where('id_kuis', $id_kuis)
            ->where('id_user', $id_user)
            ->get();
    }
}
