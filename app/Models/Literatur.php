<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

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
        /*return self::all([
            'id',
            'judul',
            'tag',
            'penulis',
            'updated_at',
        ]);*/

        return self::orderBy('updated_at', 'desc')->get([
            'id',
            'judul',
            'tag',
            'penulis',
            'tahun_terbit',
            'updated_at',
        ]);
    }

    /**
     * This static method is used to get data of this model by its judul.
     *
     * @param string $judul
     * @return mixed
     */
    public static function getLiteraturByJudul(string $judul)
    {
        return self::where('judul', 'like', '%' . $judul . '%')
            ->orderBy('updated_at', 'desc')
            ->get([
            'id',
            'judul',
            'tag',
            'penulis',
            'tahun_terbit',
            'updated_at',
        ]);
    }

    /**
     * This static method is used to get data of this model by its tag.
     *
     * @param string $tag
     * @return mixed
     */
    public static function getLiteraturByTag(string $tag)
    {
        return self::where('tag', 'like', '%' . $tag . '%')
            ->orderBy('updated_at', 'desc')
            ->get([
            'id',
            'judul',
            'tag',
            'penulis',
            'tahun_terbit',
            'updated_at',
        ]);
    }

    /**
     * This static method is used to get data of this model by its judul and tag.
     *
     * @param string $judul
     * @param string $tag
     * @return mixed
     */
    public static function getLiteraturByJudulAndTag(string $judul, string $tag)
    {
        return self::where('judul', 'like', '%' . $judul . '%')
            ->where('tag', 'like', '%' . $tag . '%')
            ->orderBy('updated_at', 'desc')
            ->get([
                'id',
                'judul',
                'tag',
                'penulis',
                'tahun_terbit',
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

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        /*return $date->format('d M Y, H:i:s');*/
        $long = strtotime($date->format('Y-m-d H:i:s'));
        return (string)$long;
    }
}
