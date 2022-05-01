<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = "notifikasi";

    protected $fillable = [
        'id_user',
        'jenis_notifikasi',
        'id_literatur',
        'id_analisis_data',
        'sudah_dibaca',
        'read_at',
    ];

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
}
