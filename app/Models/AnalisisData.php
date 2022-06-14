<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class AnalisisData extends Model
{
    use HasFactory;

    protected $table = "analisis_data";

    protected $fillable = [
        'id_user',
        'judul',
        'file',
        'deskripsi',
        'status',
    ];

    /**
     * The attributes that define directory for uploaded files of this model.
     * @var string
     */
    public static string $FILE_DESTINATION = 'uploaded/analisis_data';

    /**
     * Get all Analisis Data sorted by the latest data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllAnalisisData()
    {
        return AnalisisData::latest()->get();
    }

    /**
     * Get all the Analisis Data for a given user sorted by the latest data.
     *
     * @param int $id_user
     * @return mixed
     */
    public static function getAllAnalisisDataPrivate(int $id_user)
    {
        return AnalisisData::latest()->where('id_user', $id_user)->get();
    }

    /**
     * Get the data of Analisis Data by its id.
     *
     * @param $id
     * @return mixed
     */
    public static function getAnalisisDataById(int $id)
    {
        return AnalisisData::find($id);
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
