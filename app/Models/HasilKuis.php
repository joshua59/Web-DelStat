<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

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
        return HasilKuis::latest()->get();
    }

    /**
     * Get all data of Hasil Kuis based on id_user value
     *
     * @param int $id_user
     * @return mixed
     */
    public static function getAllHasilKuisPrivate(int $id_user)
    {
        return HasilKuis::latest()->where('id_user', $id_user)->get();
    }

    /**
     * Get all data of Hasil Kuis based on id_kuis value
     *
     * @param int $id_kuis
     * @return mixed
     */
    public static function getAllHasilKuisByIdKuis(int $id_kuis)
    {
        return HasilKuis::latest()->where('id_kuis', $id_kuis)->get();
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
        return HasilKuis::latest()
            ->where('id_kuis', $id_kuis)
            ->where('id_user', $id_user)
            ->get();
    }

    public static function getNamaKuisByIdKuis(int $id_kuis)
    {
        switch ($id_kuis) {
            case 1:
                return 'Kuis Konsep Peluang';
            case 2:
                return 'Kuis Variabel Acak';
            case 3:
                return 'Kuis Distribusi Probabilitas Diskrit';
            case 4:
                return 'Kuis Distribusi Probabilitas Kontinu';
            case 5:
                return 'Kuis Pengantar Statistika dan Analisis Data';
            case 6:
                return 'Kuis Teknik Sampling';
            case 7:
                return 'Kuis ANOVA';
            case 8:
                return 'Kuis Konsep Estimasi';
            case 9:
                return 'Kuis Pengujian Hipotesis';
            case 10:
                return 'Kuis Regresi Linier dan Korelasi';
        }
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        /*return $date->format('d M Y, H:i:s');*/
        $long = strtotime($date->format('Y-m-d H:i:s'));
        return (string)$long;
    }
}
