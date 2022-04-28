<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = "chat";

    protected $fillable = [
        'role',
        'pesan',
        'updated_at',
        'read_at',
        'id_user',
        'id_chat_room',
    ];
}
