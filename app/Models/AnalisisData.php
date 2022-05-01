<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Get all Analisis Data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllAnalisisData()
    {
        return AnalisisData::all();
    }

    /**
     * Get all the Analisis Data for a given user.
     *
     * @param int $id_user
     * @return mixed
     */
    public static function getAllAnalisisDataPrivate(int $id_user)
    {
        return AnalisisData::where('id_user', $id_user)->get();
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
}
