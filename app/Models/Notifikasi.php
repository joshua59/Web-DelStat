<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = "notifikasi";

    protected $fillable = [
        'id_user',
        'jenis_notifikasi',
        'deskripsi',
        'id_literatur',
        'id_analisis_data',
        'sudah_dibaca',
        'read_at',
    ];

    public static string $NOTIFIKASI_LITERATUR_BARU = 'Literatur Baru';
    public static string $NOTIFIKASI_ANALISIS_DATA_BARU = 'Request Analisis Data Baru';

    /**
     * This function finds the difference in days between the date of the notification latest accessed
     * and the date when the notification was read by the user.
     *
     * @return mixed
     */
    public function getDiffInDaysAttribute()
    {
        return $this->updated_at->diffInDays($this->read_at);
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
