<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Literatur extends Model
{
    use HasFactory;

    protected $table = "literatur";

    protected $fillable = [
        'id_user',
        'judul',
        'penulis',
        'tahun_terbit',
        'tag',
        'file',
    ];

    /**
     * The attributes that define directory for uploaded files of this model.
     * @var string
     */
    public static string $FILE_DESTINATION = 'uploaded/literatur';

    /**
     * This static method is used to get all data of this model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllLiteratur()
    {
        return self::all([
            'id',
            'judul',
            'tag',
            'penulis',
            'created_at',
            'updated_at',
        ]);
    }

    /**
     * This static method is used to get one data of this model by id.
     *
     * @param int $id
     * @return mixed
     */
    public static function getLiteraturById(int $id)
    {
        return self::where('id', $id)->first([
            'id_user',
            'judul',
            'penulis',
            'tahun_terbit',
            'tag',
            'file',
            'created_at',
            'updated_at',
        ]);
    }
}
