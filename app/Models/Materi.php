<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = "materi";

    protected $fillable = [
        'link_video_1',
        'link_video_2',
        'link_video_3',
        'link_video_4',
        'id_user',
    ];
}
