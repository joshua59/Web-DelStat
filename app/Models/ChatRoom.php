<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = "chat_room";

    /**
     * Use id_user_1 for to refer to user with role Siswa
     * Use id_user_2 for to refer to user with role Dosen
     *
     * @var string[]
     */
    protected $fillable = [
        'id_user_1',
        'id_user_2',
    ];
}
