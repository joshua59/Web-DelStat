<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Chat extends Model
{
    use HasFactory;

    protected $table = "chat";

    protected $fillable = [
        'role',
        'pesan',
        'read_at',
        'id_user',
        'id_chat_room',
    ];

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
